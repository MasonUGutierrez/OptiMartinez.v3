<?php
/* NOTA: Hay que eliminar varias rutas */
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

// Route::get('/', function () {return view('welcome');});

/* Ruta inicial compuesta */
Route::get('/', function () {
    return redirect('usuarios/');
});

//Rutas para tesorero
    //Rutas orden lentes



Route::get('getPrecios/{id}/{ids}/{idss}','OpticaControllers\OrdenLenteController@costos');
Route::get('getPrecioFiltro/{id}','OpticaControllers\OrdenLenteController@costoFiltro');
Route::get('getPlanPagos','OpticaControllers\OrdenLenteController@getPlanPagos');
Route::get('pacienteById/{id}','OpticaControllers\OrdenLenteController@getPacienteById');
Route::get('getHistoria/{id}','OpticaControllers\OrdenLenteController@getHCuenta');
Route::get('allPacientes','OpticaControllers\OrdenLenteController@getPacientes');
Route::get('getMarcas','OpticaControllers\OrdenLenteController@getMarcas');
Route::get('getMicas','OpticaControllers\OrdenLenteController@getMicaMarca');
Route::get('getHClinica/{id}','OpticaControllers\OrdenLenteController@getHClinica');
Route::get('getFecha/{id}','OpticaControllers\OrdenLenteController@getFecha');
Route::get('getMarcaMaterial','OpticaControllers\OrdenLenteController@getMarcaMaterial');
Route::get('getFiltro','OpticaControllers\OrdenLenteController@getFiltro');
Route::get('getMarcos/{id}','OpticaControllers\OrdenLenteController@getMarcos');
Route::get('getMarcosInfo/{id}','OpticaControllers\OrdenLenteController@getMarcoInfo');
Route::get('getMaterial','OpticaControllers\OrdenLenteController@getTipoMaterial');
Route::get('getLente','OpticaControllers\OrdenLenteController@getTipoLente');
Route::get('/ordendeLente','OpticaControllers\OrdenLenteController@vistaOrden');
Route::resource('ordenLentes','OpticaControllers\OrdenLenteController');

//Rutas propias
Route::get('miperfil','OpticaControllers\UsuarioController@showPerfil');
Route::get('byeRol/{idU}/{idR}','OpticaControllers\UsuarioController@RemoveRol');
Route::resource('usuarios','OpticaControllers\UsuarioController');
Route::get('roless','OpticaControllers\RolController@getAll');
Route::resource('roles','OpticaControllers\RolController');
Route::get('roles/{id}/asignar','OpticaControllers\RolController@asignar')->name('roles.asignar');
Route::get('servicio','OpticaControllers\ServicioController@getAll');
Route::resource('servicios','OpticaControllers\ServicioController');
Route::get('planpagos','OpticaControllers\PlanPagoController@getAll');
Route::resource('planpago','OpticaControllers\PlanPagoController');

Route::get('verJornada','OpticaControllers\ConsultaController@watchJornada');
Route::get('historias-clinicas/consulta/create/verfecha/{id}','OpticaControllers\ConsultaController@getfecha');
Route::get('historias-clinicas/consulta/create/verpaciente/{id}','OpticaControllers\ConsultaController@getpaciente');
Route::get('historias-clinicas/consulta/create/verjor/{id}','OpticaControllers\ConsultaController@verjornada');
Route::get('idservicios','OpticaControllers\ConsultaController@servicio');
Route::get('historias-clinicas/verfecha','OpticaControllers\ConsultaController@date');
Route::get('historias-clinicas/getconsulta/{id}','OpticaControllers\ConsultaController@gettable');
Route::get('historias-clinicas/consulta/create/{id}','OpticaControllers\ConsultaController@create')->name("consulta.create");

Route::resource('historias-clinicas/consulta','OpticaControllers\ConsultaController')->except(['create']);

Route::get('depas','OpticaControllers\JornadaController@departamento');
route::get('vertipos','OpticaControllers\JornadaController@vertipojornada');
route::get('verjornadas','OpticaControllers\JornadaController@mostrar');
route::get('calendar','OpticaControllers\JornadaController@fillCalendar');
Route::get('listaPacientes', 'OpticaControllers\RecepcionistaController@listaPaciente');
route::resource('calendarRecepcionista','OpticaControllers\RecepcionistaController');
//-----------------------------Ruta de prueba-----------------------------------//
route::get('calendarPrueba','OpticaControllers\JornadaController@pruebas');
//-----------------------------------------------------------------------------//
Route::resource('jornadas','OpticaControllers\JornadaController');

// Rutas Resources
Route::resource('admin-lentes/marcas', 'OpticaControllers\MarcaController');

// Nota: Hacer una ruta para reactivar un tipo de marco, se tiene que usar la ruta update si quiere cambiar el nombre del tipo de marco
Route::resource('admin-lentes/tipos-marcos', 'OpticaControllers\TipoMarcoController')->except(['show', 'edit']);

// Closure para no tener que hacer un metodo en el Controller
/* Nota: Hubo problemas con la ruta extra put, se soluciono cambiando el nombre de la URL,
el nombre de la URL al ser igual que la URL del metodo post del controlador no sabia donde ingresar*/
Route::put('admin-materiales/tipos-lentes/reactivar/{tipo_lente}', function($id){
    $tipoLente = App\OpticaModels\TipoLente::findOrFail($id);
    $tipoLente->estado = 1;
    $tipoLente->save();

    return redirect()->route('tipos-lentes.index');
})->name('tipos-lentes.reactivar');
Route::resource('admin-materiales/tipos-lentes', 'OpticaControllers\TipoLenteController')->except(['show']);

Route::put('admin-materiales/materiales/reactivar/{materiale}', function($id){
    // var_dump($id);
    $m_mica = App\OpticaModels\MaterialMica::findOrFail($id);
    $m_mica->estado = 1;
    $m_mica->save();

    return redirect()->route('materiales.index');
})->name('materiales.reactivar');

Route::resource('admin-materiales/materiales', 'OpticaControllers\MaterialMicaController');

Route::put('admin-lentes/marcos/reactivar/{marco}', function($id){
    $marco = App\OpticaModels\Marco::findOrFail($id);
    $marco->estado = 1;
    $marco->save();

    return redirect()->action('OpticaControllers\MarcoController@index');
})->name('marcos.reactivar');

Route::resource('admin-lentes/marcos', 'OpticaControllers\MarcoController');

// Ruta para hacer pruebas de los modelos

Route::get('/test', function(){
    /*$tipo_marco = App\OpticaModels\TipoMarco::where('estado','1')->first();
    return $tipo_marco->tipo_marco;*/
    // return redirect("verjornadas");
    return view('layout.login');
});


// Ruta para historias Clinicas

Route::post('historias-clinicas/getCedula/{cedula}','OpticaControllers\HClinicaController@getCedulaifExist')->name('historias-clinica.getCedula');
Route::get('historias-clinicas/all', 'OpticaControllers\HClinicaController@getAll');
Route::get('historias-clinicas/gethistoria/{historia_clinica}', 'OpticaControllers\HClinicaController@getHClinica');
Route::resource('historias-clinicas', 'OpticaControllers\HClinicaController');
Route::resource('historias-cuentas', 'OpticaControllers\OrdenLenteController');
Route::resource('pacientes', 'OpticaControllers\PacienteController');


/*************************************************************************************************/

// Route::get('/', function () { return redirect('dashboard/index'); });

/* Dashboard */
Route::get('dashboard', function () { return redirect('dashboard/index'); });
Route::get('dashboard/index', 'DashboardController@index')->name('dashboard.index');

/* Profile */
/*Route::get('perfil', function () { return redirect('perfil/mi-perfil'); });
Route::get('perfil/mi-perfil', 'PerfilController@miPerfil')->name('perfil.mi-perfil');*/

/* App */
Route::get('app', function () { return redirect('app/calendar'); });
Route::get('app/calendar', 'AppController@calendar')->name('app.calendar');


/* Rutas Extras*/
/* File Manager
Route::get('file-manager', function () { return redirect('file-manager/all'); });
Route::get('file-manager/all', 'FileManagerController@all')->name('file-manager.all');

/* Blog
Route::get('blog', function () { return redirect('blog/dashboard'); });
Route::get('blog/dashboard', 'BlogController@dashboard')->name('blog.dashboard');
Route::get('blog/new-post', 'BlogController@newPost')->name('blog.new-post');
Route::get('blog/list', 'BlogController@list')->name('blog.list');
Route::get('blog/grid', 'BlogController@grid')->name('blog.grid');
Route::get('blog/detail', 'BlogController@detail')->name('blog.detail');

/* Ecommerce
Route::get('ecommerce', function () { return redirect('ecommerce/dashboard'); });
Route::get('ecommerce/dashboard', 'EcommerceController@dashboard')->name('ecommerce.dashboard');
Route::get('ecommerce/product', 'EcommerceController@product')->name('ecommerce.product');
Route::get('ecommerce/product-list', 'EcommerceController@productList')->name('ecommerce.product-list');
Route::get('ecommerce/product-detail', 'EcommerceController@productDetail')->name('ecommerce.product-detail');

/* Tables
Route::get('tables', function () { return redirect('tables/normal'); });
Route::get('tables/normal', 'TablesController@normal')->name('tables.normal');
Route::get('tables/datatable', 'TablesController@datatable')->name('tables.datatable');
Route::get('tables/editable', 'TablesController@editable')->name('tables.editable');
Route::get('tables/footable', 'TablesController@footable')->name('tables.footable');
Route::get('tables/color', 'TablesController@color')->name('tables.color');
*/

/* Authentication*/
Route::get('authentication', function () { return redirect('authentication/login'); });
Route::get('authentication/login', 'AuthenticationController@login')->name('authentication.login');
Route::get('authentication/register', 'AuthenticationController@register')->name('authentication.register');
Route::get('authentication/lockscreen', 'AuthenticationController@lockscreen')->name('authentication.lockscreen');
Route::get('authentication/forgot', 'AuthenticationController@forgot')->name('authentication.forgot');
Route::get('authentication/page404', 'AuthenticationController@page404')->name('authentication.page404');
Route::get('authentication/page500', 'AuthenticationController@page500')->name('authentication.page500');
Route::get('authentication/offline', 'AuthenticationController@offline')->name('authentication.offline');

/* Pages
Route::get('pages', function () { return redirect('pages/blank-page'); });
Route::get('pages/blank', 'PagesController@blank')->name('pages.blank');
Route::get('pages/gallery', 'PagesController@gallery')->name('pages.gallery');
Route::get('pages/invoices1', 'PagesController@invoices1')->name('pages.invoices1');
Route::get('pages/invoices2', 'PagesController@invoices2')->name('pages.invoices2');
Route::get('pages/pricing', 'PagesController@pricing')->name('pages.pricing');
Route::get('pages/profile', 'PagesController@profile')->name('pages.profile');
Route::get('pages/search', 'PagesController@search')->name('pages.search');
Route::get('pages/timeline', 'PagesController@timeline')->name('pages.timeline');
*/
