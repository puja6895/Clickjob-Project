<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Employee\EmployeeController;
use App\Http\Controllers\Employee\EmployeeSalaryController;

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
    return redirect()->route('login');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home')->middleware('auth');

// Employee
Route::middleware('auth')->prefix('employee')->name('employee.')->group(function(){
    Route::get('list',[EmployeeController::class, 'getList'])->name('list');
    Route::get('add',[EmployeeController::class, 'addEmployee'])->name('add');
    Route::post('store',[EmployeeController::class, 'storeEmployee'])->name('store');
});

// Salary Create
Route::middleware('auth')->prefix('salary')->name('salary.')->group(function(){
    Route::get('list',[EmployeeSalaryController::class, 'getSalaryList'])->name('list');
    Route::get('create/{employee_id}',[EmployeeSalaryController::class, 'createSalary'])->name('create');
    Route::post('store',[EmployeeSalaryController::class, 'storeSalary'])->name('store');
    Route::get('download-pdf/{employee_salary_id}',[EmployeeSalaryController::class, 'getSalaryPdf'])->name('pdf');

});