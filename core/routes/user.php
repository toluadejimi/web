<?php

use Illuminate\Support\Facades\Route;

Route::namespace('User\Auth')->name('user.')->group(function () {

    Route::controller('LoginController')->group(function(){
        Route::get('/login', 'showLoginForm')->name('login');
        Route::post('/login', 'login');
        Route::get('logout', 'logout')->middleware('auth')->name('logout');
    });

    Route::controller('RegisterController')->group(function(){
        Route::get('register', 'showRegistrationForm')->name('register');
        Route::post('register', 'register')->middleware('registration.status');
        Route::post('check-mail', 'checkUser')->name('checkUser');
    }); 

    Route::controller('ForgotPasswordController')->prefix('password')->name('password.')->group(function(){
        Route::get('reset', 'showLinkRequestForm')->name('request');
        Route::post('email', 'sendResetCodeEmail')->name('email');
        Route::get('code-verify', 'codeVerify')->name('code.verify');
        Route::post('verify-code', 'verifyCode')->name('verify.code');
    });
    Route::controller('ResetPasswordController')->group(function(){ 
        Route::post('password/reset', 'reset')->name('password.update');
        Route::get('password/reset/{token}', 'showResetForm')->name('password.reset');
    });
}); 

Route::middleware('auth')->name('user.')->group(function () {
    //authorization
    Route::namespace('User')->controller('AuthorizationController')->group(function(){
        Route::get('authorization', 'authorizeForm')->name('authorization');
        Route::get('resend-verify/{type}', 'sendVerifyCode')->name('send.verify.code');
        Route::post('verify-email', 'emailVerification')->name('verify.email');
        Route::post('verify-mobile', 'mobileVerification')->name('verify.mobile');
        Route::post('verify-g2fa', 'g2faVerification')->name('go2fa.verify');
    });

    Route::middleware(['check.status'])->group(function () {
  
        Route::get('user-data', 'User\UserController@userData')->name('data');
        Route::post('user-data-submit', 'User\UserController@userDataSubmit')->name('data.submit');

        Route::middleware('registration.complete')->namespace('User')->group(function () {
            
            //Invoice
            Route::controller('InvoiceController')->prefix('invoice')->name('invoice.')->group(function(){
                Route::post('/create','create')->name('create');
                Route::get('/view/{id}', 'viewInvoice')->name('view');
                Route::post('/payment', 'payment')->name('payment')->middleware('kyc');
                Route::get('/list', 'list')->name('list');
                Route::get('/download/{id}/{view?}', 'download')->name('download');
            });


            Route::controller('UserController')->group(function(){
                Route::get('dashboard', 'home')->name('home');

                //Trying to login into the cPanel account
                Route::get('login/cPanel/{id}', 'loginCpanel')->name('login.cpanel');

                //Service / Hosting
                Route::controller('ServiceController')->prefix('service')->name('service.')->group(function(){
                    Route::get('/list', 'list')->name('list');
                    Route::get('/details/{id}', 'details')->name('details');
                    Route::post('service/cancel/request', 'cancelRequest')->name('cancel.request');
                });
                
                //Domain
                Route::controller('DomainController')->prefix('domain')->name('domain.')->group(function(){
                    Route::get('/list', 'list')->name('list');
                    Route::get('/details/{id}', 'details')->name('details');
                    Route::post('/nameserver/update', 'nameServerUpdate')->name('nameserver.update');
                    Route::get('/contact/{id}', 'contact')->name('contact');
                    Route::post('.contact/update', 'contactUpdate')->name('contact.update');
                });
                
                //2FA 
                Route::get('twofactor', 'show2faForm')->name('twofactor');
                Route::post('twofactor/enable', 'create2fa')->name('twofactor.enable');
                Route::post('twofactor/disable', 'disable2fa')->name('twofactor.disable');

                //KYC
                Route::get('kyc-form','kycForm')->name('kyc.form');
                Route::get('kyc-data','kycData')->name('kyc.data');
                Route::post('kyc-submit','kycSubmit')->name('kyc.submit');

                //Report
                Route::any('deposit/history', 'depositHistory')->name('deposit.history'); 
                Route::get('transactions','transactions')->name('transactions');
                Route::get('email/history','emailHistory')->name('email.history');
                Route::get('email/details/{id}','emailDetails')->name('email.details');

                Route::get('attachment-download/{fil_hash}','attachmentDownload')->name('attachment.download');
            });

            //Profile setting 
            Route::controller('ProfileController')->group(function(){ 
                Route::get('profile-setting', 'profile')->name('profile.setting');
                Route::post('profile-setting', 'submitProfile'); 
                Route::get('change-password', 'changePassword')->name('change.password');
                Route::post('change-password', 'submitPassword');
            });

        });

        // Payment
        Route::middleware(['registration.complete', 'kyc'])->prefix('deposit')->name('deposit.')->controller('Gateway\PaymentController')->group(function(){
            Route::any('/', 'deposit')->name('index');
            Route::post('insert', 'depositInsert')->name('insert');
            Route::get('confirm', 'depositConfirm')->name('confirm');
            Route::get('manual', 'manualDepositConfirm')->name('manual.confirm');
            Route::post('manual', 'manualDepositUpdate')->name('manual.update');
        });
    });
});
