<?php

use App\Http\Controllers\ApplicantController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\JobController;
use App\Http\Middleware\Login;

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('auth.login');
});

Route::get('/login', [AuthController::class, 'showLogin'])->name('show.login');
Route::get('/signup', [AuthController::class, 'showSignup'])->name('show.signup');

Route::post('/login', [AuthController::class, 'login'])->name('login');
Route::post('/signup', [AuthController::class, 'signup'])->name('signup');

Route::middleware('auth')->group(function () {
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
    Route::get('/dashboard', [DashboardController::class, 'authenticated'])->name('dashboard');
    // Job Admin
    Route::get('/jobs', [JobController::class, 'job_listings'])->name('show.jobs');
    Route::post('/jobs/create', [JobController::class, 'create_job'])->name('create.job');
    Route::put('/jobs/{job}/update', [JobController::class, 'update_job'])->name('update.job');
    Route::delete('/jobs/{job}/delete', [JobController::class, 'delete_job'])->name('delete.job');
    // Job User
    Route::post('/job/apply', [JobController::class, 'apply_job'])->name('apply.job');
    // Applicant
    Route::get('/applicants', [ApplicantController::class, 'applicants'])->name('show.applicants');

});

// Route::middleware('auth', Login::class . ':admin')->group(function () {
//     Route::get('/admin/dashboard', [DashboardController::class, 'admin'])->name('admin.dashboard');
// });

// Route::middleware('auth', Login::class . ':applicant,employee')->group(function () {
//     Route::get('/user/dashboard', [DashboardController::class, 'user'])->name('user.dashboard');
// });