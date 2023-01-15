@extends('layouts.app')

@section('content')
    <div class="content">
        <div class="row justify-content-center">
            <div class="col-md-10">
                <div class="card">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-4">
                                @include('layouts.sidebar')
                            </div>
                            <div class="col-md-8">
                                    <h3 class="text-secondary border-bottom border-2 mb-3">
                                        <i class="fa-sharp fa-solid fa-plus"> Add a Table</i>
                                    </h3>
                                <form action="{{ route("table.store") }}" method="post">
                                    @csrf
                                    <div class="form-group mb-3">
                                        <input type="text" name="name" id="name" class="form-control" placeholder="Name">
                                    </div>
                                    <div class="form-group mb-3">
                                        <select name="status" id="status" class="form-control">
                                            <option value="" selected disabled>
                                                Available
                                            </option>
                                            <option value="1">Yes</option>
                                            <option value="0">Non</option>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <button class="btn btn-primary">validate</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
