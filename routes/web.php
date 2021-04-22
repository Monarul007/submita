<?php

use App\Http\Controllers\AssignmentsController;
use Illuminate\Support\Facades\Route;

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

Route::get('/', function () {
    return view('welcome');
});

Route::middleware(['auth:sanctum', 'verified'])->get('/dashboard', function () {
    return view('dashboard');
})->name('dashboard');

//Assignments
Route::middleware(['auth'])->group(function () {
    Route::match(['get','post'],'/user/assignment/create',[AssignmentsController::class, 'create']
    )->name('assignments.create');
    Route::match(['get','post'],'/user/assignment/all',[AssignmentsController::class, 'assignments']
    )->name('assignments.view');

    //Submit Assignments
    Route::match(['get','post'],'/user/assignment/submit',[AssignmentsController::class, 'submit']
    )->name('assignments.submit');
});
