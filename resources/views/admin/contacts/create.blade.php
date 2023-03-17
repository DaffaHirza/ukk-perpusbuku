@extends('layouts.app')
@section('title', 'Dappa | New Book')
@section('content')
<div class="main-content">
    <div class="section__content section__content--p30">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-8 col-md-offset-2">
                    <h1>Add New Book</h1>
                    <hr>

                    <!-- Display error messages if there are any -->
                    @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                    @endif

                    <!-- Create book form -->
                    <form action="{{ route('buku.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group">
                            <label for="judul">judul</label>
                            <input type="text" class="form-control" id="judul" name="judul" value="{{ old('judul') }}">
                        </div>
                        <div class="form-group">
                            <label for="pengarang">pengarang</label>
                            <input type="text" class="form-control" id="pengarang" name="pengarang" value="{{ old('pengarang') }}">
                        </div>
                        <div class="form-group">
                            <label for="penerbit">penerbit</label>
                            <input type="text" class="form-control" id="penerbit" name="penerbit" value="{{ old('penerbit') }}">
                        </div>
                        <div class="form-group">
                            <label for="gambar">Image</label>
                            <input type="file" class="form-control-file" id="gambar" name="gambar" onchange="previewImage()">
                        </div>
                        <button type="submit" class="btn btn-primary">Add Book</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection