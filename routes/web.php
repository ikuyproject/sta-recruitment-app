<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Student\FormController;
use Illuminate\Support\Facades\Route;

// --- Controllers สำหรับ Admin ---
use App\Http\Controllers\Admin\AuthenticatedSessionController as AdminSessionController;
use App\Http\Controllers\Admin\DashboardController as AdminDashboardController;
use App\Http\Controllers\Admin\ApplicationController as AdminApplicationController;
use App\Http\Controllers\Admin\InterestFormController as AdminInterestFormController;

// --- Controller สำหรับหน้าทั่วไป ---
use App\Http\Controllers\PageController;


/*
|--------------------------------------------------------------------------
| Web Routes (Public)
|--------------------------------------------------------------------------
*/

// ✅ หน้าแรก (Landing Page)
Route::get('/', function () {
    return view('welcome');
})->name('home');

// ✅ หน้า About Us / Our Team
Route::get('/about-us', [PageController::class, 'aboutUs'])->name('about-us');
Route::get('/our-team', [PageController::class, 'ourTeam'])->name('our-team');


/*
|--------------------------------------------------------------------------
| Student Routes (ผู้ใช้งานที่ Login แล้ว)
|--------------------------------------------------------------------------
*/
Route::middleware(['auth:student', 'verified'])->group(function () {

    // ✅ Dashboard นักศึกษา
    Route::get('/dashboard', function () { 
        return view('dashboard'); 
    })->name('dashboard');

    // ✅ ฟอร์มสมัครเรียน
    Route::get('/application-form', [FormController::class, 'createApplicationForm'])->name('application.form');
    Route::post('/application-form', [FormController::class, 'storeApplicationForm'])->name('application.form.store');

    // ✅ ฟอร์มความสนใจ
    Route::get('/interest-form', [FormController::class, 'createInterestForm'])->name('interest.form');
    Route::post('/interest-form', [FormController::class, 'storeInterestForm'])->name('interest.form.store');

    // ✅ โปรไฟล์ผู้ใช้
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});


/*
|--------------------------------------------------------------------------
| Admin Routes (FacultyStaff)
|--------------------------------------------------------------------------
*/
Route::prefix('admin')->name('admin.')->group(function () {

    // ✅ Logout
    Route::post('/logout', [AdminSessionController::class, 'destroy'])
         ->middleware('auth:faculty_staff')
         ->name('logout');

    // ✅ Dashboard (สำหรับ Admin)
    Route::get('/dashboard', [AdminDashboardController::class, 'index'])
         ->middleware('auth:faculty_staff')
         ->name('dashboard');

    // ✅ จัดการใบสมัคร
    Route::get('/applications', [AdminApplicationController::class, 'index'])
         ->middleware('auth:faculty_staff')
         ->name('applications.index');

    Route::get('/applications/{application}', [AdminApplicationController::class, 'show'])
         ->middleware('auth:faculty_staff')
         ->name('applications.show');

    Route::post('/applications/{application}/update-status', [AdminApplicationController::class, 'updateStatus'])
         ->middleware('auth:faculty_staff')
         ->name('applications.update-status');

    // ✅ แบบสอบถามความสนใจ
    Route::get('/interest-forms', [AdminInterestFormController::class, 'index'])
         ->middleware('auth:faculty_staff')
         ->name('interest-forms.index');
});


// ✅ Breeze Auth Routes (Login / Register / Forgot Password)
require __DIR__.'/auth.php';
