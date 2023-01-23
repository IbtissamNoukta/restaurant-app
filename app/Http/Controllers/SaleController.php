<?php

namespace App\Http\Controllers;

use App\Models\Sale;
use App\Http\Requests\StoreSaleRequest;
use App\Http\Requests\UpdateSaleRequest;

class SaleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreSaleRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreSaleRequest $request)
    {
        //
        // Sale::create([
        //     "servant_id" => $request->price,
        //     "total_price" => $request->price,
        //     "total_received" => $request->price,
        //     "change" => $request->price,
        //     "payment_type" => $request->price,
        //     "payment_status"=> $request->price
        // ]);
        //store data
        //dd($request->all());
        $sale= new Sale();
        $sale->servant_id = $request->servant_id;
        $sale->total_price = $request->total_price;
        $sale->total_received = $request->total_received;
        $sale->change = $request->change;
        $sale->payment_type = $request->payment_type;
        $sale->payment_status = $request->payment_status;
        $sale->save();
        $sale->menus()->sync($request->menu_id);
        $quantity=$request->quantity;
        //add for each menu of each sale a quantity
        //$request->menu_id and $request->quantity are tables
        //the $quantity[id] is the menu_id
        foreach($request->menu_id as $id){
           $sale->menus()->sync([$id => [ 'quantity' => $quantity[$id]] ], false);
        }
        $sale->tables()->sync($request->table_id);
        //redirect user
        return redirect()->back()->with(["success" => "paiyment added with success"]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Sale  $sales
     * @return \Illuminate\Http\Response
     */
    public function show(Sale $sale)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Sale  $sale
     * @return \Illuminate\Http\Response
     */
    public function edit(Sale $sale)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateSaleRequest  $request
     * @param  \App\Models\Sale  $sales
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateSaleRequest $request, Sale $sale)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Sale  $sales
     * @return \Illuminate\Http\Response
     */
    public function destroy(Sale $sale)
    {
        //
    }
}
