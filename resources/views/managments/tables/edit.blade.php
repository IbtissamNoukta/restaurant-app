@extends('layouts.app')

@section('content')
    <div class="content">
        <div class="row justify-content-center">
            <div class="col-md-10">
                <div class="card">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-4">
                                sidebar
                            </div>
                            <div class="col-md-8">
                                    <h3 class="text-secondary border-bottom border-2 mb-3">
                                        <i class="fa-sharp fa-solid fa-plus"> Edit the table {{ $table->title }}</i>
                                    </h3>
                                <form action="{{ route("table.update", $table->slug) }}" method="post">
                                    @csrf
                                    @method("PUT")
                                    <div class="form-group mb-3">
                                        <input type="text" name="name" id="name" class="form-control"
                                         placeholder="Name" value="{{ $table->name }}">
                                    </div>
                                    <div class="form-group mb-3">
                                        <select name="status" id="status" class="form-control">
                                            <option value="" disabled>
                                                Available
                                            </option>
                                            <option value="1" {{ $table->status ==1 ? "selected" : "" }}>Yes</option>
                                            <option value="0" {{ $table->status ==0 ? "selected" : "" }}>Non</option>
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
