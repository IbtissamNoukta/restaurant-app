<?php

namespace App\Http\Controllers;

use App\Models\Servant;
use App\Http\Requests\StoreServantRequest;
use App\Http\Requests\UpdateServantRequest;

class ServantController extends Controller
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
        return view('managments.servers.index', [
            'servants' => Servant::paginate(5)
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
        return view('managments.servers.create');

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreServantRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreServantRequest $request)
    {
        //validation
        $this->validate($request, [
            "name"=>"required|min:3"
        ]);
        //store data
        Servant::create([
            "name" => $request->name,
            "adress" => $request->adress
        ]);
        //redirect user
        return redirect()->route("servant.index")->with(["success" => "servant added with success"]);
       // return redirect()->route("categories.index")->with(["success" => "categories added success"]);

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Servant  $servant
     * @return \Illuminate\Http\Response
     */
    public function show(Servant $servant)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Servant  $servant
     * @return \Illuminate\Http\Response
     */
    public function edit(Servant $servant)
    {
        //
        return view("managments.servers.edit", ["servant" => $servant]);

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateServantRequest  $request
     * @param  \App\Models\Servant  $servant
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateServantRequest $request, Servant $servant)
    {
        //update category
           //validation
           $this->validate($request, [
            "name"=>"required|min:3"
        ]);
           //store data
           $servant->update([
               "name" => $request->name,
               "adress" => $request->adress
           ]);
           //redirect user
           return redirect()->route("servant.index")->with(["success" => "servant updated with success"]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Servant  $servant
     * @return \Illuminate\Http\Response
     */
    public function destroy(Servant $servant)
    {
        //
           //delete category
           $servant->delete();
           //redirect user
           return redirect()->route("servant.index")->with(["success" => "servant deleted with success"]);
    }
}
