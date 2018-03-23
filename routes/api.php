<?php
/*
$this->get('categories','Api\CategoryController@index');
$this->post('categories','Api\CategoryController@store');
$this->put('categories/{id}','Api\CategoryController@update');
$this->delete('categories/{id}','Api\CategoryController@delete');
*/

$this->post('users','Api\UserController@store');

$this->post('auth', 'Auth\AuthApiController@authenticate');
$this->post('auth-refresh', 'Auth\AuthApiController@refreshToken');
$this->get('me', 'Auth\AuthApiController@getAuthenticatedUser');

$this->group(['prefix' => 'v1', 'namespace' => 'Api'], function(){

    $this->apiResource('courses', 'CourseController');

});



