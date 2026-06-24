<?php

use App\Http\Controllers\CommentController;
use App\Http\Controllers\IssueController;
use App\Http\Controllers\ProjectController;
use App\Http\Controllers\TagController;
use Illuminate\Support\Facades\Route;



Route::get('/', function () {
    return view('dashboard');
})->name('dashboard');
Route::resource('projects', ProjectController::class);
Route::resource('issues', IssueController::class);
Route::resource('tags', TagController::class);
Route::resource('comments', CommentController::class);
Route::get('/issues/{issue}/comments',[CommentController::class, 'loadComments'])->name('issues.comments');
Route::post('/issues/{issue}/comments', [CommentController::class, 'storeAjax']);
