<?php

use Illuminate\Support\Facades\Route;

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
    return redirect(url('/inicio'));
});

Route::get('/inicio', [\App\Http\Controllers\HomeController::class, 'start']);

Route::prefix("servicios")->group(function() {
    Route::get('/planes-y-paquetes',[\App\Http\Controllers\ServiciosController::class,'planes'])->name(('planes'));
    Route::get('/todos',[\App\Http\Controllers\ServiciosController::class,'index'])->name(('servicios'));
    Route::get('/deudores',[\App\Http\Controllers\ServicioUsuarioController::class,'deudores'])->name(('deudores'));
    Route::get('/detalle_deudor/{id}',[\App\Http\Controllers\ServicioUsuarioController::class,'detalle_deudor'])->name(('detalle_deudor'));
    Route::get('/get_municipios/{estado}',[\App\Http\Controllers\ServiciosController::class,'get_municipios'])->name('get_municipios');
    Route::get('/get_localidades/{municipio}',[\App\Http\Controllers\ServiciosController::class,'get_localidades'])->name('get_localidades');
    Route::resource('/',\App\Http\Controllers\ServiciosController::class);


});
Route::prefix('suscriptores')->group(function () {
    Route::delete('/suscriptores/{id_serv}', [\App\Http\Controllers\SuscriptoresController::class,'destroy'])->name('suscriptores.destroy');
    Route::get('/nuevo/{id}',[\App\Http\Controllers\SuscriptoresController::class,'precontrato']);
    Route::get('/ver_contrato/{id}',[\App\Http\Controllers\SuscriptoresController::class,'print_agreement'])->name('print_agreement');
    Route::get('/editar_datos/{id}',[\App\Http\Controllers\SuscriptoresController::class,'edit_data'])->name('edit_agreement');
    Route::get('/pago_ok/{monto}',[\App\Http\Controllers\SuscriptoresController::class,'pago_ok'])->name('pago_ok');
    Route::get('/token_payment/{monto}/{token}/{token_date}',[\App\Http\Controllers\SuscriptoresController::class,'token_payment'])->name('token_payment');
    Route::get('/get_proof/{cadena}/{id}/{name}/{token}/{token_date}',[\App\Http\Controllers\SuscriptoresController::class,'get_proof'])->name('get_proof');
    Route::get('/validate_proof/{cadena}/{token}/{token_date}',[\App\Http\Controllers\SuscriptoresController::class,'validate_proof'])->name('validate_proof');
    Route::get('/save_owner/{name}/{id}',[\App\Http\Controllers\SuscriptoresController::class,'save_owner'])->name('save_owner');
    Route::resource('/',\App\Http\Controllers\SuscriptoresController::class);

});

Route::prefix('cobertura')->group(function (){
    Route::get('/', [\App\Http\Controllers\CoberturaController::class, 'gestion'])->name('gestion');
    Route::get('/mapa',[\App\Http\Controllers\HomeController::class,'cobertura'])->name('cobertura');
    Route::get('/aps',[\App\Http\Controllers\HomeController::class,'aps'])->name('aps');
});

Route::prefix('management')->group(function (){
    Route::get('/device_clients', [\App\Http\Controllers\ManagementController::class,'clients'])->name('client_devices');
    Route::get('/device_aps', [\App\Http\Controllers\ManagementController::class,'aps'])->name('aps_devices');
    Route::get('/device_ptp', [\App\Http\Controllers\ManagementController::class,'ptp'])->name('ptp_devices');
    Route::get('/ex_ping/{ip}', [\App\Http\Controllers\ManagementController::class,'ex_ping'])->name('ex_ping');
});

Route::prefix('users')->group(function (){
    Route::get('/add',[\App\Http\Controllers\ServiciosController::class,'create'])->name('agregar_u');
});



Auth::routes();
Route::post('/login', [\App\Http\Controllers\Auth\LoginController::class,'login']);
Route::get('/register',[\App\Http\Controllers\AuthController::class, 'register'])->name('register');
Route::get('/logout', [\App\Http\Controllers\AuthController::class, 'logout'])->name('logout');


Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('/contacto', [\App\Http\Controllers\HomeController::class, 'contacto']);

