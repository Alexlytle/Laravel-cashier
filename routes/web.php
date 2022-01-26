<?php

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\PlanController;
use App\Http\Controllers\SubscriptionController;


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


    $user = User::find(2);
    // dd(auth());
   

    return view('home');
});




Auth::routes();

Route::get('/home', [HomeController::class, 'index'])->name('home');


Route::group(['middleware' => 'auth'], function() {
    Route::get('/home', [HomeController::class, 'index'])->name('home');
    Route::get('/plans', [PlanController::class,'index'])->name('plans.index');
    Route::get('/plan/{plan}',  [PlanController::class,'show'])->name('plans.show');
    Route::post('/subscription', [SubscriptionController::class,'create'])->name('subscription.create');

    //Routes for create Plan
    Route::get('create/plan',  [SubscriptionController::class,'createPlan'])->name('create.plan');
    Route::post('store/plan',  [SubscriptionController::class,'storePlan'])->name('store.plan');
});
