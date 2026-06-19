<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Candidate\JobApplicationController;
use App\Http\Controllers\Candidate\JobController;
use App\Http\Controllers\Employer\ApplicationController;
use App\Http\Controllers\Employer\JobPostController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Public Routes
|--------------------------------------------------------------------------
*/

// الصفحة الرئيسية (تعرض الوظائف)
Route::get('/', [JobController::class, 'landing'])->name('home');

// عرض تفاصيل الوظيفة (بدون تسجيل دخول)
Route::get('/jobs/{job}', [JobController::class, 'publicShow'])->name('jobs.show');


/*
|--------------------------------------------------------------------------
| General Dashboard (Redirect by Role)
|--------------------------------------------------------------------------
*/
Route::middleware(['auth', 'verified','active', 'role.redirect'])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');
});


/*
|--------------------------------------------------------------------------
| Admin Routes
|--------------------------------------------------------------------------
*/
Route::middleware(['auth', 'verified', 'active', 'role:admin'])
    ->prefix('admin')
    ->name('admin.')
    ->group(function () {

        Route::get('/dashboard', function () {
            return view('admin.dashboard');
        })->name('dashboard');

        Route::get('/users', [\App\Http\Controllers\Admin\UserController::class, 'index'])->name('users.index');
        Route::patch('/users/{user}/toggle-status', [\App\Http\Controllers\Admin\UserController::class, 'toggleStatus'])->name('users.toggle-status');

        Route::get('/job-posts', [\App\Http\Controllers\Admin\JobPostController::class, 'index'])->name('job-posts.index');
        Route::get('/job-posts/{job}', [\App\Http\Controllers\Admin\JobPostController::class, 'show'])->name('job-posts.show');
        Route::delete('/job-posts/{job}', [\App\Http\Controllers\Admin\JobPostController::class, 'destroy'])->name('job-posts.destroy');
        
        Route::patch('/job-posts/{job}/approve', [\App\Http\Controllers\Admin\JobPostController::class, 'approve'])->name('job-posts.approve');
        Route::patch('/job-posts/{job}/reject', [\App\Http\Controllers\Admin\JobPostController::class, 'reject'])->name('job-posts.reject');

        Route::resource('job-categories', \App\Http\Controllers\Admin\JobCategoryController::class)->except(['show']);
    });


/*
|--------------------------------------------------------------------------
| Employer Routes
|--------------------------------------------------------------------------
*/
Route::middleware(['auth', 'verified', 'active', 'role:employer'])
    ->prefix('employer')
    ->name('employer.')
    ->group(function () {

        Route::get('/dashboard', function () {
            return view('employer.dashboard');
        })->name('dashboard');

        Route::resource('job-posts', JobPostController::class)->parameters([
            'job-posts' => 'jobPost',
        ]);

        Route::get('/applications', [ApplicationController::class, 'index'])->name('applications.index');
        Route::patch('/applications/{application}/status', [ApplicationController::class, 'updateStatus'])->name('applications.update-status');
    });


/*
|--------------------------------------------------------------------------
| Candidate Routes
|--------------------------------------------------------------------------
*/
Route::middleware(['auth', 'verified', 'active', 'role:candidate'])
    ->prefix('candidate')
    ->name('candidate.')
    ->group(function () {

        Route::get('/dashboard', function () {
            return view('candidate.dashboard');
        })->name('dashboard');

        // عرض الوظائف (بعد تسجيل الدخول)
        Route::get('/jobs', [JobController::class, 'index'])->name('jobs.index');
        Route::get('/jobs/{job}', [JobController::class, 'show'])->name('jobs.show');

        // التقديم على وظيفة (يحتاج تسجيل دخول)
        Route::post('/jobs/{job}/apply', [JobApplicationController::class, 'store'])->name('jobs.apply');

        // طلبات المستخدم
        Route::get('/applications', [JobApplicationController::class, 'index'])->name('applications.index');
    });


/*
|--------------------------------------------------------------------------
| Profile Routes
|--------------------------------------------------------------------------
*/
Route::middleware(['auth','active'])->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::patch('/profile/extra', [ProfileController::class, 'updateExtra'])->name('profile.extra.update');
});

require __DIR__.'/auth.php';
