<?php
Route::get('/', 'SiteController@index');

Route::prefix('/data')->group(function () {
    Route::get('/user', 'DataController@user');
    Route::post('/user/venues/add', 'DataController@addUserVenue');
    Route::post('/user/venues/remove', 'DataController@removeUserVenue');
    Route::get('/recommendations/{location}/{section}/{query}', 'DataController@recommendations');
    Route::get('/weather/{location}', 'DataController@weather');
    Route::get('/photos/{location}', 'DataController@photos');
    Route::get('/venue/{id}', 'DataController@venue');
    Route::get('/latestsearches', 'DataController@latestSearches');
    Route::get('/latestvenueviews', 'DataController@latestVenueViews');
});

Auth::routes();