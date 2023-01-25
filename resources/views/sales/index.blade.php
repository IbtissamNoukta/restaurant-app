@extends('layouts.app')

@section('content')
    <div class="content">
        <div class="row justify-content-center">
            <div class="col-md-10">
                <div class="card">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-12">
                                {{-- d-flex flex-row justify-content-center align-items-between border-buttom pd-1 --}}
                                <div class="d-flex justify-content-between border-bottom border-2">
                                    <h3 class="text-secondary">
                                        <i class="fa-sharp fa-solid fa-credit-card"></i>
                                        Sales
                                    </h3>
                                    <a href="{{ route("sale.create") }}" class="btn btn-primary">
                                        <i class="fas fa-plus fa-x2"></i>
                                    </a>
                                </div>
                                <table class="table table-hover table-responsive-sm ">
                                    <thead>
                                        <tr>
                                            <th>Id</th>
                                            <th>Menus</th>
                                            <th>Quantity</th>
                                            <th>Tables</th>
                                            <th>Servers</th>
                                            <th>Total</th>
                                            <th>Payment type</th>
                                            <th>Payment status</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($sales as $sale)
                                        <tr>
                                            <td>
                                                {{ $sale->id }}
                                            </td>
                                            <td>
                                                @foreach ($sale->menus()->where("sale_id",$sale->id)->get() as $menu)
                                                    <div class="col-md-4 mb-2">
                                                        <div class="h-100">
                                                            <div class="d-flex
                                                                flex-column justify-content-center
                                                                align-items-center
                                                                list-group-item-action">
                                                                    <img src="{{ asset('images/menus/'. $menu->image) }}" alt="{{ $menu->title }}"
                                                                    class="img-fluid rounded" width="50" height="50">
                                                                    <h5 class="font-weight-bold mt-2">{{ $menu->title }}</h5>
                                                                    <h5 class="font-weight-bold text-muted mt-2">{{ $menu->price }} DH</h5>
                                                            </div>
                                                        </div>
                                                    </div>
                                                @endforeach
                                            </td>
                                            <td >
                                                @foreach ($sale->menus()->where("sale_id",$sale->id)->get() as $menu)
                                                    <h5 class="font-weight-bold mt-2 mp-3 p-5">{{ $menu->pivot->quantity }}</h5>
                                                @endforeach
                                            </td>
                                            <td>
                                                @foreach ($sale->tables()->where("sale_id", $sale->id)->get() as $table)
                                                    <div class="col-md-3">
                                                        <div class="p-2 mb-2 d-flex
                                                                    flex-column justify-content-center
                                                                    align-items-center
                                                                    list-group-item-action">
                                                            <i class="fa fa-chair fa-3x"></i>
                                                            <span class="mt-2 text-muted font-weight-bold">{{ $table->name }}</span>
                                                        </div>
                                                    </div>
                                                @endforeach
                                            </td>
                                            <td>
                                                {{ $sale->servant->name }}
                                            </td>
                                            <td>
                                                {{ $sale->total_price }}
                                            </td>
                                            <td>
                                                {{  $sale->payment_type === "cash"? "Cash" : "Credit Card"  }}
                                            </td>
                                            <td>
                                                {{  $sale->payment_status }}
                                            </td>
                                            <td class="flex-row align-items-center">
                                                <a href="{{ route("sale.edit",$sale->id) }}" class="btn btn-warning mb-2">
                                                    <i class="fas fa-edit"></i>
                                                </a>
                                                <form  id="{{ $sale->id }}" action="{{ route("sale.destroy",$sale->id) }}" method="post">
                                                    @csrf
                                                    @method("DELETE")
                                                    <button onclick="
                                                        event.preventDefault();
                                                        if(confirm('are u sur u wanna delete ths sale? '))
                                                        document.getElementById({{ $sale->id }}).submit();"
                                                        class="btn btn-danger">
                                                            <i class="fas fa-trash"></i>
                                                    </button>
                                                </form>
                                            </td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                                <div class="my-3 d-flex justify-content-center align-items-center">
                                    {{ $sales->links() }}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
