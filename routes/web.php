<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AboutController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\MemberController;
use App\Http\Middleware\CheckAdmin;
use App\Models\User;

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
Route::get('/index', function () {
    return view('index');
});

Route::get('/about', [AboutController::class, 'index'])->name('about'); //ตั้งต้นที่หน้า about
// Route::get('/about', 'AboutController@index']);
Route::get('/admin', [AdminController::class, 'index'])->name('admin')->middleware('check');
Route::get('/member', [MemberController::class, 'index'])->name('member');


// Route::middleware([CheckAdmin::class])->group(function(){
//     Route::get('/admin', [AdminController::class, 'index'])->name('admin');
// });

Route::get('/', function () {
    return view('welcome');
});

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified'
])->group(function () {
    Route::get('/dashboard', function () {
        $users = User::orderBy('id', 'asc')->paginate(5);
        return view('dashboard', compact('users'));
    })->name('dashboard');
});
