<?php

namespace App\Http\Controllers;

use App\Models\Menu;
use App\Models\Category;
use App\Http\Requests\StoreMenuRequest;
use App\Http\Requests\UpdateMenuRequest;
use Illuminate\Support\Str;


class MenuController extends Controller
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
        //all the menus
        return view('managments.menus.index', [
            'menus' => Menu::paginate(5)
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
        return view('managments.menus.create', [
            'categories' => Category::all()
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreMenuRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreMenuRequest $request)
    {

        //store data
        if($request->has("image")){
            //recuperer file
            $file=$request->image;
            //name image
            $imageName=time()."_".$file->getClientOriginalName();
            //enregister(upload) file in falder local (public)
            //move(place,name)
            $file->move(public_path("images/menus"),$imageName);
        }
        $title = $request->title;
        Menu::create([
            "title" => $title,
            "slug" => Str::slug($title),
            "description" => $request->description,
            "price" => $request->price,
            "image" => $imageName,
            "category_id"=> $request->category_id
        ]);
        //redirect user
        return redirect()->route("menu.index")->with(["success" => "menus added with success"]);
       // return redirect()->route("categories.index")->with(["success" => "categories added success"]);

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Menu  $menu
     * @return \Illuminate\Http\Response
     */
    public function show(Menu $menu)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Menu  $menu
     * @return \Illuminate\Http\Response
     */
    public function edit(Menu $menu)
    {
        //
        return view("managments.menus.edit", [
            "categories" => Category::all(),
            "menu" => $menu
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateMenuRequest  $request
     * @param  \App\Models\Menu  $menu
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateMenuRequest $request, Menu $menu)
    {
        //update category
           //validation
        //    $this->validate($request, [
        //     "title"=>"required|min:3|unique:menus,title,".$menu->id,
        //     "description"=>"required|min:5",
        //     "price"=>"required|numeric",
        //     "image"=>"mimes:png,jpg,jpeg|max:2048",
        //     "category_id"=>"required|numeric"
        // ]);
           //store data
            if($request->has('image')){
                //recuperer file
                $file=$request->image;
                //name image
                $imageName=time()."_".$file->getClientOriginalName();
                //enregister(upload) file in falder local (public)
                //move(place,name)
                $file->move(public_path("images/menus"),$imageName);
                //for delete the old one
                if(file_exists(public_path("images/menus/").$menu->image)){
                    unlink(public_path("images/menus/").$menu->image);
                }
                //if we don't add a new image we use the old one
                $menu->image=$imageName;
            }
           $title = $request->title;
           $menu->update([
                "title" => $title,
                "slug" => Str::slug($title),
                "description" => $request->description,
                "price" => $request->price,
                "image" => $menu->image,
                "category_id" => $request->category_id
           ]);
           //redirect user
           return redirect()->route("menu.index")->with(["success" => "menus updated with success"]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Menu  $menu
     * @return \Illuminate\Http\Response
     */
    public function destroy(Menu $menu)
    {
        // //delete image
        // if(file_exists(public_path("images/menus/").$menu->image)){
        //     unlink(public_path("images/menus/").$menu->image);
        // }
        //delete category
        $menu->delete();
        //redirect user
        return redirect()->route("menu.index")->with(["success" => "menus deleted with success"]);
    }
}
