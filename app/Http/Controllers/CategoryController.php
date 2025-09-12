<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
// use Yajra\DataTables\DataTables;
use Yajra\DataTables\Facades\DataTables;
class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data = Category::latest()->get();
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

        return view("categories.index");
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view("categories.form");
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            "name" => "required|unique:categories,name",
            "text" => "nullable",
        ]);
        $category = Category::create($data);
        return redirect()->route("categories.index");
    }

    /**
     * Display the specified resource.
     */
    public function show(Category $category)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Category $category)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Category $category)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Category $category)
    {
        //
    }
}
