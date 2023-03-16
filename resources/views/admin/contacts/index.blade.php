@extends('layouts.app')
@section('title', 'Dappa | Dashboard')
@section('content')
<div class="main-content">
    <div class="section__content section__content--p30">
        <div class="container-fluid">
            <div class="row m-t-30">
                <div class="col-md-12">
                    <!-- DATA TABLE-->
                    <div class="table-responsive m-b-40">
                        <table class="table table-borderless table-data3">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Judul Buku</th>
                                    <th>Pengarang</th>
                                    <th>Penerbit</th>
                                    <th>Gambar</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($books as $key => $book)
                                <tr>
                                    <td>{{ ($books->currentPage()-1) * $books->perPage() + $loop->iteration }}</td>
                                    <td>{{ $book->judul }}</td>
                                    <td>{{ $book->pengarang }}</td>
                                    <td>{{ $book->penerbit }}</td>
                                    <td>
                                        @if ($book->gambar)
                                        <img src="{{Storage::url($book->gambar)}}" alt="{{ $book->judul }}" style="max-width: 100px;">
                                        @else
                                        No gambar
                                        @endif
                                    </td>
                                    <td>
                                        <a href="{{ route('buku.edit', $book->id) }}" class="btn btn-primary btn-sm">Edit</a>
                                        <a href="{{ route('buku.show', $book->id) }}" class="btn btn-info btn-sm">Show</a>

                                        <form action="{{ route('buku.destroy', $book->id) }}" method="POST" style="display: inline-block;">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure?')">Delete</button>
                                        </form>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>

                    </div>
                    <!-- END DATA TABLE-->
                </div>
            </div>
        </div>
    </div>
</div>
@endsection