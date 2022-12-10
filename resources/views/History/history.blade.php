@extends('layouts.master')

@section('main')
    <div class="modal fade" id="modalAdd" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header bg-primary">
                    <h2 class="modal-title" style="color: white">Add Form</h2>
                    <button style="color: white" type="button" class="" data-bs-dismiss="modal"
                        aria-label="Close"></button>
                </div>
                <form action={{ url('/product-create') }} id="formAdd" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="modal-body container">
                        <div class="col-md-12">
                            <div class="form-floating">
                                <input type="text" class="form-control mt-2" placeholder="Name" name="name">
                                <label for="floatingName">Name</label>
                            </div>
                        </div>
                        <div class="my-2">
                            <label for="image" class="form-label">Upload Image</label>
                            <input class="form-control @error('image') is-invalid @enderror" type="file" id="image"
                                name="image">
                            @error('image')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class="col-md-12">
                            <div class="form-floating">
                                <input type="number" class="form-control mt-2" placeholder="" name="stock">
                                <label for="floatingStock">Stock</label>
                            </div>
                        </div>
                        <div class="form-group">
                            <label>Description</label>
                            <textarea rows="10" class="form-control @error('description') is-invalid @enderror" id="description"
                                name="description" value="{{ old('descriptiom') }}"></textarea>
                            @error('description')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

                        <div class="modal-footer">
                            <button type="submit" class="btn btn-primary btn_add mt-3">Submit</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>

    @foreach ($data as $product)
        <div class="modal fade" id="modalEdit" tabindex="-1" aria-hidden="true">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header bg-primary">
                        <h2 class="modal-title" style="color: white">Add Form</h2>
                        <button style="color: white" type="button" class="" data-bs-dismiss="modal"
                            aria-label="Close"></button>
                    </div>
                    <form action="{{ url('/product-delete/' . $product->id) }}" method="POST"
                        enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <div class="form-group">
                            <label>Name</label>
                            <input type="text" class="form-control @error('name') is-invalid @enderror" id="name"
                                name="name" value="{{ $product->name }}">
                            @error('name')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label>Stock</label>
                            <input type="number" class="form-control @error('stock') is-invalid @enderror" id="stock"
                                name="stock" value="{{ $product->stock }}">
                            @error('stock')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class="mb-2">
                            <label for="image" class="form-label">Upload Image</label>
                            <input class="form-control @error('image') is-invalid @enderror" type="file" id="image"
                                name="image">
                            @error('title')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label>Description</label>
                            <textarea rows="10" class="form-control @error('description') is-invalid @enderror" id="description"
                                name="description">{{ $product->description }}</textarea>
                            @error('description')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <button type="submit" class="btn btn-primary float-end mt-2">submit</button>
                    </form>
                </div>
            </div>
        </div>
    @endforeach

    @foreach ($data as $product)
        <div class="modal fade" id="modalDelete{{ $product->id }}" tabindex="-1" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header bg-danger">
                        <h2 class="modal-title" style="color: white">Delete</h2>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body mx-5 mb-3">
                        <span class="warning">
                            <img src="assets/images/warning.png">
                        </span>
                        <h2 style="text-align: center"> Are you sure want to delete this task? </h2>
                    </div>
                    <div class="modal-footer">
                        <form action="{{ url('/product-delete/' . $product->id) }}" method="POST">
                            @csrf
                            @method('delete')
                            <button type="submit" class="btn btn-danger"><i class="bx bx-trash"></i>
                                Delete
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    @endforeach
    {{-- 
    <h1 class="mt-4">All product
        <button class="btn btn-primary mb-3" data-bs-toggle="modal" data-bs-target="#modalAdd"><i
            class="bx bx-list-plus"></i> Add+</button>
        </h1>
        
        <div class="container-fluid pt-4" style="background-color: rgb(240, 240, 240)">
        @unless(count($data))
            <p>No product</p>
        @endunless

        <div class="row mt-4">
            @if (count($data))
                @foreach ($data as $product)
                    <div class="col-md-4 mb-5">
                        <div class="card" style="background-color: rgb(136, 153, 131)">
                            <img class="card-img" style="height:270px" src="{{ asset('/storage/' . $product->image) }}">
                            <div class="card-body">
                                {{-- <h1><a class="title" href="{{ route('productshow', $product->id) }}"> n {{ $product->title }}</a>
                            </h1> --}}
    {{-- <h1 style="color:aliceblue;">{{ $product->name }}</h1>
                                <h4 style="color:aliceblue;">Stock: {{ $product->stock }}</h4>
                                <p style="color:aliceblue;">{{ Str::limit($product->description, 150) }}</p>
                                <a href="{{ url('/product/' . $product->id) }}" class="btn btn-warning"><i
                                        class="bx bx-detail"></i> Detail</a>
                                <button class="btn btn-danger" data-bs-toggle="modal"
                                    data-bs-target="#modalDelete{{ $product->id }}">Delete</button>
                                {{-- <a href="{{ route('product-edit', $product->id) }}" class="btn btn-primary btn-sm"><i
                                        class="bi bi-pencil-square mt-1"></i></a> --}}
    {{-- @endhasrole 
                            </div>
                        </div>
                    </div>
                @endforeach
            @endif
        </div> --}}


    <div class="container-fluid">
        <div class="row">
            <div class="py-3">
                <h1>Product</h1>
            </div>
            <div class="card shadow mb-5">
                <div class="card-body">
                    <button class="btn btn-primary mb-3" data-bs-toggle="modal" data-bs-target="#modalAdd"><i
                            class="bx bx-list-plus"></i> Add+</button>
                    <table class="table table-striped" id="table1">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Image</th>
                                <th>Name</th>
                                <th>Stock</th>
                                <th>Subject</th>

                        </thead>
                        <tbody>
                            @php
                                $no = 1;
                            @endphp

                            @foreach ($data as $product)
                                <tr>
                                    <td>{{ $no++ }}</td>
                                    <td>
                                        <img class="card-img" style="max-height:140px; max-width:200px"
                                            src="{{ asset('/storage/' . $product->image) }}">
                                    </td>
                                    <td>{{ $product->name }}</td>
                                    <td>{{ $product->stock }}</td>
                                    <td>
                                        <button class="btn btn-primary" data-bs-toggle="modal"
                                            data-bs-target="#modalEdit">Edit</button>
                                        <button class="btn btn-outline-danger pb-2" data-bs-toggle="modal"
                                            dasta-bs-target="#modalDelete{{ $product->id }}">Delete</button>
                                    </td>
                                </tr>
                            @endforeach

                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
