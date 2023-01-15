@extends('layouts.app')

@section('content')
    <div class="content">
        <div class="row justify-content-center">
            <div class="col-md-10">
                <div class="card">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-4">
                                @include("layouts.sidebar")
                            </div>
                            <div class="col-md-8">
                                    <h3 class="text-secondary border-bottom border-2 mb-3">
                                        <i class="fa-sharp fa-solid fa-plus"> Add a Menu</i>
                                    </h3>
                                <form action="{{ route("menu.store") }}" method="post" enctype="multipart/form-data">
                                    @csrf
                                    <div class="form-group mb-3">
                                        <input type="text" name="title" id="title" class="form-control" placeholder="Title">
                                    </div>
                                    <div class="form-group mb-3">
                                        <textarea type="text" name="description" id="description" class="form-control" placeholder="Description"></textarea>
                                    </div>
                                    <div class="input-group mb-3">
                                        <input type="number" name="price" id="price" class="form-control" placeholder="Price">
                                        <span class="input-group-text">DH</span>
                                    </div>
                                    <div class="input-group mb-3">
                                        <span class="input-group-text" for="image">Image</span>
                                            <input type="file" name="image" id="image" class="form-control">
                                    </div>
                                    <div class="form-group mb-3">
                                        <select name="category_id" id="category_id" class="form-control">
                                            <option value="" selected disabled>
                                                Choose a category
                                            </option>
                                            @foreach ($categories as $category)
                                                <option value="{{ $category->id }}">{{ $category->title }}</option>
                                            @endforeach
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
