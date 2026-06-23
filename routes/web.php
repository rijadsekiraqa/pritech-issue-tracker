<?php

use App\Http\Controllers\IssueController;
use App\Http\Controllers\ProjectController;
use Illuminate\Support\Facades\Route;



Route::get('/', function () {
    return view('dashboard');
})->name('dashboard');
Route::resource('projects', ProjectController::class);
Route::resource('issues', IssueController::class);

