<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MailController;
use App\Http\Controllers\HomeController;
use App\Mail\TestMail;
use App\Models\User;
use Illuminate\Support\Facades\Artisan;
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

//Contrôler du site

// Route::get('/',[App\Http\Controllers\SiteController::class, 'index']);

// Route::get('/registerUsager',[App\Http\Controllers\SiteController::class, 'registre_usager']);
// Route::get('/logoutAgent',[App\Http\Controllers\SiteController::class, 'LogoutAgent']);
//
Route::get('/clear', function(){
	Artisan::call('config:cache');
	Artisan::call('route:clear');
});

Auth::routes();

Route::get('/', function () {return redirect()->route('home');}); // redirection vers la page home si la ligne delete

// Route::get('/',[App\Http\Controllers\SiteController::class, 'index']);
Route::get('weberror',[App\Http\Controllers\GiwuController::class, 'weberror']);

Route::match(['get','post'],'loginagent',[App\Http\Controllers\SiteController::class, 'connexionAgent']);
Route::match(['get','post'],'inscriagent',[App\Http\Controllers\SiteController::class, 'InscriptionAgent']);
Route::get('courrier/levelExacution/{codesuivi}',[App\Http\Controllers\CourrierController::class, 'NiveauExecution']);


Route::group(['middleware' => 'auth'],function(){
	Route::group(['middleware' =>'App\Http\Middleware\GiwuMiddleware'],function(){

		Route::get('manuel', [App\Http\Controllers\GiwuController::class, 'AfficherAideGiwu']);

		Route::get('home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
		Route::get('myprofile',[App\Http\Controllers\GiwuController::class, 'AfficherProfile']);
		Route::get('mysociety',[App\Http\Controllers\GiwuController::class, 'AfficherMySociete']);
		Route::match(['get','post'],'mysociety/updatepage',[App\Http\Controllers\GiwuController::class, 'UpdatePageSoc']);

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
		Route::get('trace/exporterPdf',[App\Http\Controllers\SaveTraceController::class, 'exporterPdf']);

		/*
		|--------------------------------------------------------------------------
		|   DIRECTION
		|--------------------------------------------------------------------------
		*/
		Route::get('direction/AffichePopDelete/{id}',[App\Http\Controllers\DirectionController::class, 'AffichePopDelete']);
		Route::get('direction/exporterExcel',[App\Http\Controllers\DirectionController::class, 'exporterExcel']);
		Route::get('direction/exporterPdf',[App\Http\Controllers\DirectionController::class, 'exporterPdf']);

		/*
		|--------------------------------------------------------------------------
		|   SERVICE
		|--------------------------------------------------------------------------
		*/
		Route::get('service/AffichePopDelete/{id}',[App\Http\Controllers\ServiceController::class, 'AffichePopDelete']);
		Route::get('service/exporterExcel',[App\Http\Controllers\ServiceController::class, 'exporterExcel']);
		Route::get('service/exporterPdf',[App\Http\Controllers\ServiceController::class, 'exporterPdf']);

		/*
		|--------------------------------------------------------------------------
		|   DIVISION
		|--------------------------------------------------------------------------
		*/
		Route::get('division/AffichePopDelete/{id}',[App\Http\Controllers\DivisionController::class, 'AffichePopDelete']);
		Route::get('division/exporterExcel',[App\Http\Controllers\DivisionController::class, 'exporterExcel']);
		Route::get('division/exporterPdf',[App\Http\Controllers\DivisionController::class, 'exporterPdf']);

		/*
		|--------------------------------------------------------------------------
		|   EXPEDITEUR
		|--------------------------------------------------------------------------
		*/
		Route::get('expediteur/AffichePopDelete/{id}',[App\Http\Controllers\ExpediteurController::class, 'AffichePopDelete']);
		Route::get('expediteur/exporterExcel',[App\Http\Controllers\ExpediteurController::class, 'exporterExcel']);
		Route::get('expediteur/exporterPdf',[App\Http\Controllers\ExpediteurController::class, 'exporterPdf']);
		/*
		|--------------------------------------------------------------------------
		|   COURRIER
		|--------------------------------------------------------------------------
		*/
		Route::get('courrier/AffichePopDelete/{id}',[App\Http\Controllers\CourrierController::class, 'AffichePopDelete']);
		Route::get('courrier/exporterExcel',[App\Http\Controllers\CourrierController::class, 'exporterExcel']);
		Route::get('courrier/exporterPdf',[App\Http\Controllers\CourrierController::class, 'exporterPdf']);
		Route::get('courrier/AffichePopTransfert/{id}',[App\Http\Controllers\CourrierController::class, 'AffichePopTransfert']);
		Route::get('courrier/AffichePopTraiter/{id}',[App\Http\Controllers\CourrierController::class, 'AffichePopTraiter']);
		Route::get('typedestina/{idtype}',[App\Http\Controllers\CourrierController::class, 'ListeDestinataires']);
		Route::post('courrier/actionTransfert',[App\Http\Controllers\CourrierController::class, 'TransfertCourier']);
		Route::post('courrier/actionTraiter',[App\Http\Controllers\CourrierController::class, 'TraiterCourier']);
		Route::get('courrier/consulter/{code}',[App\Http\Controllers\CourrierController::class, 'ConsulterCourrier']);
		Route::get('courrier/AffichePopConfirmerExp/{id}',[App\Http\Controllers\CourrierController::class, 'AffichePopConfirmerExpe']);
		Route::post('courrier/confirmer/{id}',[App\Http\Controllers\CourrierController::class, 'ConfirmerCourrier']);
		/*
		|--------------------------------------------------------------------------
		|   LISTCOURRIERATRAITER
		|--------------------------------------------------------------------------
		*/
		Route::match(['get','post'],'listcourrieratraiter',[App\Http\Controllers\Cons\ConslistcourrieratraiterController::class, 'listcourrieratraiterCons']);
		Route::get('listcourrieratraiter/exporterExcel',[App\Http\Controllers\Cons\ConslistcourrieratraiterController::class, 'exporterExcel']);
		Route::get('listcourrieratraiter/exporterPdf',[App\Http\Controllers\Cons\ConslistcourrieratraiterController::class, 'exporterPdf']);
		/*
		|--------------------------------------------------------------------------
		|   COURRIERSORTANT
		|--------------------------------------------------------------------------
		*/
		Route::get('courriersortant/AffichePopDelete/{id}',[App\Http\Controllers\CourriersortantController::class, 'AffichePopDelete']);
		Route::get('courriersortant/exporterExcel',[App\Http\Controllers\CourriersortantController::class, 'exporterExcel']);
		Route::get('courriersortant/exporterPdf',[App\Http\Controllers\CourriersortantController::class, 'exporterPdf']);

		/*
		|--------------------------------------------------------------------------
		|   ARCHIVE
		|--------------------------------------------------------------------------
		*/
		Route::get('archive/AffichePopDelete/{id}',[App\Http\Controllers\ArchiveController::class, 'AffichePopDelete']);
		Route::get('archive/exporterExcel',[App\Http\Controllers\ArchiveController::class, 'exporterExcel']);
		Route::get('archive/exporterPdf',[App\Http\Controllers\ArchiveController::class, 'exporterPdf']);
		/*
		|--------------------------------------------------------------------------
		|   CARRIERE
		|--------------------------------------------------------------------------
		*/
		Route::get('carriere/AffichePopDelete/{id}',[App\Http\Controllers\CarriereController::class, 'AffichePopDelete']);
		Route::get('carriere/exporterExcel',[App\Http\Controllers\CarriereController::class, 'exporterExcel']);
		Route::get('carriere/exporterPdf',[App\Http\Controllers\CarriereController::class, 'exporterPdf']);

		/*
		|--------------------------------------------------------------------------
		|   LISTRETRAITE
		|--------------------------------------------------------------------------
		*/
		Route::match(['get','post'],'listretraite',[App\Http\Controllers\Cons\ConslistretraiteController::class, 'listretraiteCons']);
		Route::get('listretraite/exporterExcel',[App\Http\Controllers\Cons\ConslistretraiteController::class, 'exporterExcel']);
		Route::get('listretraite/exporterPdf',[App\Http\Controllers\Cons\ConslistretraiteController::class, 'exporterPdf']);

		//add-route-cms

		Route::resources([
			'users'=>App\Http\Controllers\UserController::class,
			'menu'=>App\Http\Controllers\MenuController::class,
			'role'=>App\Http\Controllers\RoleController::class,
			'trace'=>App\Http\Controllers\SaveTraceController::class,
			'direction'=>App\Http\Controllers\DirectionController::class,
			'service'=>App\Http\Controllers\ServiceController::class,
			'division'=>App\Http\Controllers\DivisionController::class,
			'expediteur'=>App\Http\Controllers\ExpediteurController::class,
			'courrier'=>App\Http\Controllers\CourrierController::class,
			'courriersortant'=>App\Http\Controllers\CourriersortantController::class,
			'archive'=>App\Http\Controllers\ArchiveController::class,
			'carriere'=>App\Http\Controllers\CarriereController::class,
			//resources-giwu
		]);
	});

});

