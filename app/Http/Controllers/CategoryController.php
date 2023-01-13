<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Http\Requests\StoreCategoryRequest;
use App\Http\Requests\UpdateCategoryRequest;
use Illuminate\Support\Str;


class CategoryController extends Controller
{
    //user do nt see the category if isn't connected
    public function __construct(){
        $this->middleware('auth');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //all the categories
        return view('managments.categories.index', [
            'categories' => Category::paginate(5)
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('managments.categories.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreCategoryRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreCategoryRequest $request)
    {
        //validation
        $this->validate($request, ["title"=>"required|min:3"]);
        //store data
        $title = $request->title;
        Category::create([
            "title" => $title,
            "slug" => Str::slug($title)
        ]);
        //redirect user
        return redirect()->route("category.index")->with(["success" => "categories added with success"]);
       // return redirect()->route("categories.index")->with(["success" => "categories added success"]);

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function show(Category $category)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function edit(Category $category)
    {
        //
        return view("managments.categories.edit", ["category" => $category]);
        {

        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateCategoryRequest  $request
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateCategoryRequest $request, Category $category)
    {
        //update category
           //validation
           $this->validate($request, ["title"=>"required|min:3"]);
           //store data
           $title = $request->title;
           $category->update([
               "title" => $title,
               "slug" => Str::slug($title)
           ]);
           //redirect user
           return redirect()->route("category.index", ["success" => "categories updated with success"]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function destroy(Category $category)
    {
        //delete category
        $category->delete();
        //redirect user
        return redirect()->route("category.index", ["success" => "categories deleted with success"]);
    }
}
