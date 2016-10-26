<?php

/**
 * API ROUTES
 */

Route::group(['prefix' => 'api'], function () {

    /**
     * Front-end API Routes
     */
    Route::group(['prefix' => 'booking', 'namespace' => 'Twentysix\Booker\Controllers\Bookings'], function () {

        // Front-end Booking Routes
        Route::put('/{id}', 'BookingController@update');
        Route::get('/{date}/{valid?}', 'BookingController@getBookingsByDate')->name("getBookingsByDate");

        // Booking Settings
    });

    Route::get('/settings/booking', 'Twentysix\Booker\Controllers\Bookings\BookingSettingsController@get');

    /**
     * Backend/Admin API Routes
     */
    Route::group(['prefix' => 'admin', 'namespace' => 'Twentysix\Booker\Controllers\Admin'], function () {

        Route::group(['prefix' => 'booking', 'namespace' => 'Bookings', 'middleware' => ['web', 'auth']], function () {

            // Admin Booking Routes
            Route::get('/all', "BookingController@all");
            Route::delete('/{id}', 'BookingController@delete')->name('deleteBooking');

            // Booking Settings
            Route::put('/settings', "BookingSettingsController@update");
        });

    });

});

/**
 * Admin Routes
 */

Route::group(['prefix' => 'backend', 'namespace' => 'Twentysix\Booker\Controllers\Admin'], function () {

    /**
     * Booking Routes
     */

    Route::group(['middleware' => ['web', 'auth']], function () {

        /**
         * Booking Routes
         */

        // Non API Booking Routes
        Route::get('/booking', "Bookings\BookingController@index");
        Route::get('/booking/view/{id}', "Bookings\BookingController@view")->name("viewBooking");
        Route::get('/booking/new', 'Bookings\BookingController@add')->name("newBooking");
        Route::put('/booking/{id}', 'Bookings\BookingController@update')->name('updateBooking');
        Route::get('/booking/date', 'Bookings\BookingController@bookingsByDate')->name("dateBooking");

        // API Booking Routes
        Route::post('/booking', "Bookings\BookingController@create");

        // Booking Settings Routes
        Route::get('/booking/settings/view', "Bookings\BookingSettingsController@view")->name('viewSettings');

    });

});