@extends('layouts.app')

@section('content')
    <div class="content">
        <div class="row justify-content-center">
            <div class="col-md-10">
                <div class="row">
                    <div class="col-md-10 mb-3">
                        <div class="form-groupe">
                            <a href="/dashboard" class="btn btn-outline-secondary">
                                <i class="fa fa-chevron-left"></i>
                            </a>
                        </div>
                    </div>
                </div>
                <div class="card">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-4">
                                @include("layouts.sidebar")
                            </div>
                            <div class="col-md-8">
                                {{-- d-flex flex-row justify-content-center align-items-between border-buttom pd-1 --}}
                                <div class="d-flex justify-content-between border-bottom border-2">
                                    <h3 class="text-secondary">
                                        <i class="fa-sharp fa-solid fa-list"></i>
                                        Categories
                                    </h3>
                                    <a href="{{ route("category.create") }}" class="btn btn-primary">
                                        <i class="fas fa-plus fa-x2"></i>
                                    </a>
                                </div>
                                <table class="table table-hover table-responsive-sm">
                                    <thead>
                                        <tr>
                                            <th>Id</th>
                                            <th>Titre</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($categories as $category)
                                        <tr>
                                            <td>
                                                {{ $category->id }}
                                            </td>
                                            <td>
                                                {{ $category->title }}
                                            </td>
                                            <td>
                                                <div class="d-flex flex-row align-items-center">
                                                    <a href="{{ route("category.edit",$category->slug) }}" class="btn btn-warning me-2">
                                                        <i class="fas fa-edit"></i>
                                                    </a>
                                                    <form  id="{{ $category->id }}" action="{{ route("category.destroy",$category->slug) }}" method="post">
                                                        @csrf
                                                        @method("DELETE")
                                                        <button onclick="
                                                            event.preventDefault();
                                                            if(confirm('are u sur u wanna delete the {{ $category->title }} category? '))
                                                            document.getElementById({{ $category->id }}).submit();"
                                                            class="btn btn-danger">
                                                                <i class="fas fa-trash"></i>
                                                        </button>
                                                    </form>
                                                </div>
                                            </td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                                <div class="my-3 d-flex justify-content-center align-items-center">
                                    {{ $categories->links() }}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
