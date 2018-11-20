<?php
// +----------------------------------------------------------------------
// | ThinkPHP [ WE CAN DO IT JUST THINK ]
// +----------------------------------------------------------------------
// | Copyright (c) 2006~2018 http://thinkphp.cn All rights reserved.
// +----------------------------------------------------------------------
// | Licensed ( http://www.apache.org/licenses/LICENSE-2.0 )
// +----------------------------------------------------------------------
// | Author: liu21st <liu21st@gmail.com>
// +----------------------------------------------------------------------

Route::rule('/','home/IndexController/index');

Route::rule('/goods/cate/:id','home/GoodsController/index');
Route::rule('/goods/name','home/GoodsController/index');
Route::rule('/goods/show/:id','home/GoodsController/read');

Route::rule('/cart/add/:id','home/CartController/add');
Route::rule('/cart/index','home/CartController/index');
Route::rule('/cart/:id/inc','home/CartController/inc');
Route::rule('/cart/:id/dec','home/CartController/dec');
Route::rule('/cart/del/:id','home/CartController/delete');

Route::rule('/login','home/LoginController/login');
Route::rule('/dologin','home/LoginController/dologin');
Route::rule('/logout','home/LoginController/logout');

Route::group([],function(){
	Route::rule('/orders/getinfo','home/OrderController/getinfo');
	Route::rule('/orders/commit','home/OrderController/commit');
	Route::rule('/orders/save','home/OrderController/save');
})->middleware('CheckLogin');
include 'admin.php';

return [

];
