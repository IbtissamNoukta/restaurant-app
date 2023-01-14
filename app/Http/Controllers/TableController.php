<?php

namespace App\Http\Controllers;

use App\Models\Table;
use App\Http\Requests\StoreTableRequest;
use App\Http\Requests\UpdateTableRequest;
use Illuminate\Support\Str;

class TableController extends Controller
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
        //
        //all the tables
        return view('managments.tables.index', [
            'tables' => Table::paginate(5)
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
        return view('managments.tables.create');

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreTableRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreTableRequest $request)
    {
        //validation
        $this->validate($request, [
            "name"=>"required|unique:tables,name",
            "status"=>"required|boolean"
        ]);
                //store data
        $name = $request->name;
        Table::create([
            "name" => $name,
            "slug" => Str::slug($name),
            "status" => $request->status
        ]);
        //redirect user
        return redirect()->route("table.index")->with(["success" => "tables added with success"]);
       // return redirect()->route("categories.index")->with(["success" => "categories added success"]);

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Table  $table
     * @return \Illuminate\Http\Response
     */
    public function show(Table $table)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Table  $table
     * @return \Illuminate\Http\Response
     */
    public function edit(Table $table)
    {
        //
        return view("managments.tables.edit", ["table" => $table]);

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateTableRequest  $request
     * @param  \App\Models\Table  $table
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateTableRequest $request, Table $table)
    {
         //update category
           //validation
           $this->validate($request, [
                "name"=>"required|unique:tables,name,".$table->id,
                "status"=>"required|boolean"
            ]);
           //store data
           $name = $request->name;
           $table->update([
               "name" => $name,
               "slug" => Str::slug($name),
               "status" => $request->status
           ]);
           //redirect user
           return redirect()->route("table.index")->with(["success" => "tables updated with success"]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Table  $table
     * @return \Illuminate\Http\Response
     */
    public function destroy(Table $table)
    {
           //delete category
           $table->delete();
           //redirect user
           return redirect()->route("table.index")->with(["success" => "tables deleted with success"]);

    }
}
