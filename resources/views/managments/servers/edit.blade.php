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
                                        <i class="fa-sharp fa-solid fa-plus"> Edit {{ $servant->name }} Servant</i>
                                    </h3>
                                <form action="{{ route("servant.update", $servant->id) }}" method="post">
                                    @csrf
                                    @method("PUT")
                                    <div class="form-group mb-3">
                                        <input type="text" name="name" id="name" class="form-control"
                                         placeholder="Name" value="{{ $servant->name }}">
                                    </div>
                                    <div class="form-group mb-3">
                                        <input type="adress" name="adress" id="adress" class="form-control"
                                         placeholder="Adress" value="{{ $servant->adress }}">
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
