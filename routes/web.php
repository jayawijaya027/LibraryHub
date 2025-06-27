<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Auth\LogoutController;
use App\Http\Controllers\BookController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\MemberController;
use App\Http\Controllers\LoanController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\PageController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// Captcha reload route
Route::get('/captcha/reload', function () {
    return response()->json(['captcha' => captcha_img()]);
})->name('captcha.reload');

// Landing Page
Route::get('/', [PageController::class, 'home'])->name('welcome');

// Static Pages
Route::get('/about', [PageController::class, 'about'])->name('about');

// Route Autentikasi
Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('/login', [LoginController::class, 'login']);
Route::post('/logout', [LogoutController::class, 'logout'])->name('logout');

// Route Registrasi
Route::get('/register', [RegisterController::class, 'showRegistrationForm'])->name('register');
Route::post('/register', [RegisterController::class, 'register']);

// Route profil pengguna (untuk semua role)
Route::middleware(['auth'])->group(function () {
    Route::get('/profile', [DashboardController::class, 'profile'])->name('profile');
    Route::get('/profile/edit', [DashboardController::class, 'editProfile'])->name('profile.edit');
    Route::put('/profile/update', [DashboardController::class, 'updateProfile'])->name('profile.update');
    Route::get('/profile/change-password', [DashboardController::class, 'showChangePassword'])->name('profile.password');
    Route::put('/profile/update-password', [DashboardController::class, 'changePassword'])->name('profile.password.update');
});

// Route yang membutuhkan autentikasi
Route::middleware(['auth', 'role:admin'])->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::get('/books/print', [BookController::class, 'print'])->name('books.print');
    Route::resource('categories', CategoryController::class);
    Route::resource('books', BookController::class);
    Route::resource('members', MemberController::class);
    Route::resource('loans', LoanController::class);
});

// Route khusus user
Route::middleware(['auth', 'role:user'])->group(function () {
    Route::get('/user/dashboard', [DashboardController::class, 'index'])->name('user.dashboard');
    Route::get('/user/loans', [LoanController::class, 'userIndex'])->name('user.loans.index');
    Route::get('/user/loans/create', [LoanController::class, 'userCreate'])->name('user.loans.create');
    Route::post('/user/loans', [LoanController::class, 'userStore'])->name('user.loans.store');
    Route::delete('/user/loans/{loan}/cancel', [LoanController::class, 'userCancel'])->name('user.loans.cancel');
});

Route::get('/reload-captcha', [App\Http\Controllers\Auth\LoginController::class, 'reloadCaptcha'])->name('captcha.reload');