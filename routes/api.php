<?php


/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/
Route::prefix('categories')->group(static function () {

    Route::get('/', 'API\CategoryController@get');

});
Route::prefix('places')->group(static function () {

    Route::get('/', 'API\PlaceController@get');
    Route::get('/{id}', 'API\PlaceController@fetch');
    Route::post('/store', 'API\placeController@store');
    Route::delete('/{id}', 'API\PlaceController@destroy');
    Route::post('/get-by-category', 'API\PlaceController@getByCategory');
    Route::post('/get-by-All', 'API\PlaceController@getByAll');


});






Route::prefix('districts')->group(static function () {

    Route::post('/search', 'API\DistrictController@filter');


});




Route::post('login', 'API\UserController@login');

Route::post('login','API\UserController@login');

Route::post('social-login', 'API\UserController@socialLogin');

Route::post('finger-print', 'API\UserController@fingerPrint');

Route::post('register', 'API\UserController@register');

Route::post('users/{id}/add-questionnaire', 'API\UserController@addQuestionnaire');

//Route::post('add-password/{token}', 'API\UserController@registerPassword');

Route::post('add-details', 'API\UserController@addDetails');

Route::post('forget-password', 'API\UserController@forgetPasswordRequest');

Route::post('match-pin', 'API\UserController@forgetPasswordPin');

Route::post('match-otp', 'API\UserController@checkOtp');

Route::post('generate-new-otp', 'API\UserController@generateNewOtp');

Route::post('change-password', 'API\UserController@changePasswordPin');

Route::post('send-feedback-request', 'API\SupportController@sendSupportRequest');

Route::post('check-email', 'API\UserController@checkEmail');

Route::group(['middleware' => 'auth:api'], static function () {

    Route::prefix('places')->group(static function () {


        Route::post('/{id}/visited-unvisited', 'API\PlaceVisitedController@visitedUnvisited');

    });

    Route::prefix('events')->group(static function () {


        Route::post('/{id}/Interested-notInterested', 'API\IntrestedController@InterestedNotInterested');


        Route::post('/{id}/rating', 'API\EventController@rate');


        Route::post('/{id}/favorite-unfavorite', 'API\FavoriteController@favoriteUnFavorite');


        Route::post('/all-favorite', 'API\FavoriteController@getAllAgainstUser');

        Route::post('/last-join', 'API\EventController@getLastEvent');


    });






    /*
     *
     *  User Routes Group
     */


    Route::group(['prefix' => 'user'], static function () {

        Route::post('/update-profile', 'API\UserController@updateDetails');

        Route::get('/get-profile', 'API\UserController@details');

        Route::post('/logout', 'API\UserController@logout');

    });

    Route::post('send-notification/{userId}', 'API\NotificationController@sendNotificationToSpecific');

    Route::post('categories', 'API\CategoryController@getAll');

    Route::post('details',  'API\UserController@details');

    Route::post('update-details', 'API\UserController@updateDetails');

    Route::post('sign-out', 'API\UserController@signout');

    Route::post('logout', 'API\UserController@logout');

    Route::post('update-rating', 'API\RatingController@storeOrUpdate');

    Route::get('get-rating', 'API\RatingController@getRating');
});

Route::get('about-us', 'API\ContentManagementController@aboutUs');

Route::get('terms-and-conditions', 'API\ContentManagementController@terms');

Route::get('privacy-policy', 'API\ContentManagementController@privacy');

Route::get('banner', 'API\ContentManagementController@banner');
