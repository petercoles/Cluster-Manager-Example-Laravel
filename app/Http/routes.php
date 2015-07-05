<?php

// view routes
get('/', 'ViewController@home');

// server routes
get('read', 'ServerController@index');
get('read/{id}', 'ServerController@show');
get('create', 'ServerController@create');
get('delete/all', 'ServerController@deleteAll');
get('delete/{id}', 'ServerController@delete');
get('count', 'ServerController@count');

// api routes
get('api/cluster-stats', 'ApiController@clusterStats');
get('api/documents', 'ApiController@documentList');
get('api/teardown', 'ApiController@teardown');

//process routes
post('file-upload', 'ProcessController@fileUpload');
post('receive-pdf', 'ProcessController@receivePdf');
