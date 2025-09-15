<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\FrontendController;
use App\Http\Controllers\AdminDashboardController;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\RoomController;
use App\Http\Controllers\JapaneseAcademyController;
use App\Http\Controllers\MessManagementController;
use App\Http\Controllers\FeeManagementController;
use App\Http\Controllers\ReportsController;
use App\Http\Controllers\KitchenController;
use App\Http\Controllers\TeacherController;
use App\Http\Controllers\AttendanceController;
use App\Http\Controllers\ProfileController;

// Frontend Routes
Route::get('/', [FrontendController::class, 'index'])->name('home');
Route::get('/about', [FrontendController::class, 'about'])->name('about');
Route::get('/accomodation', [FrontendController::class, 'accomodation'])->name('accomodation');
Route::get('/gallery', [FrontendController::class, 'gallery'])->name('gallery');
Route::get('/blog', [FrontendController::class, 'blog'])->name('blog');
Route::get('/contact', [FrontendController::class, 'contact'])->name('contact');
Route::post('/apply', [FrontendController::class, 'store'])->name('frontend.apply');


// Admin Routes
Route::middleware(['auth', 'role.permission'])->prefix('admin')->name('admin.')->group(function () {
    
    // Dashboard & Sidebar
    Route::get('/dashboard', [AdminDashboardController::class, 'admindashboard'])->name('dashboard');
    Route::get('/sidebar', [AdminDashboardController::class, 'adminsidebar'])->name('sidebar');
    Route::get('/student/details/{id}', [AdminDashboardController::class, 'show'])->name('student.details');
    Route::get('/student/{id}/show', [AdminDashboardController::class, 'show'])->name('students.show');

    // Students Routes

        Route::get('/students', [StudentController::class, 'index'])->name('students.index');
        Route::get('/students/show/{id}', [StudentController::class, 'show'])->name('students.show');



        Route::get('/students/create', [StudentController::class, 'create'])->name('students.create');
        Route::post('/students/store', [StudentController::class, 'store'])->name('students.store');
        Route::get('/students/edit/{id}', [StudentController::class, 'edit'])->name('students.edit');
        Route::put('/students/update/{id}', [StudentController::class, 'update'])->name('students.update');
        Route::delete('/students/destroy/{id}', [StudentController::class, 'destroy'])->name('students.destroy');
        Route::get('/admin/students/{student}/form', [StudentController::class, 'showForm'])->name('students.form');


    // Rooms Routes

        Route::get('/rooms', [RoomController::class, 'index'])->name('rooms.index');
 


        Route::get('/rooms/create', [RoomController::class, 'create'])->name('rooms.create');
        Route::post('/rooms/store', [RoomController::class, 'store'])->name('rooms.store');
        Route::get('/rooms/edit/{id}', [RoomController::class, 'edit'])->name('rooms.edit');
        Route::put('/rooms/update/{id}', [RoomController::class, 'update'])->name('rooms.update');
        Route::delete('/rooms/destroy/{id}', [RoomController::class, 'destroy'])->name('rooms.destroy');
        Route::get('/room/{id}', [RoomController::class, 'show'])->name('room.details');
        Route::get('/room/{id}/book', [RoomController::class, 'create'])->name('room.book');



        Route::get('/academy', [JapaneseAcademyController::class, 'index'])->name('academy.index');
        Route::get('/academy/{id}', [JapaneseAcademyController::class, 'show'])->name('academy.show');
 

 
        Route::get('/academy/create', [JapaneseAcademyController::class, 'create'])->name('academy.create');
        Route::post('/academy/store', [JapaneseAcademyController::class, 'store'])->name('academy.store');
        Route::get('/academy/{id}/edit', [JapaneseAcademyController::class, 'edit'])->name('academy.edit');
        Route::put('/academy/{id}', [JapaneseAcademyController::class, 'update'])->name('academy.update');
        Route::delete('/academy/{id}', [JapaneseAcademyController::class, 'destroy'])->name('academy.destroy');
 

    
        Route::get('/teachers', [TeacherController::class, 'index'])->name('teachers.index');

        Route::get('/teachers/create', [TeacherController::class, 'create'])->name('teachers.create');
        Route::post('/teachers/store', [TeacherController::class, 'store'])->name('teachers.store');
        Route::get('/teachers/{id}/edit', [TeacherController::class, 'edit'])->name('teachers.edit');
        Route::put('/teachers/{id}', [TeacherController::class, 'update'])->name('teachers.update');
        Route::delete('/teachers/{id}', [TeacherController::class, 'destroy'])->name('teachers.destroy');
  


        Route::get('/mess', [MessManagementController::class, 'index'])->name('mess.index');

        Route::get('/mess/create', [MessManagementController::class, 'create'])->name('mess.create');
        Route::post('/mess/store', [MessManagementController::class, 'store'])->name('mess.store');
        Route::get('/mess/{id}/edit', [MessManagementController::class, 'edit'])->name('mess.edit');
        Route::put('/mess/{id}', [MessManagementController::class, 'update'])->name('mess.update');
        Route::delete('/mess/{id}', [MessManagementController::class, 'destroy'])->name('mess.destroy');

        Route::get('/fees', [FeeManagementController::class, 'index'])->name('fees.index');

        Route::get('/fees/create', [FeeManagementController::class, 'create'])->name('fees.create');
        Route::post('/fees/store', [FeeManagementController::class, 'store'])->name('fees.store');
        Route::get('/fees/{id}/edit', [FeeManagementController::class, 'edit'])->name('fees.edit');
        Route::put('/fees/{id}', [FeeManagementController::class, 'update'])->name('fees.update');
        Route::delete('/fees/{id}', [FeeManagementController::class, 'destroy'])->name('fees.destroy');
        Route::get('/fees/student-pending/{student}', [FeeManagementController::class, 'getStudentPendingFees'])->name('admin.fees.student-pending');
        Route::get('/fees/{id}', [FeeManagementController::class, 'show'])->name('fees.show');


        Route::get('/reports', [ReportsController::class, 'index'])->name('reports.index');
        Route::get('/reports/fees', [ReportsController::class, 'fees'])->name('reports.fees');


        Route::get('/reports/download', [ReportsController::class, 'download'])->name('reports.download');
        Route::get('/reports/fees/download', [ReportsController::class, 'feesDownload'])->name('reports.fees.download');

        Route::get('/kitchen', [KitchenController::class, 'index'])->name('kitchen.index');

        Route::post('/kitchen/store', [KitchenController::class, 'store'])->name('kitchen.store');
        Route::get('/kitchen/report', [KitchenController::class, 'report'])->name('kitchen.report');
        Route::get('/kitchen/export', [KitchenController::class, 'exportCsv'])->name('kitchen.export');
        Route::delete('/kitchen/delete/{id}', [KitchenController::class, 'destroy'])->name('kitchen.destroy');
        Route::get('/kitchen/{id}/edit', [KitchenController::class, 'edit'])->name('kitchen.edit');
        Route::put('/kitchen/{id}', [KitchenController::class, 'update'])->name('kitchen.update');


        Route::get('/attendance/mark', [AttendanceController::class, 'create'])->name('attendance.create');
        Route::post('/attendance/mark', [AttendanceController::class, 'store'])->name('attendance.store');

        Route::get('/attendance/daily', [AttendanceController::class, 'daily'])->name('attendance.daily');



        Route::get('/attendance/monthly', [AttendanceController::class, 'monthly'])->name('attendance.monthly');
        Route::get('/attendance/export/excel', [AttendanceController::class, 'exportExcel'])->name('attendance.export.excel');
        Route::get('/attendance/export/pdf', [AttendanceController::class, 'exportPDF'])->name('attendance.export.pdf');
         Route::delete('/attendance/bulk-delete', [AttendanceController::class, 'bulkDelete'])->name('attendance.bulkDelete');


}); // Main admin route group closing brace

// Profile Routes
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';