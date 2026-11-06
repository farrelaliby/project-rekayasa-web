<?php

use App\Http\Controllers\ProjectController;
use App\Http\Controllers\AdminProjectController;
use App\Http\Controllers\Auth\AdminAuthController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('page.home');
})->name('home');

// Halaman projects public
Route::get('/project', [ProjectController::class, 'index'])->name('project');
Route::get('/project/{id}', [ProjectController::class, 'show'])->name('project.show');

// Halaman about
Route::get('/about', function () {
    return view('page.about');
})->name('about');

// Halaman profile / mahasiswa
Route::get('/profile', function () {
    $mahasiswa = [
        'nama' => 'Muhammad Farrel Aliby',
        'nim' => '251011700291',
        'prodi' => 'Information Systems (03SIFE003)',
        'kampus' => 'Universitas Pamulang',
        'status' => 'Aktif',
    ];
    return view('page.profile', compact('mahasiswa'));
})->name('profile');

// Halaman contact
Route::get('/contact', function () {
    return view('page.contact');
})->name('contact');

Route::post('/contact', function () {
    return redirect()->route('contact')->with('success', 'Pesan berhasil dikirim!');
})->name('contact.submit');

Route::get('/admin/login', [AdminAuthController::class, 'showLoginForm'])->name('login');
Route::post('/admin/login', [AdminAuthController::class, 'login'])->name('admin.login');
Route::post('/admin/logout', [AdminAuthController::class, 'logout'])->name('admin.logout');

// Admin Routes Group
Route::prefix('admin')->middleware('auth')->group(function () {
    Route::get('/', function () {
        return view('admin.dashboard');
    })->name('admin.dashboard');

    Route::resource('projects', AdminProjectController::class);
});