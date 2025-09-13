<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Course;
use App\Models\Level;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\Facades\DataTables;

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
        return view('pages.index', $data);
     }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'modules' => 'required|array|min:1',
            'modules.*.title' => 'required|string|max:255',
            'modules.*.contents' => 'required|array|min:1',
            'modules.*.contents.*.type' => 'required|in:video,text,quiz',
            'modules.*.contents.*.data' => 'required|string', // adapt per type
        ]);

        DB::beginTransaction();

        try {
            // Always create course first
            $course = Course::create([
                'title' => $request->title,
                'publish' => false,
            ]);

            foreach ($request->modules as $moduleIndex => $moduleData) {
                // Create a savepoint before each module
                DB::statement("SAVEPOINT module_savepoint");

                try {
                    $module = $course->modules()->create([
                        'title' => $moduleData['title'],
                    ]);

                    foreach ($moduleData['contents'] as $contentIndex => $contentData) {
                        $module->contents()->create([
                            'type' => $contentData['type'],
                            'data' => $contentData['data'],
                        ]);
                    }

                    // release the savepoint since this module succeeded
                    DB::statement("RELEASE SAVEPOINT module_savepoint");

                } catch (\Throwable $e) {
                    // rollback just this module, but keep course + previous modules
                    DB::statement("ROLLBACK TO SAVEPOINT module_savepoint");
                    break; // stop further processing
                }
            }

            // If every module was saved → publish course
            if ($course->modules()->count() === count($request->modules)) {
                $course->update(['publish' => true]);
            }

            DB::commit();

        } catch (\Throwable $e) {
            DB::rollBack();
            return back()->withErrors(['error' => $e->getMessage()]);
        }


    }
    
    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Course $course)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Course $course)
    {
        //
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
