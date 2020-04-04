<?php

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
    return view('auth.login');
});

Auth::routes();

Route::get('/beranda1', 'HomeController@beranda1')->name('beranda1');
Route::get('/beranda2', 'HomeController@beranda2')->name('beranda2');

Route::get('dashboard', function () {
   return view('layouts.master');
});

Route::group(['middleware' => 'auth'], function () {

    // Profile
    Route::get('settings/profile', 'SettingsController@profile');

    // Edit Profile
    Route::get('settings/profile/edit', 'SettingsController@editProfile');

    // Update Profile
    Route::post('settings/profile', 'SettingsController@updateProfile');

    // Ubah password
    Route::get('settings/password', 'SettingsController@editPassword');
    Route::post('settings/password', 'SettingsController@updatePassword');
   
    //----------------------------WMS-------------------------------\\
    Route::resource('gudang','WarehouseController');
    Route::get('/apiWarehouses','WarehouseController@apiWarehouses')->name('api.warehouses');

    Route::resource('barang','ProductController');
    Route::get('/apiProducts','ProductController@apiProducts')->name('api.products');

    Route::resource('kategori','CategoryController');
    Route::get('/apiCategories','CategoryController@apiCategories')->name('api.categories');
    Route::get('/exportCategoriesAll','CategoryController@exportCategoriesAll')->name('exportPDF.categoriesAll');
    Route::get('/exportCategoriesAllExcel','CategoryController@exportExcel')->name('exportExcel.categoriesAll');

    Route::resource('merek','MerkController');
    Route::get('/apiMerks','MerkController@apiMerks')->name('api.merks');

    Route::resource('stokmasuk','ProductMasukController');
    Route::get('/apiProductsIn','ProductMasukController@apiProductsIn')->name('api.productsIn');
    Route::get('/exportProductMasukAll','ProductMasukController@exportProductMasukAll')->name('exportPDF.productMasukAll');
    Route::get('/exportProductMasukAllExcel','ProductMasukController@exportExcel')->name('exportExcel.productMasukAll');
    Route::get('/exportProductMasuk/{id}','ProductMasukController@exportProductMasuk')->name('exportPDF.productMasuk');
   
    
    Route::resource('penyuplai','SupplierController');
    Route::get('/apiSuppliers','SupplierController@apiSuppliers')->name('api.suppliers');
    Route::post('/importSuppliers','SupplierController@ImportExcel')->name('import.suppliers');
    Route::get('/exportSupplierssAll','SupplierController@exportSuppliersAll')->name('exportPDF.suppliersAll');
    Route::get('/exportSuppliersAllExcel','SupplierController@exportExcel')->name('exportExcel.suppliersAll');
    
    Route::resource('stokkeluar','ProductKeluarController');
    Route::get('/apiProductsOut','ProductKeluarController@apiProductsOut')->name('api.productsOut');
    Route::get('/exportProductKeluarAll','ProductKeluarController@exportProductKeluarAll')->name('exportPDF.productKeluarAll');
    Route::get('/exportProductKeluarAllExcel','ProductKeluarController@exportExcel')->name('exportExcel.productKeluarAll');
    Route::get('/exportProductKeluar/{id}','ProductKeluarController@exportProductKeluar')->name('exportPDF.productKeluar');

    Route::resource('pembeli','CustomerController');
    Route::get('/apiCustomers','CustomerController@apiCustomers')->name('api.customers');
    Route::post('/importCustomers','CustomerController@ImportExcel')->name('import.customers');
    Route::get('/exportCustomersAll','CustomerController@exportCustomersAll')->name('exportPDF.customersAll');
    Route::get('/exportCustomersAllExcel','CustomerController@exportExcel')->name('exportExcel.customersAll');

    //----------------------------Rental Gudang-------------------------------\\
    Route::resource('rental','RentalController');
    Route::get('/apiRentals','RentalController@apiRentals')->name('api.rentals');

    Route::resource('penyewa','RenterController');
    Route::get('/apiRenters','RenterController@apiRenters')->name('api.renters');
    Route::post('/importRenters','RenterController@ImportExcel')->name('import.renters');
    Route::get('/exportRentersAll','RenterController@exportRentersAll')->name('exportPDF.rentersAll');
    Route::get('/exportRentersAllExcel','RenterController@exportExcel')->name('exportExcel.rentersAll');
    
    Route::resource('stokrentalmasuk','StockrentinController');
    Route::get('/apiStockrentins','StockrentinController@apiStockrentins')->name('api.stockrentins');
    Route::get('/exportStockrentinAll','StockrentinController@exportStockrentinAll')->name('exportPDF.StockrentinAll');
    Route::get('/exportStockrentinAllExcel','StockrentinController@exportExcel')->name('exportExcel.StockrentinAll');
    Route::get('/exportStockrentin/{id}','StockrentinController@exportStockrentin')->name('exportPDF.Stockrentin');

    Route::resource('stokrentalkeluar','StockrentoutController');
    Route::get('/apiStockrentouts','StockrentoutController@apiStockrentouts')->name('api.stockrentouts');
    Route::get('/exportStockrentoutAll','StockrentoutController@exportStockrentoutAll')->name('exportPDF.StockrentoutAll');
    Route::get('/exportStockrentoutAllExcel','StockrentoutController@exportExcel')->name('exportExcel.StockrentoutAll');
    Route::get('/exportStockrentout/{id}','StockrentoutController@exportStockrentout')->name('exportPDF.Stockrentout');
    
   
});

