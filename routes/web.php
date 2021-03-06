<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\GuestController;
use App\Http\Controllers\EditionController;
use App\Http\Controllers\ExpenseController;
use App\Http\Controllers\MeetingController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\Auth\RaportsController;

Auth::routes();

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

// Route::get('/', function () {
//     if(Auth::user())
//         return view('user.home');
//     else
//         return view('guest.home');
// });

Route::get('/', [DashboardController::class, 'index'])->name('home');

Route::get('/logowanie', function () {
    return view('auth.login');
})->middleware('guest');

Route::get('/rejestracja', function () {
    return view('auth.register');
})->middleware('guest');

Route::prefix('admin')->group(function () {
    Route::get('/', [AdminController::class, 'index'])->name('admin');
    Route::get('/kursy', [AdminController::class, 'courses'])->name('admin.courses');
    Route::post('/kursy/nowy', [AdminController::class, 'newCourse'])->name('admin.courses.new');
    Route::get('/kurs/{id}', [AdminController::class, 'editions'])->name('admin.editions');
    Route::post('/kurs/{id}/nowa-edycja', [AdminController::class, 'newEdition'])->name('admin.editions.new');
    Route::get('/edycja/{id}', [AdminController::class, 'meetings'])->name('admin.meetings');
    Route::post('/edycja/{id}/nowe-spotkanie', [AdminController::class, 'newMeeting'])->name('admin.meetings.new');

    Route::get('/miejsca', [AdminController::class, 'places'])->name('admin.places');
    Route::post('/miejsca/nowy', [AdminController::class, 'newPlace'])->name('admin.places.new');

    Route::get('/raporty', [RaportsController::class, 'generateReports']);
    Route::post('/zarobki', [RaportsController::class, 'earnings']);
});

Route::prefix('edycja')->group(function () {
    Route::get('/{id}', [EditionController::class, 'index'])->name('edition');
    Route::post('/{id}/kup', [EditionController::class, 'buy'])->name('edition.buy')->middleware('auth');
});

Route::prefix('spotkanie')->group(function () {
    Route::get('/{id}', [MeetingController::class, 'index'])->name('meetings');
    Route::post('/{id}/store', [MeetingController::class, 'store'])->name('meetings.store');
});


Route::get('/goscie', [GuestController::class, 'index'])->name('guests');
Route::post('/goscie', [GuestController::class, 'store'])->name('guests.store');

Route::prefix('wydatki')->group(function () {
    Route::get('/', [ExpenseController::class, 'index']);
});


// Route::get('logowanie', [LoginController::class, 'showLoginForm']);
