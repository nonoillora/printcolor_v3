<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| This file is where you may define all of the routes that are handled
| by your application. Just tell Laravel the URIs it should respond
| to using a Closure or controller method. Build something great!
|
*/

Route::get('/', 'MainController@index');
Route::get('nosotros', 'MainController@getNosotros');
Route::get('plantillas', 'MainController@getPlantillas');
Route::get('subirficheros', 'MainController@getSubirFicheros');
Route::get('ofertas', 'MainController@getOfertas');
Route::get('categoria/{id}/{name?}', 'CategoriaController@getCategory');
Route::get('categorias', 'MainController@index');
Route::get('faq', 'MainController@getFAQ');
Route::get('producto/{id}/{name?}', 'ProductoController@getProducto');
Route::get('cookies', 'MainController@getCookies');
Route::get('image/banner', 'MainController@getBanner');
Route::get('image/categoria/{image}', 'CategoriaController@getCover');
Route::post('save', 'CarroController@store');
Route::post('newmessage', 'MainController@saveMessage');
Route::post('newpresupuesto', 'ProductoController@newpresupuesto');


Auth::routes();

Route::get('logout', function () {
    Auth::logout();
    return redirect()->to('/');
});

Route::group(['middleware' => 'auth', 'prefix' => 'admin'], function () {
    Route::get('/', 'MainController@getAdmin');
    Route::group(['prefix' => 'pedidos'], function () {
        Route::get('/', 'PedidoController@listadoPedidos');
        Route::get('pendientes', 'PedidoController@pedidosPendientes');
        Route::get('pedido/{id}', 'PedidoController@getPedido');
        Route::post('setCompanyShipping', 'PedidoController@setCompanyShipping');
        Route::get('factura/{id}', 'HelperController@getBill');
        Route::get('enviados','PedidoController@getIsSent');
        Route::get('pagados','PedidoController@getNoPaid');
        Route::post('addNumSeguimiento','PedidoController@setNumSeguimiento');
        Route::post('setPaid','PedidoController@setPaid');
        Route::post('setSent','PedidoController@setIsSent');
    });
    Route::group(['prefix' => 'presupuestos'], function () {
        Route::get('/', 'PresupuestoController@listadoPresupuestos');
        Route::get('{id}', 'PresupuestoController@mostrarPresupuesto');
    });

    Route::group(['prefix' => 'categoria'], function () {
        Route::get('nueva', 'CategoriaController@getNuevaCategoria');
        Route::post('savenewcat', 'CategoriaController@saveNewCat');
        Route::get('/', 'CategoriaController@getTodasCategoria');
        Route::get('editar', 'CategoriaController@getEditarCategoria');
        Route::get('editar/{id}', 'CategoriaController@getEditarCategoriaWithId');
        Route::get('remove/{id}/{image}', 'CategoriaController@removeImageFromCategory');
        Route::post('saveeditcat', 'CategoriaController@saveeditcat');
        Route::get('borrar/{id?}', 'CategoriaController@removeCategory');
    });

    Route::group(['prefix' => 'producto'], function () {
        Route::get('nuevo', 'ProductoController@getNuevoProducto');
        Route::post('savenewprod', 'ProductoController@saveNewProduct');
        //Route::get('/', 'ProductoController@index');
        Route::get('editar', 'ProductoController@getEditarProducto');
        Route::get('editar/{id}', 'ProductoController@getEditarProductWithId');
        Route::get('remove/{type}/{id}/{image}', 'ProductoController@removeImageFromProduct');
        Route::post('saveeditprod', 'ProductoController@saveeditprod');
        Route::post('addNewPrice', 'ProductoController@addNewPrice');
        Route::post('addNewTypePriceProduct', 'ProductoController@addNewTypePriceProduct');
        Route::post('deletePrice', 'ProductoController@deletePrice');
        Route::post('editPriceProduct', 'ProductoController@editPriceProduct');
        Route::post('editNameTypePriceProduct', 'ProductoController@editNameTypePriceProduct');
        Route::post('deleteTypePriceProduct', 'ProductoController@deleteTypePriceProduct');
        Route::get('borrar/{id?}', 'ProductoController@getBorrarProducto');
    });

    Route::group(['prefix' => 'shipping'], function () {
        Route::get('/', 'CompanyShippingController@index');
        Route::post('addNewCompanyShipping', 'CompanyShippingController@saveCompanyShipping');
        Route::post('updateCompanyShipping', 'CompanyShippingController@updateCompanyShipping');
        Route::post('deleteCompanyShipping', 'CompanyShippingController@deleteCompany');
    });
    Route::group(['prefix' => 'utilidades'], function () {
        Route::get('/', 'UtilitiesController@index');
        Route::get('cache', 'UtilitiesController@clearCache');
        Route::get('view', 'UtilitiesController@clearView');
        Route::get('autoload', 'UtilitiesController@doDumpAutoload');
        Route::get('events','UtilitiesController@generateEvent_listener');
        Route::get('clean','UtilitiesController@generateCleanNow');
        Route::get('generateBackup','UtilitiesController@generateBackupNow');
    });
    Route::group(['prefix' => 'config'], function () {
        Route::get('/', 'ConfigController@index');
        Route::get('/{id}/{key?}', 'ConfigController@show');
        Route::post('edit', 'ConfigController@edit');
    });

    Route::group(['prefix' => 'ficheros'], function () {
        Route::get('/', 'FicherosController@index');
    });

    Route::group(['prefix'=>'ofertas'],function(){
        Route::get('/','ProductoController@indexOfertas');
        Route::get('borrar/{id?}','ProductoController@getBorrarOferta');
        Route::get('editar/{id}','ProductoController@getEditarOferta');
        Route::post('saveeditofer', 'ProductoController@saveeditofer');
        Route::get('remove/{id}/{image}','ProductoController@removeImageFromOffer');
        Route::get('nueva','ProductoController@getNuevaOferta');
        Route::post('savenewoffer','ProductoController@saveNewOffer');
    });

    Route::group(['prefix'=>'contactos'],function(){
        Route::get('/','ContactoController@index');
        Route::get('mensaje/{id}','ContactoController@show');
    });

});

Route::get('tabla', function () {
    $cliente = \DB::table('clientes')->select('*')->where('id', 9)->first();
    $lineas = \DB::table('linea_pedidos')
        ->select('*')
        ->whereIn('id', unserialize('a:3:{i:0;i:5;i:1;i:6;i:2;i:7;}'))
        ->get();
    $pedido = \DB::table('linea_pedidos')
        ->whereIn('id', unserialize('a:3:{i:0;i:5;i:1;i:6;i:2;i:7;}'))
        ->sum('price');
//facturas/factura
    return view('notificationsMail/newOrderUser', [
        'cliente' => $cliente,
        'lineas' => $lineas,
        'pedido' => $pedido]);
});

Route::get('getBill', 'PedidoController@getBill');

Route::get('getFile/{type}/{file}', 'FicherosController@getFile');


Route::group([], function () {
    Route::get('cesta', 'CarroController@getIndex')->name('cesta');
    Route::get('quitarProducto/{id}', 'CarroController@quitarProducto');
    Route::get('clearCart', 'CarroController@destroyCart');
    Route::get('confirmacion-pedido', 'ClienteController@getRegistroClientePedido');
    Route::get('realizar-pago-pedido', 'PedidoController@getrealizarPagoPedido');
    Route::post('pedido-finalizado', 'PedidoController@getPedidoFinalizado');
    Route::post('finished_order', 'PedidoController@store');
    /*avoid reload page finish order*/
    Route::get('finished_order', function(){
        return redirect()->to('cesta');
    });
});

Route::get('/home', 'HomeController@index');

Route::get('bill',function(){
    $s =  \Helper::saveBillPDF(82);
    if($s){
        return true;
    }else{
        return false;
    }
});
