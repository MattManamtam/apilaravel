<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\StudentController;

Route::get('students', [StudentController::class, 'index']);    // List all students
Route::post('students', [StudentController::class, 'store']);   // Create a new student
Route::get('students/{id}', [StudentController::class, 'show']); // Show a student by ID
Route::put('students/{id}', [StudentController::class, 'update']); // Update a student by ID
Route::delete('students/{id}', [StudentController::class, 'destroy']); // Delete a student by ID
