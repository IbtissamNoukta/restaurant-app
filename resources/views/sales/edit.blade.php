@extends('layouts.app')

@section('content')
    <div class="content">
        <form id="update_sale" action="{{ route("sale.update", $sale->id ) }}" method="post">
            @csrf
            @method("PUT")
            <div class="row justify-content-center">
                <div class="col-md-10">
                    <div class="row">
                        <div class="col-md-10 mb-3">
                            <div class="form-groupe">
                                <a href="/sale" class="btn btn-outline-secondary">
                                    <i class="fa fa-chevron-left"></i>
                                </a>
                            </div>
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
                                                    id="table" value="{{ $table->id }}"
                                                                @foreach ($tables_s as $table_s)
                                                                            {{ $table_s->id === $table->id? "checked" : "" }}
                                                                @endforeach>
                                            </div>
                                            <i class="fa fa-chair fa-5x"></i>
                                            <span class="mt-2 text-muted font-weight-bold">{{ $table->name }}</span>
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
                                                        {{-- menus->id from sales and menu->id from category --}}
                                                        <input type="checkbox" name='menu_id[]'
                                                            id="menu_{{ $menu->id }}" value="{{ $menu->id }}" onclick="myFunction({{ $menu->id }})" @foreach ($menus as $menu_s)
                                                            {{ $menu_s->id === $menu->id? "checked" : "" }}
                                                            @endforeach >
                                                    </div>
                                                    <img src="{{ asset('images/menus/'. $menu->image) }}" alt="{{ $menu->title }}"
                                                    class="img-fluid rounded" width="100" height="100">
                                                    <h5 class="font-weight-bold mt-2">{{ $menu->title }}</h5>
                                                    <h5 id="menu_price" class="text-muted">{{ $menu->price }} DH</h5>
                                                    <input style="display:block" type="number" name="quantity[{{ $menu->id }}]" id="quantity_{{ $menu->id }}" class="form-control" placeholder="quantity" value=@foreach ($menus as $menu_s)
                                                        {{ $menu_s->id === $menu->id ? $menu_s->pivot->quantity : "" }}
                                                        @endforeach>

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
                                <option {{ $servant->id == $sale->servant_id? "selected" : "" }}
                                name="servant_id" id="servant_id" value="{{ $servant->id }}" >{{ $servant->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group mb-3">
                        <input type="number" name="total_price" id="total_price" class="form-control" placeholder="total_price" value="{{ $sale->total_price }}">
                    </div>
                    <div class="form-group mb-3">
                        <input type="number" name="total_received" id="total_received" class="form-control" placeholder="total_received" value="{{ $sale->total_received }}">
                    </div>
                    <div class="form-group mb-3">
                        <input type="number" name="change" id="change" class="form-control" placeholder="change" value="{{ $sale->change }}">
                    </div>
                    <div class="form-group mb-3">
                        <select name="payment_type" id="payment_type" class="form-control">
                            <option value="" selected disabled>
                                Choose a payment type
                            </option>
                            <option value="cash" {{ $sale->payment_type === "cash"? "selected" : "" }}>Cash</option>
                            <option value="card" {{ $sale->payment_type === "card"? "selected" : "" }}>Credit Card</option>
                        </select>
                    </div>
                    <div class="form-group mb-3">
                        <select name="payment_status" id="payment_status" class="form-control">
                            <option value="" selected disabled>
                                Choose a payment status
                            </option>
                            <option value="Paid" {{ $sale->payment_status === "Paid"? "selected" : "" }}>Paid</option>
                            <option value="Unpaid" {{ $sale->payment_status === "Unpaid"? "selected" : "" }}>Unpaid</option>
                        </select>
                    </div>
                    <div class="form-group d-md-flex justify-content-md-center">
                        <button onclick="
                        event.preventDefault();
                        document.getElementById('update_sale').submit();" class="btn btn-warning">Validate</button>
                    </div>
                </div>
            </div>
        </form>
    </div>
@endsection
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

</script>
