<?php

use App\Http\Controllers\ComandaController;
use App\Http\Controllers\ComandaMultipleController;
use App\Http\Controllers\MainController;
use App\Http\Controllers\MenuController;
use App\Http\Controllers\PlatsController;
use App\Http\Controllers\PlatSolController;
use App\Http\Controllers\PobleController;
use App\Http\Controllers\QueixaController;
use App\Http\Controllers\RestaurantController;
use App\Http\Controllers\ToGoodToGoController;
use App\Http\Controllers\ToGoodToGoRestaurantController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

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

//Route::get('/', function () {
//    return view('welcome');
//});
Route::get('/',[MainController::class,'index'])->name('home');
Route::get('/login-view',[UserController::class,'login'])->name('login');
Route::post('/store-user',[UserController::class,'store'])->name('store-user');
Route::post('/attempt-login',[UserController::class,'attemptLogin'])->name('attempt-login');
Route::get('/signup',[UserController::class,'create'])->name('signup');
Route::get('/qui-som',[MainController::class,'quiSom'])->name('quisom');
Route::get('/on-repartim',[MainController::class,'onRepartim'])->name('onrepartim');
Route::get('/log-out',[UserController::class,'logout'])->name('logout');
Route::get('/queixes',[QueixaController::class,'index'])->name('queixes')->middleware('auth');
Route::post('/queixes-save',[QueixaController::class,'store'])->name('submitqueixa')->middleware('auth');

Route::get('/restaurants',[RestaurantController::class,'index'])->name('restaurants')->middleware('auth');
Route::post('/add-restaurant',[RestaurantController::class,'store'])->name('addrest')->middleware('auth');
Route::post('/restaurants-poble',[RestaurantController::class,'getByPoble'])->name('filter-pobles')->middleware('auth');
Route::get('/restaurant/{id}',[RestaurantController::class,'show'])->name('get-restaurant')->middleware('auth');


Route::get('/poble',[PobleController::class,'index'])->name('pobles')->middleware('auth');
Route::post('/add-poble',[PobleController::class,'store'])->name('addpoble')->middleware('auth');

Route::get('/menus/{id}',[MenuController::class,'index'])->name('menus-g')->middleware('auth');
Route::post('/menus/add',[MenuController::class,'store'])->name('addmenus')->middleware('auth');

Route::get('plats/{menu_id}',[PlatsController::class,'index'])->name('plats')->middleware('auth');
Route::post('/plats-save',[PlatsController::class,'store'])->name('platsave')->middleware('auth');
Route::get('/menus-restaurant/{restaurant_id}',[RestaurantController::class,'showMenus'])->name('menus-r')->middleware('auth');


Route::get('/crear-comanda/{menu_id}',[ComandaController::class,'create'])->name('crear-comanda')->middleware('auth');
Route::post('/comanda-store',[ComandaController::class,'store'])->name('comanda-store')->middleware('auth');
Route::get('/get-comanda-usuari/{user_id}',[ComandaController::class,'getComandesUsuari'])->name('comanda-usuari')->middleware('auth');

Route::get('/to-good-to-go',[ToGoodToGoController::class,'index'])->name('togoodtogo')->middleware('auth');
Route::get('/to-good-to-go/create',[ToGoodToGoController::class,'create'])->name('create-good')->middleware('auth');
Route::post('/to-good-to-go/store',[ToGoodToGoController::class,'store'])->name('store-good')->middleware('auth');

Route::post('/crear-comanda-multiple',[ComandaMultipleController::class,'store'])->name('create-comanda-multiple')->middleware('auth');
Route::get('/comandes-multiples/{user_id}',[ComandaMultipleController::class,'index'])->name('comandes-multiples')->middleware('auth');

Route::get('/plats-sols/{restaurant_id}',[PlatSolController::class,'index'])->name('plats-sols')->middleware('auth');
Route::post('/plat-sol/store',[PlatSolController::class,'store'])->name('plat-store')->middleware('auth');

Route::get('/togoodtogo/configure/{restaurant_id}',[ToGoodToGoRestaurantController::class,'index'])->name('togood-configure')->middleware('auth');
Route::post('/togoodtogo/configure/save',[ToGoodToGoRestaurantController::class,'store_configuration'])->name('togood-save')->middleware('auth');
Route::post('togood-title-save',[ToGoodToGoRestaurantController::class,'store_description'])->name('togood-title-save')->middleware('auth');
Route::get('/togoodtogo/configure/delete/{id}/{restaurant_id}',[ToGoodToGoRestaurantController::class,'destroy'])->name('togood-destroy')->middleware('auth');

Route::get('/generate-mistery-box/{restaurant_id}',[ToGoodToGoRestaurantController::class,'generate_mistery_box'])->name('gen-mistery-box')->middleware('auth');
Route::post('/store-mistery-box',[ComandaMultipleController::class,'store_mistery_box'])->name('store_mbox')->middleware('auth');
