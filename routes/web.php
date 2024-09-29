<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\ReportController;
use App\Http\Controllers\InvicesController;
use App\Http\Controllers\ProductsController;
use App\Http\Controllers\SectionsController;
use App\Http\Controllers\CustomersReporControllert;
use App\Http\Controllers\InvoicesDetailsController;

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
    // Route::middleware('auth')->group(function () {

    Auth::routes();
    Route::get('/home', [HomeController::class, 'index'])->name('home');




    Route::get('/invices', [InvicesController::class, 'index'])->name('invices.com');

    Route::get('/invices/add', [InvicesController::class, 'create'])->name('add_invice');

    Route::POST('/invices/store',[InvicesController::class,'store'])->name('create_invices');

    Route::get('/invices/show/{id}',[InvoicesDetailsController::class,'show'])->name('show_invices');

    Route::get('/invices/edite/{id}',[InvicesController::class,'edite'])->name('eidte_invices');

    Route::POST('/invices/update/{id}',[InvicesController::class,'updatee'])->name('update_invices');

    Route::delete('/invices/delete/{id}',[InvicesController::class,'delete'])->name('delete_invices');

    Route::get('/Status_Show/{id}',[InvicesController::class,'Status_Show'])->name('Status_Show');

    Route::post('/Status_Update/{id}',[InvicesController::class,'Status_Update'])->name('Status_Update');

    Route::get('/Invoice_unPaid',[InvicesController::class,'Invoice_unPaid'])->name('invices_Unpaid');

    Route::get('/Invoice_Paid',[InvicesController::class,'Invoice_Paid'])->name('Invoice_Paid');

    Route::get('/invoices_Partial',[InvicesController::class,'invoices_Partial'])->name('invoices_Partial');

    Route::get('/Print_Invices/{id}',[InvicesController::class,'new'])->name('Print_Invices');



    Route::get('/section/{id}', [InvicesController::class, 'getproducts'])->name('getproducts');

    Route::get('/sections', [SectionsController::class, 'index'])->name('section.com');

    Route::POST('/sections/create',[SectionsController::class,'store'])->name('sections.store');

    Route::get('/sections/{post}/edite', [SectionsController::class,'edite'])->name('section.edite');

    Route::POST('/sections/{post}',[SectionsController::class, 'update']) ->name('Posts.update');

    Route::delete('/sections/{post}',[SectionsController::class, 'destroy']) ->name('Posts.delet');


    Route::get('/products', [ProductsController::class, 'index'])->name('products.index');

    Route::POST('/products/create', [ProductsController::class,'store'])->name('products.store');

    Route::get('/products/{post}/edite', [ProductsController::class,'edite'])->name('products.edite');

    Route::POST('/products/{post}',[ProductsController::class, 'update']) ->name('product.update');

    Route::delete('/products/{post}',[ProductsController::class, 'destroy']) ->name('products.delete');



    Route::get('/Report_Invoices',[ReportController::class, 'index']) ->name('Report_Invoices');

    Route::post('/Search_Invoices',[ReportController::class, 'Search_invoices'])->name('Search_invoices');

    Route::get('/Custumer_Report',[CustomersReporControllert::class, 'index']) ->name('Custumer_Report');
    
    Route::post('/Search_customers',[CustomersReporControllert::class, 'Search_customers']) ->name('Search_customers');


    Route::group(['middleware' => ['auth']], function() {

        Route::get('/roles',[RoleController::class,'index'])->name('role');

        Route::get('/roles/{id}',[RoleController::class,'show'])->name('ShowRole');

        Route::get('/roles/edite/{id}',[RoleController::class,'edit'])->name('EditeRole');

        Route::put('/roles/update/{id}',[RoleController::class,'update'])->name('UpdateRoles');

        Route::get('/role/Create',[RoleController::class,'create'])->name('CreateRole');

        Route::post('/role/store',[RoleController::class,'store'])->name('StoreRole');

        Route::delete('/role/delete/{id}',[RoleController::class,'destroy'])->name('Destroy_Role');



        Route::get('/users',[UserController::class,'index'])->name('Users');

        Route::get('/users/Create',[UserController::class,'create'])->name('Create_User');

        Route::post('/users/Store',[UserController::class,'store'])->name('Store_User');

        Route::get('/users/edit/{id}',[UserController::class,'edit'])->name('Edite_User');
        Route::post('/users/update/{id}',[UserController::class,'update'])->name('Update_User');

        Route::delete('/users/delete/{id}',[UserController::class,'destroy'])->name('Destroy_User');

        });

    Route::get('/{page}', [AdminController::class, 'index']);
