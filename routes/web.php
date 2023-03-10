<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BookController;
use App\Http\Controllers\HomeController;
use Illuminate\Support\Facades\Auth;

// Route::get('/', function () {
//     return view('index', [
//         "title" => "Beranda"
//     ]);
// });

Route::get('/gallery', function () {
    return view('gallery', [
        'title' => 'Gallery'
    ]);
});

// // Route::get('/contacts', function () {
//     return view('contacts', [
//         'title' => 'Contacts'
//     ]);
// // });

//Route::resource('/contacts', ContactController::class);

// Route::get('/contacts/create', [BookController::class, 'create'])->name('contacts.create');
// Route::post('/contacts/store', [BookController::class, 'store'])->name('contacts.store');

Route::get('/', [BookController::class, 'indexPublic'])->name('buku.public.index');
Route::get('/books/{id}', [BookController::class, 'showPublic'])->name('buku.public.show');

Auth::routes();


Route::group(['middleware' => ['auth']], function(){
    Route::get('/home', [HomeController::class, 'index'])->name('home');
    Route::resource('buku', BookController::class);
});
