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
    return view('welcome');
});


/* Auto-generated admin routes */
Route::middleware(['auth:' . config('admin-auth.defaults.guard'), 'admin'])->group(static function () {
    Route::prefix('admin')->namespace('App\Http\Controllers\Admin')->name('admin/')->group(static function () {
        Route::prefix('admin-users')->name('admin-users/')->group(static function () {
            Route::get('/',                                             'AdminUsersController@index')->name('index');
            Route::get('/create',                                       'AdminUsersController@create')->name('create');
            Route::post('/',                                            'AdminUsersController@store')->name('store');
            Route::get('/{adminUser}/impersonal-login',                 'AdminUsersController@impersonalLogin')->name('impersonal-login');
            Route::get('/{adminUser}/edit',                             'AdminUsersController@edit')->name('edit');
            Route::post('/{adminUser}',                                 'AdminUsersController@update')->name('update');
            Route::delete('/{adminUser}',                               'AdminUsersController@destroy')->name('destroy');
            Route::get('/{adminUser}/resend-activation',                'AdminUsersController@resendActivationEmail')->name('resendActivationEmail');
        });
    });
});

/* Auto-generated admin routes */
Route::middleware(['auth:' . config('admin-auth.defaults.guard'), 'admin'])->group(static function () {
    Route::prefix('admin')->namespace('App\Http\Controllers\Admin')->name('admin/')->group(static function () {
        Route::get('/profile',                                      'ProfileController@editProfile')->name('edit-profile');
        Route::post('/profile',                                     'ProfileController@updateProfile')->name('update-profile');
        Route::get('/password',                                     'ProfileController@editPassword')->name('edit-password');
        Route::post('/password',                                    'ProfileController@updatePassword')->name('update-password');
    });
});

/* Auto-generated admin routes */
Route::middleware(['auth:' . config('admin-auth.defaults.guard'), 'admin'])->group(static function () {
    Route::prefix('admin')->namespace('App\Http\Controllers\Admin')->name('admin/')->group(static function () {
        Route::prefix('admin-users')->name('admin-users/')->group(static function () {
            Route::get('/',                                             'AdminUsersController@index')->name('index');
            Route::get('/create',                                       'AdminUsersController@create')->name('create');
            Route::post('/',                                            'AdminUsersController@store')->name('store');
            Route::get('/{adminUser}/impersonal-login',                 'AdminUsersController@impersonalLogin')->name('impersonal-login');
            Route::get('/{adminUser}/edit',                             'AdminUsersController@edit')->name('edit');
            Route::post('/{adminUser}',                                 'AdminUsersController@update')->name('update');
            Route::delete('/{adminUser}',                               'AdminUsersController@destroy')->name('destroy');
            Route::get('/{adminUser}/resend-activation',                'AdminUsersController@resendActivationEmail')->name('resendActivationEmail');
        });
    });
});

/* Auto-generated admin routes */
Route::middleware(['auth:' . config('admin-auth.defaults.guard'), 'admin'])->group(static function () {
    Route::prefix('admin')->namespace('App\Http\Controllers\Admin')->name('admin/')->group(static function () {
        Route::prefix('restaurant-tables')->name('restaurant-tables/')->group(static function () {
            Route::get('/',                                             'RestaurantTablesController@index')->name('index');
            Route::get('/create',                                       'RestaurantTablesController@create')->name('create');
            Route::post('/',                                            'RestaurantTablesController@store')->name('store');
            Route::get('/{restaurantTable}/edit',                       'RestaurantTablesController@edit')->name('edit');
            Route::post('/bulk-destroy',                                'RestaurantTablesController@bulkDestroy')->name('bulk-destroy');
            Route::post('/{restaurantTable}',                           'RestaurantTablesController@update')->name('update');
            Route::delete('/{restaurantTable}',                         'RestaurantTablesController@destroy')->name('destroy');
        });
    });
});

/* Auto-generated admin routes */
Route::middleware(['auth:' . config('admin-auth.defaults.guard'), 'admin'])->group(static function () {
        Route::prefix('admin')->namespace('App\Http\Controllers\Admin')->name('admin/')->group(static function () {
        Route::prefix('restaurant-table-reservations')->name('restaurant-table-reservations/')->group(static function () {
            Route::get('/',                                             'RestaurantTableReservationsController@index')->name('index');
            Route::get('/create',                                       'RestaurantTableReservationsController@create')->name('create');
            Route::post('/',                                            'RestaurantTableReservationsController@store')->name('store');
            Route::get('/{restaurantTableReservation}/edit',            'RestaurantTableReservationsController@edit')->name('edit');
            Route::post('/bulk-destroy',                                'RestaurantTableReservationsController@bulkDestroy')->name('bulk-destroy');
            Route::post('/{restaurantTableReservation}',                'RestaurantTableReservationsController@update')->name('update');
            Route::delete('/{restaurantTableReservation}',              'RestaurantTableReservationsController@destroy')->name('destroy');
        });
        
        
        Route::get('/make-reservation',                                  'RestaurantTableReservationsController@makeReservation')->name('makeReservation');
        Route::get('/seachAvailableTimes',                              'RestaurantTableReservationsController@seachAvailableTimes')->name('seachAvailableTimes');
        Route::post('/execute_reservation',                              'RestaurantTableReservationsController@execute_reservation')->name('seachAvailableTimes');
    });
});


Route::middleware(['web'])->group(static function () {
    Route::namespace('App\Http\Controllers\Auth')->group(static function () {
        Route::get('/admin/login', 'LoginController@showLoginForm')->name('brackets/admin-auth::admin/login');
        Route::get('', 'LoginController@showLoginForm')->name('brackets/admin-auth::admin/login');
        Route::post('/admin/login', 'LoginController@login');
    });
});

