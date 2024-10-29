<?php

use App\Http\Controllers\AttendanceController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\UserController;
use App\Models\Attendance;
use App\Models\User;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/quan-ly-tai-khoan', function () {
    $data= User::all();
    return view('dashboard',['data' => $data]);
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});
Route::get('/them-tai-khoan',[
    UserController::class,
    'view_them_user'
])->middleware('auth');

Route::post('/them-tai-khoan',[
    UserController::class,
    'them_user'
])->middleware('auth');

Route::get('/cap-nhat-tai-khoan/{id}',[
    UserController::class,
    'view_update_user'
])->middleware('auth');

Route::post('/cap-nhat-tai-khoan/{id}',[
    UserController::class,
    'update_user'
])->middleware('auth');

Route::get('/xoa-tai-khoan/{id}',[
    UserController::class,
    'delete_user'
])->middleware('auth');

Route::get('/attendance', function () {
    $data= Attendance::all();
    return view('attendance',['data' => $data]);
})->middleware('auth')->name('attendance');

Route::get('/them-attendance',[
    AttendanceController::class,
    'view_them_attendance'
])->middleware('auth');
Route::post('/them-attendance',[
    AttendanceController::class,
    'them_attendance'
])->middleware('auth');

Route::get('/cap-nhat-attendance/{id}',[
    AttendanceController::class,
    'view_update_attendance'
])->middleware('auth');
Route::post('/cap-nhat-attendance/{id}',[
    AttendanceController::class,
    'update_attendance'
])->middleware('auth');
Route::get('/xoa-attendance/{id}',[
    AttendanceController::class,
    'delete_attendance'
])->middleware('auth');


///////////////////////////////////////////////////////

Route::get('/student', [
    StudentController::class,
    'danh_sach_students'
])->middleware('auth')->name('student');

require __DIR__.'/auth.php';
