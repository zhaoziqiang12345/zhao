<?php

// Route::view('/','admin@default');
//                URI地址		  模块 / 控制器 / 方法名	
Route::group([],function(){
	Route::rule('/admin/user/create','admin/UsersController/create');
	Route::rule('/admin/user/save',  'admin/UsersController/save');
	Route::rule('/admin/user/index', 'admin/UsersController/index');
	Route::rule('/admin/user/:id/delete','admin/UsersController/delete');
	Route::rule('/admin/user/:id/edit', 'admin/UsersController/edit');
	Route::rule('/admin/user/update/:id', 'admin/UsersController/update');
})->after('\app\admin\behavior\CheckLogin');
// 类别管理
Route::group(['name'=>'/admin/cate','prefix'=>'admin/CateController/'],function(){
	Route::rule('create/[:id]','create','get');
	Route::rule('save','save','post');
	Route::rule('index','index','get');
	Route::rule(':id/delete','delete','get');
	Route::rule(':id/edit','edit','get');
	Route::rule('update/:id','update','post');
})->after('\app\admin\behavior\CheckLogin');

/* 商品管理 */
Route::group(['name'=>'/admin/goods','prefix'=>'admin/GoodController/'],function(){
	Route::rule('create','create','get');
	Route::rule('save','save','post');
	Route::rule('index','index','get');
	Route::rule(':id/edit','edit','get');
	Route::rule('update/:id','update','post');
	Route::rule(':id/delete','delete','get');

	Route::rule(':id/up','up','get');
	Route::rule(':id/down','down','get');
})->after('\app\admin\behavior\CheckLogin');

// 路由管理
Route::rule('/code','admin/LoginController/verify');
Route::rule('/admin/dologin','admin/LoginController/dologin','post');
Route::rule('/admin/login','admin/LoginController/login');