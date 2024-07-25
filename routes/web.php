<?php

use App\Http\Controllers\Backend\Employee\EmployeeController;
use App\Http\Middleware\AdminMiddleware;
use App\Livewire\Employee\CreateEmployee;
use App\Livewire\Employee\EmployeeImport;
use App\Livewire\Employee\ListEmployee;
use Illuminate\Support\Facades\Route;

Route::view('/', 'welcome');

Route::view('dashboard', 'dashboard')
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

Route::view('profile', 'profile')
    ->middleware(['auth'])
    ->name('profile');

Route::middleware(['auth', AdminMiddleware::class])->group(function () {
    Route::get('/employees/export-pdf', [EmployeeController::class, 'exportPdf'])
        ->name('employees.export-pdf');
    Route::get('create-employee', CreateEmployee::class)
        ->name('employee.create');
    Route::get('list-employee', ListEmployee::class)
        ->name('employee.list');
    Route::get('import-employee', EmployeeImport::class)
        ->name('employee.import');

});

require __DIR__.'/auth.php';
