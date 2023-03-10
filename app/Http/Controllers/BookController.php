<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Models\Book;

class BookController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        // $books = Book::paginate(10);

        // return view('admin/contacts/index', compact('books'));
        $search = $request->query('search');

        $books = Book::orderBy('id', 'desc')
            ->when($search, function ($query, $search) {
                return $query->where('judul', 'like', '%' . $search . '%')
                    ->orWhere('pengarang', 'like', '%' . $search . '%')
                    ->orWhere('penerbit', 'like', '%' . $search . '%');
            })
            ->paginate(10);

        return view('admin/contacts/index', compact('books'));
    }

    public function indexPublic(Request $request)
    {
        $search = $request->get('search');

        $books = Book::where('judul', 'like', "%$search%")
            ->orWhere('pengarang', 'like', "%$search%")
            ->orWhere('penerbit', 'like', "%$search%")
            ->orderBy('created_at', 'desc')
            ->paginate(10);

        // return view('index', compact('books'));
        return view('index', ["title" => "Beranda"], compact('books'));
    }

    public function showPublic($id)
    {
        $book = Book::where('id', $id)->first();

        if ($book) {
            return view('show', compact('book'));
        } else {
            abort(404);
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin/contacts/create', [
            "title" => "Book"
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'judul' => 'required',
            'penerbit' => 'required',
            'pengarang' => 'required',
            'gambar' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        $gambar = null;
        if ($request->hasFile('gambar')) {
            $gambar = $request->file('gambar')->store('public');
            $gambar =  str_replace('public/', '', $gambar);
        }

        $book = new Book([
            'judul' => $request->get('judul'),
            'penerbit' => $request->get('penerbit'),
            'pengarang' => $request->get('pengarang'),
            'gambar' => $gambar,
        ]);

        $book->save();

        return redirect()->route('buku.index')->with('success', 'Data buku berhasil ditambahkan');
    }


    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $book = Book::findOrFail($id);
        return view('admin.contacts.show', compact('book'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $book = Book::findOrFail($id);
        return view('admin.contacts.edit', compact('book'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
{
    $request->validate([
        'judul' => 'required',
        'penerbit' => 'required',
        'pengarang' => 'required',
        'gambar' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
    ]);

    $book = Book::find($id);

    if ($request->hasFile('gambar')) {
        if ($book->gambar) {
            Storage::delete('public/' . $book->gambar);
        }
        $gambar = $request->file('gambar')->store('public');
        $gambar = str_replace('public/', '', $gambar);
        $book->gambar = $gambar;
    }

    $book->judul = $request->judul;
    $book->penerbit = $request->penerbit;
    $book->pengarang = $request->pengarang;
    $book->save();

    return redirect()->route('buku.index')->with('success', 'Data buku berhasil diperbarui');
}



    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $book = Book::findOrFail($id);
        $book->delete();

        return redirect()->route('buku.index');
    }
}
