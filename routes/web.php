<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\{AuthController, CompanyController, DashboardController, ImportController, MentorController, SettingController, StudentController, StudentScheduleController, StudentPresenceController, UserController};

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
Route::get('/', [AuthController::class, 'index']);

Route::middleware('auth')->group(function() {
    Route::get('/dashboard', [DashboardController::class, 'index']);
    
	Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

    Route::get('/profile', [UserController::class, 'profile']);
    Route::patch('/profile/{user}', [UserController::class, 'updateProfile']);

    Route::group(['middleware'=>'role:admin'], function(){
        Route::resource('/mentor', MentorController::class);
        Route::resource('/company', CompanyController::class)->except('show');
        Route::resource('/student', StudentController::class)->except('index','show');

        Route::post('/import/data', [ImportController::class, 'data']);

        Route::get('/setting', [SettingController::class, 'index']);
        Route::post('/setting', [SettingController::class, 'update']);
    });

    Route::group(['middleware'=>'role:admin&mentor'], function(){
        Route::resource('/student', StudentController::class)->only('index','show');
    });
    Route::group(['middleware'=>'role:mentor'], function(){
        Route::get('/schedule/create', [StudentScheduleController::class, 'createSchedule']);
        Route::post('/schedule', [StudentScheduleController::class, 'storeSchedule']);
        Route::post('/schedule/free/{student}', [StudentScheduleController::class, 'freeSchedule']);
        Route::post('/schedule/{student}', [StudentScheduleController::class, 'updateSchedule']);
    });
    Route::group(['middleware'=>'role:student'], function(){
        Route::get('/schedule', [StudentScheduleController::class, 'schedule']);

        Route::get('/presence/in', [StudentPresenceController::class, 'in']);
        Route::get('/presence/out', [StudentPresenceController::class, 'out']);

        Route::post('/presence/in', [StudentPresenceController::class, 'storeIn']);
        Route::post('/presence/out', [StudentPresenceController::class, 'storeOut']);

        Route::get('/history', [StudentPresenceController::class, 'history']);
    });

    Route::get('/location', [DashboardController::class, 'location']);
});

Route::get('/login', [AuthController::class, 'login'])->name('login');
Route::post('/login', [AuthController::class, 'auth']);
