<?php

Route::group(['middleware' => 'respondent'], function () {
    Route::get('/', 'DashboardController')->name('dashboard.index');

    Route::get('reset', 'ResetController')->name('reset');

    Route::get('results', 'Results\IndexController')->name('results.index');
    Route::get('results/export', 'Results\ExportController')->name('results.export');

    Route::post('questions/{question}', 'Questions\StoreController')->name('questions.store');
    Route::get('{category}/{question?}', 'Questions\ShowController')->name('questions.show');
});
