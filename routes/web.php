<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\StudentInfoController;


Route::get('/', function () {   
    return view('welcome');
});

Route::resource('student_infos', StudentInfoController::class);


