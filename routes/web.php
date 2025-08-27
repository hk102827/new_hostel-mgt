<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\FrontendController;
use App\Http\Controllers\AdminDashboardController;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\RoomController;
use App\Http\Controllers\JapaneseAcademyController;
use App\Http\Controllers\MessManagementController;
use App\Http\Controllers\FeeManagementController;


// Route::get('/', function () {
//     return view('welcome');
// });

Route::get('/', [FrontendController::class, 'index'])->name('home');
Route::get('/about', [FrontendController::class, 'about'])->name('about');
Route::get('/accomodation', [FrontendController::class, 'accomodation'])->name('accomodation');
Route::get('/gallery', [FrontendController::class, 'gallery'])->name('gallery');
Route::get('/contact', [FrontendController::class, 'contact'])->name('contact');
// Admin route
// Admin Routes
Route::middleware(['auth'])->prefix('admin')->as('admin.')->group(function () {
        Route::get('/dashboard', [AdminDashboardController::class, 'admindashboard'])->name('dashboard');
        Route::get('/sidebar', [AdminDashboardController::class, 'adminsidebar'])->name('sidebar');

        // Students
        Route::get('/students', [StudentController::class, 'index'])->name('students.index');
        Route::get('/students/create', [StudentController::class, 'create'])->name('students.create');
        Route::post('/students/store', [StudentController::class, 'store'])->name('students.store');
        Route::get('/students/edit/{id}', [StudentController::class, 'edit'])->name('students.edit');
        Route::put('/students/update/{id}', [StudentController::class, 'update'])->name('students.update');
        Route::delete('/students/destroy/{id}', [StudentController::class, 'destroy'])->name('students.destroy');

        // Rooms
        Route::get('/rooms', [RoomController::class, 'index'])->name('rooms.index');
        Route::get('/rooms/create', [RoomController::class, 'create'])->name('rooms.create');
        Route::post('/rooms/store', [RoomController::class, 'store'])->name('rooms.store');
        Route::get('/rooms/edit/{id}', [RoomController::class, 'edit'])->name('rooms.edit');
        Route::put('/rooms/update/{id}', [RoomController::class, 'update'])->name('rooms.update');
        Route::delete('/rooms/destroy/{id}', [RoomController::class, 'destroy'])->name('rooms.destroy');

        // Academy
        Route::get('/academy', [JapaneseAcademyController::class, 'index'])->name('academy.index');
        Route::get('/academy/create', [JapaneseAcademyController::class, 'create'])->name('academy.create');
        Route::post('/academy/store', [JapaneseAcademyController::class, 'store'])->name('academy.store');
        Route::get('/academy/{id}', [JapaneseAcademyController::class, 'show'])->name('academy.show');
        Route::get('/academy/{id}/edit', [JapaneseAcademyController::class, 'edit'])->name('academy.edit');
        Route::put('/academy/{id}', [JapaneseAcademyController::class, 'update'])->name('academy.update');
        Route::delete('/academy/{id}', [JapaneseAcademyController::class, 'destroy'])->name('academy.destroy');

        // Mess
        Route::get('/mess', [MessManagementController::class, 'index'])->name('mess.index');
        Route::get('/mess/create', [MessManagementController::class, 'create'])->name('mess.create');
        Route::post('/mess/store', [MessManagementController::class, 'store'])->name('mess.store');
        Route::get('/mess/{id}/edit', [MessManagementController::class, 'edit'])->name('mess.edit');
        Route::put('/mess/{id}', [MessManagementController::class, 'update'])->name('mess.update');
        Route::delete('/mess/{id}', [MessManagementController::class, 'destroy'])->name('mess.destroy');

        // Fees
        Route::get('/fees', [FeeManagementController::class, 'index'])->name('fees.index');
        Route::get('/fees/create', [FeeManagementController::class, 'create'])->name('fees.create');
        Route::post('/fees/store', [FeeManagementController::class, 'store'])->name('fees.store');
        Route::get('/fees/{id}/edit', [FeeManagementController::class, 'edit'])->name('fees.edit');
        Route::put('/fees/{id}', [FeeManagementController::class, 'update'])->name('fees.update');
        Route::delete('/fees/{id}', [FeeManagementController::class, 'destroy'])->name('fees.destroy');

        // Reports
        Route::get('/reports', [ReportsController::class, 'index'])->name('reports.index');
    });





// Route::get('/dashboard', function () {
//     return view('layouts.admin');
// })->middleware(['auth', 'verified'])->name('dashboard');



Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';


