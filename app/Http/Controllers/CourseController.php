<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Course;
use App\Models\Video;
use App\Models\Level;
use App\Models\Module;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\Facades\DataTables;
use App\Rules\HhMmSsFormat;
class CourseController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {   
        if ($request->ajax()) {
            $data = Course::withCount('modules')->select('courses.*');
            return DataTables::of($data)
            ->addIndexColumn() // for #
            ->editColumn('image', function ($row) {
                if ($row->image) {
                    return '<img src="'.asset('storage/'.$row->image).'" class="h-12 w-12 object-cover rounded">';
                }
                return '<span class="text-gray-400">No Image</span>';
            })
            ->editColumn('modules', function ($row) {
                return $row->modules_count;
            })
            ->editColumn('price', function ($row) {
                return number_format($row->price, 2).' USD';
            })
            ->editColumn('published', function ($row) {
                $checked = $row->published ? 'checked' : '';
                return '
                    <label class="inline-flex items-center cursor-pointer">
                        <input type="checkbox" class="toggle-publish" data-id="'.$row->id.'" '.$checked.'>
                        <span class="ml-2 text-sm">'.($row->published ? 'Yes' : 'No').'</span>
                    </label>
                ';
            })
            
            ->addColumn('action', function ($row) {
                return '
                    <a href="'.route('courses.edit', $row->id).'" class="text-blue-600 mr-2">Edit</a>
                    <a href="javascript:void(0)" data-id="'.$row->id.'" class="text-red-600 delete-course">Delete</a>
                ';
            })
            ->rawColumns(['image', 'published', 'action'])
            ->make(true);
        }
        
        return view("courses.index");
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $data= [];
        $data['levels'] = Level::all();
        $data['categories'] = Category::all();
        $data['sources'] = Video::SOURCES;;
        return view('courses.create', $data);
     }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // dd($request->all());
        $data = $request->validate([
            'course_title' => 'required|string|max:255',
            'course_video' => 'nullable|string|max:255',
            'course_image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:9048',
            'level_id' => 'required|exists:levels,id',
            'category_id' => 'required|exists:categories,id',
            'price' => 'required|numeric|min:0',
            'text' => 'nullable|string',

            'modules' => 'required|array|min:1',
            'modules.*.title' => 'required|string|max:255',
            'modules.*.contents' => 'required|array|min:1',
            'modules.*.contents.*.type' => 'required|in:video,quiz',
            'modules.*.contents.*.title' => 'required|string|max:255',
            'modules.*.contents.*.source' => 'required|in:local,vimeo,youtube,cloud',
            'modules.*.contents.*.url' => 'required|string|max:500',
            'modules.*.contents.*.length' => [
                'nullable',
                new HhMmSsFormat
            ]
        ]);

        // dd($data);
        try {
            DB::beginTransaction();

            $course = Course::create([
                'title' => $request->course_title,
                'intro_vid' => $request->course_video,
                'price' => $request->price,
                'level_id' => $request->level_id,
                'category_id' => $request->category_id,
                'text' => $request->text,
                'publish' => false,
            ]);
            if( $request->hasFile('course_image') ) {
                 $course->image = $request->file('course_image')->store('uploads/courses', 'public');
                $course->save();
            }

            foreach ($request->modules as $moduleIndex => $moduleData) {
                DB::statement("SAVEPOINT module_savepoint");

                try {
                    $module = $course->modules()->create([
                        'name' => $moduleData['title'],
                    ]);

                    foreach ($moduleData['contents'] as $contentData) {
                        if ($contentData['type'] == 'video') {
                            if (!empty($contentData['length'])) {
                                [$h, $m, $s] = explode(':', $contentData['length']);
                                $lengthInSeconds = ($h * 3600) + ($m * 60) + $s;
                            }

                            $video = Video::create([
                                'title' => $contentData['title'],
                                'source_type' => $contentData['source'],
                                'url' => $contentData['url'],
                                'length_in_seconds' => $lengthInSeconds ?? null,
                            ]);

                            $module->contents()->create([
                                'title' => $contentData['title'], 
                                'contentable_type' => Video::class,
                                'contentable_id' => $video->id,
                            ]);
                        }
                    }

                    DB::statement("RELEASE SAVEPOINT module_savepoint");

                } catch (\Throwable $e) {
                    // Rollback just this module
                    DB::statement("ROLLBACK TO SAVEPOINT module_savepoint");
                    // dd('module_error', $e->getMessage());
                    
                    // Store error in session and stop processing further modules
                    return session()->flash('module_error', "Module {$moduleIndex}: " . $e->getMessage()."the course is drafted");
                    break;
                }
            }

            // If all modules saved, publish
            if ($course->modules()->count() === count($request->modules)) {
                $course->update(['publish' => true]);
            }

            DB::commit();

        } catch (\Throwable $e) {
            DB::rollBack();
                // dd('course error', $e->getMessage());

            return session()->flash('module_error', $e->getMessage());
        }
        session()->flash('success', 'Course and all modules saved successfully!');
        return redirect()->back();
    }
    
    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Course $course)
    {
        $data = [];
        $data['course'] = $course;
        $data['levels'] = Level::all();
        $data['categories'] = Category::all();
        $data['sources'] = Video::SOURCES;
        $data['modules'] = Module::where('course_id', $course->id)->with('contents.contentable')->get();

        return view('courses.edit', $data);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Course $course){
        // dd($request->all());
        $data = $request->validate([
            'course_title' => 'required|string|max:255',
            'course_video' => 'nullable|string|max:255',
            'course_image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:9048',
            'level_id' => 'required|exists:levels,id',
            'category_id' => 'required|exists:categories,id',
            'price' => 'required|numeric|min:0',
            'text' => 'nullable|string',

            'modules' => 'required|array|min:1',
            'modules.*.title' => 'required|string|max:255',
            'modules.*.contents' => 'required|array|min:1',
            'modules.*.contents.*.type' => 'required|in:video,quiz',
            'modules.*.contents.*.title' => 'required|string|max:255',
            'modules.*.contents.*.source' => 'required|in:local,vimeo,youtube,cloud',
            'modules.*.contents.*.url' => 'required|string|max:500',
            'modules.*.contents.*.length' => [
                'nullable',
                new HhMmSsFormat
            ]
        ]);

        try {
            DB::beginTransaction();

            // update course fields
            $course->update([
                'title' => $request->course_title,
                'intro_vid' => $request->course_video,
                'price' => $request->price,
                'level_id' => $request->level_id,
                'category_id' => $request->category_id,
                'text' => $request->text,
                'publish' => false,
            ]);

            // handle course image update
            if ($request->hasFile('course_image')) {
                if ($course->image && Storage::disk('public')->exists($course->image)) {
                    Storage::disk('public')->delete($course->image);
                }
                $course->image = $request->file('course_image')->store('uploads/courses', 'public');
                $course->save();
            }

            // delete old modules & contents (simplest approach)
            $course->modules()->each(function ($module) {
                $module->contents()->delete();
                $module->delete();
            });

            // re-create modules and contents
            foreach ($request->modules as $moduleIndex => $moduleData) {
                DB::statement("SAVEPOINT module_savepoint");
                try {
                    $module = $course->modules()->create([
                        'name' => $moduleData['title'],
                    ]);

                    foreach ($moduleData['contents'] as $contentData) {
                        if ($contentData['type'] === 'video') {
                            $lengthInSeconds = null;
                            if (!empty($contentData['length'])) {
                                [$h, $m, $s] = explode(':', $contentData['length']);
                                $lengthInSeconds = ($h * 3600) + ($m * 60) + $s;
                            }

                            $video = Video::create([
                                'title' => $contentData['title'],
                                'source_type' => $contentData['source'],
                                'url' => $contentData['url'],
                                'length_in_seconds' => $lengthInSeconds,
                            ]);

                            $module->contents()->create([
                                'title' => $contentData['title'],
                                'contentable_type' => Video::class,
                                'contentable_id' => $video->id,
                            ]);
                        }
                    }

                    DB::statement("RELEASE SAVEPOINT module_savepoint");
                } catch (\Throwable $e) {
                    DB::statement("ROLLBACK TO SAVEPOINT module_savepoint");
                    return session()->flash('module_error', "Module {$moduleIndex}: " . $e->getMessage() . " the course is drafted");
                }
            }

            // mark published if all modules saved
            if ($course->modules()->count() === count($request->modules)) {
                $course->update(['publish' => true]);
            }

            DB::commit();
        } catch (\Throwable $e) {
            DB::rollBack();
            return session()->flash('module_error', $e->getMessage());
        }

        session()->flash('success', 'Course updated successfully!');
        return redirect()->back();
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Course $course)
    {
        //
    }

    public function togglePublish(Request $request){
        $course = Course::findOrFail($request->id);
        $course->published = !$course->published;
        $course->save();

        return response()->json(['success' => true, 'status' => $course->published]);
    }
}
