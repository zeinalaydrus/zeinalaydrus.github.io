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
                <form action={{ url('/keluar-raw-create') }} id="formAdd" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="modal-body container">
                        <div class="col-md-12">
                            <label for="raw" class="form-label">Product</label>
                            <select name="raw_id" class="form-select" aria-label="Default select example">
                                @foreach ($data as $raw)
                                    <option value="{{ $raw->id }}">{{ $raw->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-12">
                            <div class="form-floating">
                                <input type="number" class="form-control mt-2" placeholder="" name="stock">
                                <label for="floatingStock">Quantity</label>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-floating">
                                <input type="date" class="form-control mt-2" placeholder="" name="tanggal_keluar">
                                <label for="floatingStock">Tanggal Masuk</label>
                            </div>
                        </div>
                        <div class="my-2">
                            <label for="image" class="form-label">Bukti Outvoice</label>
                            <input class="form-control @error('image') is-invalid @enderror" type="file" id="image"
                                name="bukti">
                            @error('image')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="deskripsi">Deskripsi</label>
                            <textarea class="form-control" rows="5" id="deskripsi" name="description"></textarea>
                        </div>
                        <div class="modal-footer">
                            <button type="submit" class="btn btn-primary btn_add mt-3">Submit</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>



    @foreach ($data as $item)
        <div class="modal fade" id="modalDelete{{ $item->id }}" tabindex="-1" aria-hidden="true">
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
                        <form action="{{ url('/item-delete/' . $item->id) }}" method="POST">
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


    <div class="container-fluid">
        <div class="row">
            <div class="py-3">
                <h1>Barang Keluar</h1>
            </div>
            <div class="card shadow mb-5">
                <div class="card-body">
                    <button class="btn btn-primary mb-3" data-bs-toggle="modal" data-bs-target="#modalAdd"><i
                            class="bx bx-list-plus"></i> Add+</button>
                    <table class="table table-striped" id="table1">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Bukti Invoice</th>
                                <th>Product</th>
                                <th>Quantity</th>
                                <th>Tanggal Masuk</th>
                                <th>Deskripsi</th>
                                <th>Subjek</th>
                        </thead>
                        <tbody>
                            @php
                                $no = 1;
                            @endphp


                            @foreach ($data as $raw)
                                @foreach ($raw->pengeluaranraws as $item)
                                    <tr>
                                        <td>{{ $no++ }}</td>
                                        <td>
                                            <img class="card-img" style="max-height:140px; max-width:200px"
                                                src="{{ asset('/storage/bukti/'. $item->bukti)}}">
                                        </td> 
                                        <td>{{ $raw->name}}</td>                                       
                                        <td>{{ $item->stock }}</td>
                                        <td>{{ $item->tanggal_keluar }}</td>
                                        <td>{{ $item->description }}</td>
                                        <td>
                                            <a href="{{ url('/item/' . $item->id) }}" class="btn btn-outline-info"><i
                                                    class="bx bx-detail"></i> Detail</a>
                                            <button class="btn btn-outline-danger" data-bs-toggle="modal"
                                                data-bs-target="#modalDelete{{ $item->id }}">Delete</button>
                                        </td>
                                    </tr>
                                @endforeach
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
