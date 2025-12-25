<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\DepartmentController;
use App\Http\Controllers\PermissionController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';


Route::patch('employees/status/{employee}', [EmployeeController::class, 'toogleStatus'])->name('employees.status')->middleware('auth');

Route::get('employees/trash', [EmployeeController::class, 'trash'])->name('employees.trash')->middleware('auth');
Route::post('employees/{employee}/restore', [EmployeeController::class, 'restore'])->name('employees.restore')->middleware('auth');
Route::delete('employees/forceDelete/{employee}', [EmployeeController::class, 'permanentDelete'])->name('employees.forceDelete')->middleware('auth');

Route::resource('employees', EmployeeController::class)->middleware('auth');




// Department routes (trash routes FIRST)
Route::get('departments/trash', [DepartmentController::class, 'trash'])->name('departments.trash')->middleware('auth');
Route::post('departments/{id}/restore', [DepartmentController::class, 'restore'])->name('departments.restore')->middleware('auth');
Route::delete('departments/forceDelete/{id}', [DepartmentController::class, 'permanentDelete'])->name('departments.forceDelete')->middleware('auth');

Route::resource('departments', DepartmentController::class)->middleware('auth');


Route::patch('users/status/{user}', [UserController::class, 'toogleStatus'])->name('users.status')->middleware('auth');

Route::get('users/trash', [UserController::class, 'trash'])->name('users.trash')->middleware('auth');
Route::post('users/{user}/restore', [UserController::class, 'restore'])->name('users.restore')->middleware('auth');
Route::delete('users/forceDelete/{user}', [UserController::class, 'permanentDelete'])->name('users.forceDelete')->middleware('auth');
Route::resource('users', UserController::class)->middleware('auth');


Route::resource('roles', RoleController::class)->middleware('auth');

Route::resource('permissions', PermissionController::class)->middleware('auth');