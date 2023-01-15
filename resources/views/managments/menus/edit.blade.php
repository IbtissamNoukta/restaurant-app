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
                                        <i class="fa-sharp fa-solid fa-plus"> Edit the {{ $menu->name }} menu</i>
                                    </h3>
                                <form action="{{ route("menu.update", $menu->slug) }}" method="post" enctype="multipart/form-data">
                                    @csrf
                                    @method("PUT")
                                    <div class="form-group mb-3">
                                        <input type="text" name="title" id="title" class="form-control"
                                         placeholder="Title" value="{{ $menu->title }}">
                                    </div>
                                    <div class="form-floating mb-3">
                                        <textarea type="text" name="description" id="description" class="form-control"
                                         placeholder="Description">{{ $menu->description }}</textarea>
                                         <label for="floatingInput">Description</label>
                                    </div>
                                    <div class="form-group mb-3">
                                        <input type="float" name="price" id="price" class="form-control"
                                         placeholder="Price" value="{{ $menu->price }}">
                                    </div>
                                    <div class="my-2">
                                        <img src="{{ asset('images/menus/'. $menu->image) }}" alt="{{ $menu->title }}"
                                                class="fluid rounded" width="100" height="100">
                                    </div>
                                    <div class="form-group mb-3">
                                        <input type="file" name="image" id="image" class="form-control">
                                    </div>
                                    <div class="form-group mb-3">
                                        <select name="category_id" id="category_id" class="form-control">
                                            <option value="" disabled>
                                                Choose a category
                                            </option>
                                            @foreach ($categories as $category)
                                                <option value="{{ $category->id }}" {{ $category->id  == $menu->category_id ? "selected" : ""  }}>{{ $category->title }}</option>
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
