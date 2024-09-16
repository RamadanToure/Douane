<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MailController;
use App\Http\Controllers\HomeController;
use App\Mail\TestMail;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;

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
    return view('welcome');
});

Auth::routes();
Route::get('/', function () {return redirect()->route('home');}); // redirection vers la page d'accueil si la ligne supprimer
Route::get('weberror',[App\Http\Controllers\GiwuController::class, 'weberror']);

Route::group(['middleware' => 'auth'],function(){
    Route::get('manuel', [App\Http\Controllers\GiwuController::class, 'AfficherAideGiwu']);

    Route::get('home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
    Route::get('myprofile',[App\Http\Controllers\GiwuController::class, 'AfficherProfile']);
    Route::match(['get','post'],'updateprofil',[App\Http\Controllers\GiwuController::class, 'UpdatePageProfile']);
    Route::match(['get','post'],'updatemdp',[App\Http\Controllers\GiwuController::class, 'UpdatePageMotDpas']);

    //User
    Route::get('users/AffichePopDelete/{code}',[App\Http\Controllers\UserController::class, 'AffichePopDelete']);
    Route::get('users/exporterExcel',[App\Http\Controllers\UserController::class, 'exporterExcel']);
    Route::get('users/exporterPdf',[App\Http\Controllers\UserController::class, 'exporterPdf']);

    //Menu
    Route::get('menu/AffichePopDelete/{id}',[App\Http\Controllers\MenuController::class, 'AffichePopDelete']);
    Route::get('menu/AffichePopAction/{id}',[App\Http\Controllers\MenuController::class, 'AffichePopAction']);
    Route::post('menu/actionUpdate',[App\Http\Controllers\MenuController::class, 'AjouterGiwuAction']);
    Route::post('menu/actionDelete',[App\Http\Controllers\MenuController::class, 'DeleteGiwuAction']);

    //Role
    Route::get('role/AffichePopDelete/{code}',[App\Http\Controllers\RoleController::class, 'AffichePopDelete']);

    //Trace
    Route::get('trace/exporterExcel',[App\Http\Controllers\SaveTraceController::class, 'exporterExcel']);

    //Test - Crud
    Route::post('crud1/actionUpdate',[App\Http\Controllers\Crud1Controller::class, 'MotifGiwuAction']);
    Route::get('crud1/AffichePopAction/{id}',[App\Http\Controllers\Crud1Controller::class, 'AffichePopAction']);
    Route::get('crud1/AffichePopDelete/{id}',[App\Http\Controllers\Crud1Controller::class, 'AffichePopDelete']);
    Route::get('crud1/exporterExcel',[App\Http\Controllers\Crud1Controller::class, 'exporterExcel']);
    Route::get('crud1/exporterPdf',[App\Http\Controllers\Crud1Controller::class, 'exporterPdf']);

    //Consultation
    Route::match(['get','post'],'listcrud',[App\Http\Controllers\ConsultController::class, 'listCrudCons']);
    Route::get('listcrud/exporterExcel',[App\Http\Controllers\ConsultController::class, 'exporterExcel']);
    Route::get('listcrud/exporterPdf',[App\Http\Controllers\ConsultController::class, 'exporterPdf']);

    Route::resources([
        'users'=>App\Http\Controllers\UserController::class,
        'menu'=>App\Http\Controllers\MenuController::class,
        'role'=>App\Http\Controllers\RoleController::class,
        'trace'=>App\Http\Controllers\SaveTraceController::class,

        //resources-giwu
        'crud1'=>App\Http\Controllers\Crud1Controller::class,
    ]);
});
