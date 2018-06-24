<?php

$this->post('users','Api\UserController@store');
$this->post('auth', 'Auth\AuthApiController@authenticate');
$this->post('auth-refresh', 'Auth\AuthApiController@refreshToken');
$this->get('me', 'Auth\AuthApiController@getAuthenticatedUser');
$this->post('hotmart', 'Api\HotmartController@access');

$this->group(['prefix' => 'v1', 'namespace' => 'Api\V1'], function(){

    $this->apiResource('classrooms', 'ClassroomController');
    $this->apiResource('modules', 'ModuleController');
    $this->apiResource('courses', 'CourseController');
    $this->apiResource('sales', 'SaleController');
    $this->apiResource('categories', 'CategoryController');
    $this->get('my-sales', 'SaleController@mySales');
    $this->get('my-course/{url}', 'CourseController@myCourse');
    
});