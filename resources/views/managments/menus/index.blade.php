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
                                {{-- d-flex flex-row justify-content-center align-items-between border-buttom pd-1 --}}
                                <div class="d-flex justify-content-between border-bottom border-2">
                                    <h3 class="text-secondary">
                                        <i class="fa-sharp fa-solid fa-clipboard-list"></i>
                                        Menus
                                    </h3>
                                    <a href="{{ route("menu.create") }}" class="btn btn-primary">
                                        <i class="fas fa-plus fa-x2"></i>
                                    </a>
                                </div>
                                <table class="table table-hover table-responsive-sm">
                                    <thead>
                                        <tr>
                                            <th>Id</th>
                                            <th>Title</th>
                                            <th>Description</th>
                                            <th>Price</th>
                                            <th>Image</th>
                                            <th>Category</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($menus as $menu)
                                        <tr>
                                            <td>
                                                {{ $menu->id }}
                                            </td>
                                            <td>
                                                {{ $menu->title }}
                                            </td>
                                            <td>
                                                {{ Str::limit($menu->description, 100); }}
                                            </td>
                                            <td>
                                                {{ $menu->price }} DH
                                            </td>
                                            <td>
                                                <img src="{{ asset('images/menus/'. $menu->image) }}" alt="{{ $menu->title }}"
                                                class="fluid rounded" width="60" height="60">
                                            </td>
                                            <td>
                                                {{  $menu->category->title  }}
                                            </td>
                                            <td class="flex-row align-items-center">
                                                <a href="{{ route("menu.edit",$menu->id) }}" class="btn btn-warning">
                                                    <i class="fas fa-edit"></i>
                                                </a>
                                                <form  id="{{ $menu->id }}" action="{{ route("menu.destroy",$menu->slug) }}" method="post">
                                                    @csrf
                                                    @method("DELETE")
                                                    <button onclick="
                                                        event.preventDefault();
                                                        if(confirm('are u sur u wanna delete {{ $menu->title }} menu? '))
                                                        document.getElementById({{ $menu->id }}).submit();"
                                                        class="btn btn-danger">
                                                            <i class="fas fa-trash"></i>
                                                    </button>
                                                </form>
                                            </td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                                <div class="my-3 d-flex justify-content-center align-items-center">
                                    {{ $menus->links() }}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
