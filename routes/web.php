<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\EmployeeController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return redirect('/login');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::get('/employees', [EmployeeController::class, 'employees'])
->middleware(['auth'])->name('employees');

//Employee Manipulation Routes
Route::get('/employee/{id}', [EmployeeController::class, 'employeeInformation'])
->middleware(['auth', 'verified'])->name('view');

Route::get('/delete/{id}', [EmployeeController::class, 'destroy'])
->middleware(['auth', 'verified'])->name('deleteEmp');

Route::get('/addEmp', [EmployeeController::class, 'addEmployee'])
->middleware(['auth', 'verified'])->name('addEmp');

Route::post('/addEmp', [EmployeeController::class, 'store'])->name('addEmp')
->middleware(['auth', 'verified']);

Route::get('/editEmployee/{id}', [EmployeeController::class, 'edit'])->name('editEmp')
->middleware(['auth', 'verified']);

Route::put('/editEmployee/{id}', [EmployeeController::class, 'updateEmployee'])->name('employees.update')
->middleware(['auth', 'verified']);

Route::get('/employees/filter', [EmployeeController::class, 'filterEmpByActive'])->name('employees.filterByActive');

Route::get('/employees/filtergroup', [EmployeeController::class, 'filterByGroup']);

Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::put('/profile', [ProfileController::class, 'updateProfile'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});


require __DIR__.'/auth.php';

// Auth::routes();

// Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
