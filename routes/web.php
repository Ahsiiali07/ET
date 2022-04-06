<?php

use Illuminate\Support\Facades\Auth;
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

Route::get( '/', 'WelcomeController@index' )->name( 'welcome' );

Auth::routes();

Route::get( '/home', 'HomeController@index' )->name( 'home' );

Route::prefix( 'users' )->group( static function () {
    Route::get( '/', 'Web\UserController@index' )->name( 'users' );
    Route::get( '/patient', 'Web\UserController@indexPatient' )->name( 'users-patient' );
    Route::get( '/psw', 'Web\UserController@indexPSW' )->name( 'users-psw' );
    Route::get('export/', 'Web\UserController@export')->name('user-export');
    Route::get( '/{id}', 'Web\UserController@show' )->name( 'user' );
    Route::get( '/{id}/edit', 'Web\UserController@edit' )->name( 'user-edit' );
    Route::post( '/{id}/update', 'Web\UserController@update' )->name( 'user-status-update' );
    Route::delete( '/{id}/delete', 'Web\UserController@destroy' )->name( 'user-delete' );
    Route::post( '/{id}/approve', 'Web\UserController@approve' )->name( 'user-approve' );
    Route::get( '/{id}/show-answers', 'Web\QuestionController@showAnswersForSpecificUser' )->name( 'user-answers' );
    Route::get( '/{id}/show-documents', 'Web\QuestionController@showDocumentsForSpecificUser' )->name( 'user-documents' );
} );

Route::prefix( 'send-notification' )->group( static function () {
    Route::get( '/create', 'Web\NotificationController@create' )->name( 'send-notification' );
    Route::post( '/send', 'Web\NotificationController@sendNotification' )->name( 'notification-send-to-all' );

} );


Route::prefix( 'categories' )->group( static function () {
    Route::get( '/', 'Web\CategoryController@index' )->name( 'categories' );
    Route::get( '/create', 'Web\CategoryController@create' )->name( 'category-create' );
    Route::post( '/store', 'Web\CategoryController@store' )->name( 'category-store' );
    Route::get( '/{id}', 'Web\CategoryController@show' )->name( 'category' );
    Route::delete( '/{id}', 'Web\CategoryController@destroy' )->name( 'category-delete' );
    Route::get( '/{id}/edit', 'Web\CategoryController@edit' )->name( 'category-edit' );
    Route::post( '/{id}/update', 'Web\CategoryController@update' )->name( 'category-update' );
    Route::post( '/{id}/update', 'Web\CategoryController@update' )->name( 'category-update' );
} );


Route::prefix( 'districts' )->group( static function () {
    Route::get( '/', 'Web\DistrictController@index' )->name( 'districts' );
    Route::get( '/create', 'Web\DistrictController@create' )->name( 'district-create' );
    Route::post( '/store', 'Web\DistrictController@store' )->name( 'district-store' );
    Route::get( '/{id}', 'Web\DistrictController@show' )->name( 'district' );
    Route::delete( '/{id}', 'Web\DistrictController@destroy' )->name( 'district-delete' );
    Route::get( '/{id}/edit', 'Web\DistrictController@edit' )->name( 'district-edit' );
    Route::post( '/{id}/update', 'Web\DistrictController@update' )->name( 'district-update' );
    Route::post( '/{id}/update', 'Web\DistrictController@update' )->name( 'district-update' );
} );



Route::prefix( 'places' )->group( static function () {
    Route::get( '/', 'Web\PlacesController@index' )->name( 'places' );
    Route::get( '/create', 'Web\PlacesController@create' )->name( 'place-create' );
    Route::post( '/store', 'Web\PlacesController@store' )->name( 'place-store' );
    Route::get( '/{id}', 'Web\PlacesController@show' )->name( 'place' );
    Route::delete( '/{id}', 'Web\PlacesController@destroy' )->name( 'place-delete' );
    Route::get( '/{id}/edit', 'Web\PlacesController@edit' )->name( 'place-edit' );
    Route::post( '/{id}/update', 'Web\PlacesController@update' )->name( 'place-update' );
} );






Route::prefix( 'content-management' )->group( static function () {
    Route::get( '/', 'Web\ContentManagementController@index' )->name( 'cms' );
    Route::get( '/{id}', 'Web\ContentManagementController@show' )->name( 'cm' );
    Route::delete( '/{id}', 'Web\ContentManagementController@destroy' )->name( 'cm-delete' );
    Route::get( '/{id}/edit', 'Web\ContentManagementController@edit' )->name( 'cm-edit' );
    Route::post( '/{id}/update', 'Web\ContentManagementController@update' )->name( 'cm-update' );
} );

Route::prefix( 'support' )->group( static function () {
    Route::get( '/', 'Web\SupportController@index' )->name( 'support-requests' );
    Route::get( '/{id}', 'Web\SupportController@show' )->name( 'support-request' );
    Route::post( '/{id}/close', 'Web\SupportController@close' )->name( 'support-close' );
    Route::post( '/{id}/open', 'Web\SupportController@open' )->name( 'support-open' );
});








