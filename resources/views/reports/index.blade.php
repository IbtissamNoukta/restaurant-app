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
                                <div class="d-flex justify-content-between border-bottom border-2 m-1">
                                    <div class="form-groupe">
                                        <a href="/payment" class="btn btn-outline-secondary m-1">
                                            <i class="fa fa-chevron-left"></i>
                                        </a>
                                    </div>
                                    <h3 class="text-secondary mt-2">
                                        <i class="fa-sharp fa-solid fa-list"></i>
                                        Reports
                                    </h3>
                                </div>
                                <div class="card">
                                    <div class="card-body">
                                        <div class="row">
                                            <div class="col-sm-3 shadow mx-auto p-2">
                                                <form action="{{ route("report.generate") }}" method="post">
                                                    @csrf
                                                    <div class="form-group m-1">
                                                        <input type="date" name="from" id="from" placeholder="Start date" class="form-control">
                                                    </div>
                                                    <div class="form-group m-1">
                                                        <input type="date" name="to" id="to" placeholder="End date" class="form-control">
                                                    </div>
                                                    <div class="d-flex justify-content-center form-group m-1">
                                                        <button class="btn btn-primary ">
                                                            View the report
                                                        </button>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                @isset($total)
                                    <h4 class="text-primary mt-4 mb-2 font-weight-bold">
                                        Report from {{ Str::substr($startDate, 0, 10) }} to {{ Str::substr($endDate, 0, 10) }}
                                    </h4>
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
                                            </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                    <p class="text-danger text-center front-weight-bold">
                                        Total : {{ $total }} DH
                                    </p>
                                    <form action="{{ route("report.export") }}" method="post">
                                        @csrf
                                        <div class="form-group m-1">
                                            <input type="hidden" name="from" id="from" value="{{ $startDate }}" class="form-control">
                                        </div>
                                        <div class="form-group m-1">
                                            <input type="hidden" name="to" id="to" value="{{ $endDate }}" class="form-control">
                                        </div>
                                            <button class="btn btn-success ">
                                                Report generate
                                            </button>
                                    </form>
                                @endisset
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
