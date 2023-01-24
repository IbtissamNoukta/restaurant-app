@extends('layouts.app')

@section('content')
    <div class="content">
        <form id="add_sale" action="{{ route("sale.store") }}" method="post">
            @csrf
            <div class="row justify-content-center">
                <div class="col-md-10">
                    <div class="row">
                        <div class="col-md-10 mb-3">
                            <div class="form-groupe">
                                <a href="/payment" class="btn btn-outline-secondary">
                                    <i class="fa fa-chevron-left"></i>
                                </a>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="my-2 col-md-3">
                            <h3 class="text-muted border-bottom border-2">
                                {{ Carbon\Carbon::now() }}
                            </h3>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12 mb-3">
                            <h3 class="form-groupe">
                                <a href="{{ route("sale.index") }}" class="btn btn-outline-secondary float-end">
                                    All Sales
                                </a>
                            </h3>
                        </div>
                    </div>
                    <div class="card">
                        <div class="card-body">
                            <div class="row">
                                @foreach ($tables as $table)
                                    <div class="col-md-3">
                                        <div class="card p-2 mb-2 d-flex
                                        flex-column justify-content-center
                                        align-items-center
                                        list-group-item-action">
                                            <div class="align-self-end">
                                                <input type="checkbox" name='table_id[]'
                                                id="table" value="{{ $table->id }}">
                                            </div>
                                            <i class="fa fa-chair fa-5x"></i>
                                            <span class="mt-2 text-muted font-weight-bold">{{ $table->name }}</span>
                                            <div class="form-groupe
                                                        flex-column justify-content-between
                                                        align-items-center">
                                                <a href="{{ route("table.edit", $table) }}" class="btn btn-sm btn-warning">
                                                    <i class="fa fa-edit"></i>
                                                </a>
                                            </div>
                                            <hr>
                                            @foreach ($table->sales as $sale)
                                                @if ($sale->created_at >= Carbon\Carbon::today())
                                                    <div style="border: dashed pink" class="mb-2 mt-2 shadow w-100" id="{{ $sale->id }}">
                                                        <div class="card">
                                                            <div class="card-body d-flex flex-column justify-content-center
                                                                align-items-center">
                                                                @foreach ($sale->menus()->where("sale_id",$sale->id)->get() as $menu)
                                                                <h5 class="font-weight-bold mt-2">
                                                                    {{ $menu->title }}
                                                                </h5>
                                                                <span class="text-muted">{{ $menu->pivot->quantity }} X {{ $menu->price }} DH</span>
                                                                @endforeach


                                                                <h5 class="font-weight-bold mt-2">
                                                                    <span class="badge bg-danger"> Server : {{ $sale->servant->name }}</span>
                                                                </h5>
                                                                <h5 class="font-weight-bold mt-2">
                                                                    <span> Total : {{ $sale->total_price }} DH</span>
                                                                </h5>
                                                                <h5 class="font-weight-bold mt-2">
                                                                    <span> Received : {{ $sale->total_received }} DH</span>
                                                                </h5>
                                                                <h5 class="font-weight-bold mt-2">
                                                                    <span> Change : {{ $sale->change}} DH</span>
                                                                </h5>
                                                                <h5 class="font-weight-bold mt-2">
                                                                    <span class="badge text-bg-light"> Payment type: : {{ $sale->payment_type }}</span>
                                                                </h5>
                                                                <h5 class="font-weight-bold mt-2">
                                                                    <span class="badge text-bg-light"> Payment status: : {{ $sale->payment_status }}</span>
                                                                </h5>
                                                                <hr>
                                                                <span class="front-weight-bold">Restaurant XXX</span>
                                                                <span class="text-muted">01 23 45 67 89</span>
                                                                <span class="text-muted">Safi Qu XX Rue 100</span>
                                                                <span class="text-muted">{{ Str::substr($sale->created_at, 11, 19) }}</span>
                                                                <div class="mt-2 d-flex justify-content-center">
                                                                    <a href="{{ route("sale.edit", $sale->id) }}" class="btn btn-sm btn-warning mr-2">
                                                                        <i class="fa fa-edit"></i>
                                                                    </a>
                                                                    <a href="#" target="_blank" onclick="print({{ $sale->id }})" class="btn btn-sm btn-primary">
                                                                        <i class="fas fa-print"></i>
                                                                    </a>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>

                                                @endif
                                            @endforeach
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row justify-content-center mt-2 p-3">
                <div class="col-md-10 card p-3">
                    <ul class="nav nav-pills nav-fill gap-2 p-1 small bg-secondary rounded-5 shadow-sm" id="pill-tab" role="tablist" style="--bs-nav-link-color: var(--bs-white); --bs-nav-pills-link-active-color: var(--bs-secondary); --bs-nav-pills-link-active-bg: var(--bs-white);">
                        @foreach ($categories as $category)
                        <li class="nav-item" role="presentation">
                            <button class="nav-link rounded-5 {{ $category->id === 1 ? "active" : ""}}"
                                id="{{ $category->slug }}-tab" data-bs-toggle="tab"
                                type="button" role="tab" aria-selected="true" aria-controls="{{ $category->slug }}"
                                href="#{{ $category->slug }}">
                                {{ $category->title }}
                            </button>
                        </li>
                        @endforeach
                    </ul>
                    <div class="tab-content p-3" id="pills-tabcontent">
                        @foreach ($categories as $category)
                            <div class="tab-pane fade {{ $category->id === 1 ? "show active" : ""}}"
                                id="{{ $category->slug }}"
                                 role="tabpanel" aria-labelledby="pills-home-tab">
                                 @foreach ($category->menu as $menu)
                                     <div class="col-md-4 mb-2">
                                        <div class="card h-100">
                                            <div class="card-body d-flex
                                                flex-column justify-content-center
                                                align-items-center
                                                list-group-item-action">
                                                    <div class="align-self-end">
                                                        <input type="checkbox" name='menu_id[]'
                                                        id="menu_{{ $menu->id }}" value="{{ $menu->id }}" onclick="myFunction({{ $menu->id }})">
                                                    </div>
                                                    <img src="{{ asset('images/menus/'. $menu->image) }}" alt="{{ $menu->title }}"
                                                    class="img-fluid rounded" width="100" height="100">
                                                    <h5 class="font-weight-bold mt-2">{{ $menu->title }}</h5>
                                                    <h5 id="menu_price" class="text-muted">{{ $menu->price }} DH</h5>
                                                    <input style="display:none" type="number" name="quantity[{{ $menu->id }}]" id="quantity_{{ $menu->id }}" class="form-control" placeholder="quantity">
                                            </div>
                                        </div>
                                     </div>
                                 @endforeach
                            </div>
                        @endforeach
                    </div>
                    <div class="form-group mb-3">
                        <select name="servant_id" id="servant_id" class="form-control">
                            <option value="" selected disabled>
                                Choose a servant
                            </option>
                            @foreach ($servants as $servant)
                                <option name="servant_id" id="servant_id" value="{{ $servant->id }}">{{ $servant->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group mb-3">
                        <input type="number" name="total_price" id="total_price" class="form-control" placeholder="total_price">
                    </div>
                    <div class="form-group mb-3">
                        <input type="number" name="total_received" id="total_received" class="form-control" placeholder="total_received">
                    </div>
                    <div class="form-group mb-3">
                        <input type="number" name="change" id="change" class="form-control" placeholder="change">
                    </div>
                    <div class="form-group mb-3">
                        <select name="payment_type" id="payment_type" class="form-control">
                            <option value="" selected disabled>
                                Choose a payment type
                            </option>
                            <option value="Cash">Cash</option>
                            <option value="Card">Credit Card</option>
                        </select>
                    </div>
                    <div class="form-group mb-3">
                        <select name="payment_status" id="payment_status" class="form-control">
                            <option value="" selected disabled>
                                Choose a payment status
                            </option>
                            <option value="Paid">Paid</option>
                            <option value="Unpaid">Unpaid</option>
                        </select>
                    </div>
                    <div class="form-group d-md-flex justify-content-md-center">
                        <button onclick="
                        event.preventDefault();
                        document.getElementById('add_sale').submit();" class="btn btn-primary">validate</button>
                    </div>
                </div>
            </div>
        </form>
    </div>
@endsection
@section('javascript')
<script>
    function myFunction(id) {
        // Get the checkbox
        var checkboxes = document.getElementById("menu_"+id);
            // Get the output text
        var text = document.getElementById("quantity_"+id);

    // If the checkbox is checked, display the output text
        if (checkboxes.checked == true){
            text.style.display = "block";
            text.value="1";
        } else {
            text.style.display = "none";
            text.value="null";
        }
    }
    function print(el) {
        const page = document.body.innerHTML;
        const content = document.getElementById(el).innerHTML;
        document.body.innerHTML=content;
        window.print();
        document.body.innerHTML= page;
    }

</script>
@endsection
{{-- <script>
    function totalPrice(){
        var input1 = (document.getElementById("menu_price").value)*(document.getElementById("quantity").value) ;
        document.getElementById("total_price").value = input1;
}
$(function(){
	$('#total_recieved').change(function(){
		$('.form-control:not(#total_recieved)').prop('placeholder',this.value)
	});
});
function change(){
        var input1 = (document.getElementById("total_recieved").value)-(document.getElementById("total_price").value) ;
        document.getElementById("change").value = input1;
}
</script> --}}
