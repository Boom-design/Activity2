<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\StudentInfoController;


Route::get('/', function () {   
    return view('welcome');
});

Route::resource('student_infos', StudentInfoController::class);

Route::get('/invalid-action', [StudentInfoController::class, 'invalidAction'])->name('invalid.action');
Route::get('/restricted-access', [StudentInfoController::class, 'restrictedAccess'])->name('restricted.access');
Route::get('/system-notice', [StudentInfoController::class, 'systemNotice'])->name('system.notice');
Route::get('/student_infos/{student_info}/force_delete', [StudentInfoController::class, 'forceDestroy'])->name('student_infos.force_destroy');
