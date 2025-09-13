<?php

namespace App\Http\Controllers;

use App\Models\Level;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class LevelController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data = Level::latest()->get();
            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function($row){
                    $btn = '<a href="'.route('categories.edit', $row->id).'" class="text-blue-600 hover:underline mr-2">Edit</a>';
                    $btn .= '<form action="'.route('categories.destroy', $row->id).'" method="POST" class="inline">
                                '.csrf_field().method_field('DELETE').'
                                <button type="submit" class="text-red-600 hover:underline">Delete</button>
                            </form>';
                    return $btn;
                })
                ->rawColumns(['action'])
                ->make(true);
        }

        return view("levels.index");
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view("levels.form");
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            "name" => "required|unique:levels,name",
            "text" => "nullable",
        ]);
        $category = Level::create($data);
        return redirect()->route("levels.index");
    }

    /**
     * Display the specified resource.
     */
    public function show(Level $level)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Level $level)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Level $level)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Level $level)
    {
        //
    }
}
