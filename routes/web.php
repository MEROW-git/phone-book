<?php

use App\Http\Controllers\ContactController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::get('/dashboard', function () {
    return redirect()->route('contacts.index');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::redirect('/', '/contacts');
    Route::resource('contacts', ContactController::class)->except(['show']);
    Route::get('/contacts/{contact}', fn () => redirect()->route('contacts.index'));
    Route::redirect('/phonebook', '/contacts')->name('phonebook.index');

    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';

Route::fallback(function () {
    return redirect()->route(auth()->check() ? 'contacts.index' : 'login');
});
