<?php

//Testing
Route::get('/testing/minidagboek/renderDatum', 'TestsController@testRenderDatum');
Route::get('/testing/minidagboek/addEntries/{mode}', 'TestsController@testAddEntries');

//Minidagboek
Route::get('/minidagboek/backups/initialise', 'ContentController@getBackupInhoud');


Route::get('/minidagboek/deleteEntries', 'MinidagboekController@deleteEntries');

Route::get('/minidagboek/getAllByJaar/{jaar}', 'MinidagboekController@getAllByJaar');
Route::get('/minidagboek/getAllByJaarAndMaand/{jaar}/{maand}', 'MinidagboekController@getAllByJaarAndMaand');
Route::get('/minidagboek/getAllEntries', 'MinidagboekController@getAllEntries');

Route::get('/minidagboek/addEntry', 'MinidagboekController@addEntryMetRequest');
Route::post('/minidagboek/addEntries', 'MinidagboekController@addEntriesMetRequest');
Route::post('/minidagboek/overrideDuplicates', 'MinidagboekController@overrideDuplicates');
Route::get('/minidagboek/initialise', 'ContentController@initialise');

//Pages
Route::get('/dagboek', 'PagesController@getDagboek');
Route::get('/minidagboek', 'PagesController@getMinidagboek');
Route::get('/andere', 'PagesController@getAndere');
Route::get('/moodboek', 'PagesController@getMoodboek');

//Root
Route::get('/', 'PagesController@getHome');

