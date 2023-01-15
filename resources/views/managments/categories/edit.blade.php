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
                                        <i class="fa-sharp fa-solid fa-plus"> Edit the Category {{ $category->title }}</i>
                                    </h3>
                                <form action="{{ route("category.update", $category->slug) }}" method="post">
                                    @csrf
                                    @method("PUT")
                                    <div class="form-group mb-3">
                                        <input type="text" name="title" id="title" class="form-control"
                                         placeholder="Title" value="{{ $category->title }}">
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
