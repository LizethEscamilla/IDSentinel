<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TeacherController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\AccessRecordController;
use App\Http\Controllers\StatisticsController;
use App\Http\Controllers\SubjectController;
use App\Http\Controllers\SoftwareTypeController;
use App\Http\Controllers\CareerGroupController;

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', [HomeController::class, 'index'])->name('home');

Route::middleware('auth')->group(function () {

    Route::get('/dashboard', function () {
        return redirect()->route('teachers.index');
    })->name('dashboard');

    Route::resource('teachers', TeacherController::class)->except(['show']);

    Route::resource('accessRecords', AccessRecordController::class)->names([
        'index' => 'access.index',
    ]);

    Route::resource('subjects', SubjectController::class);
    Route::resource('careergroups', CareerGroupController::class);


    Route::resource('software-types', SoftwareTypeController::class);

    Route::get('/teachers/{teacher}', [TeacherController::class, 'show'])->name('teachers.show');



    Route::get('/statistics', [StatisticsController::class, 'index'])->name('statistics.index');
    Route::get('/statistics/export', [StatisticsController::class, 'export'])->name('statistics.export');
});






