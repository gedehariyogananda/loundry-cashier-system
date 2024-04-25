<?php

use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\CustomerLoundryController;
use App\Http\Controllers\PaymentMethodController;
use App\Http\Controllers\SpesificationLoundryController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\WordExportCustomerController;
use App\Models\SpesificationLoundry;
use Illuminate\Support\Facades\Route;

Route::controller(AuthController::class)->group(function () {
    Route::get('/', 'index')->name('login');
    Route::get('/register', 'register')->name('register');
    Route::post('/register', 'registerStore')->name('register.store');
    Route::post('/', 'login')->name('loginPost');
    Route::get('/logout', 'logout')->name('logout');
});

Route::controller(UserController::class)->group(function () {
    Route::get('/statistic', 'index')->name('dashboard');
    Route::get('/videos/tutorial', 'tutorial')->name('tutorial');
    Route::get('/data-customer', 'dataCustomer')->name('customer');
    Route::get('/data-customer/sorting/{id}', 'dataSorting')->name('customer.sorting');
});

Route::controller(CustomerLoundryController::class)->group(function () {
    Route::get('/entry/customer', 'getEntry')->name('customer.index');
    Route::post('/entry/customer', 'insertEntry')->name('customer.entry');
    Route::get('/entry/customer/edit', 'getEdit')->name('customer.edit');
    Route::patch('/entry/customer/update', 'updateCustomer')->name('customer.update');
    Route::delete('/entry/customer/{id}/delete', 'deleteCustomer')->name('customer.destroy');
    Route::get('/nota/customer/{id}', 'notaCustomer')->name('customer.nota');
});

Route::controller(PaymentMethodController::class)->group(function () {
    Route::get('/payment/customer', 'getCheckout')->name('payment.checkout');
    Route::patch('/payment/customer', 'paymentUpdate')->name('payment.update');
});

Route::controller(WordExportCustomerController::class)->group(function () {
    Route::get('/customer/export', 'getExport')->name('export.index');
});

Route::controller(SpesificationLoundryController::class)->group(function () {
    Route::get('/service/loundry', 'getService')->name('service.index');
    Route::get('/service/loundry/{id}/cuci', 'editServiceCuci')->name('servicecuci.edit');
    Route::patch('/service/loundry/{id}/cuci', 'updateServiceCuci')->name('servicecuci.update');
    Route::get('/service/loundry/{id}/payment', 'editServicePayment')->name('servicepayment.edit');
    Route::patch('/service/loundry/{id}/payment', 'updateServicePayment')->name('servicepayment.update');
    Route::post('/add/service/cuci', 'addServiceCuci')->name('addservicecuci.store');
    Route::post('/add/service/payment', 'addServicePayment')->name('addservicepayment.store');
});
