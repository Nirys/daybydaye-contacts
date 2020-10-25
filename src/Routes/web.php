<?php

Route::group(['middleware' => 'web', 'namespace' => '\SpiritSystems\DayByDay\Contacts\Http\Controllers'], function () {
    Route::get('contacts/{clientId}/datatable', 'ContactsController@clientData')->name('clients.contactDataTable');
    Route::get('client_contacts/{clients_external_id}/create', 'ContactsController@createClientContact')->name('contact.client.create');
    Route::resource('contacts', 'ContactsController');
});
