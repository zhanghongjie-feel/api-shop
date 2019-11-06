<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::any('admin/cate/blur','Admin\AdminController@category_blur');
Route::any('admin/cate/add','Admin\AdminController@category_add');
Route::post('admin/cate/add_do','Admin\AdminController@category_add_do');
Route::get('admin/cate/index','Admin\AdminController@category_index');

Route::any('admin/type/add','Admin\AdminController@type_add');
Route::any('admin/type/add_do','Admin\AdminController@type_add_do');
Route::get('admin/type/index','Admin\AdminController@type_index');

Route::any('admin/attr/add','Admin\AdminController@attr_add');
Route::any('admin/attr/add_do','Admin\AdminController@attr_add_do');
Route::any('admin/attr/index','Admin\AdminController@attr_index');
Route::any('admin/attr/show','Admin\AdminController@attr_show');
Route::any('admin/attr/delAll','Admin\AdminController@attr_delAll');


//————————————————————————————————————
Route::any('admin/goods/add','Admin\GoodsController@goods_add');
Route::any('admin/goods/getAttr','Admin\GoodsController@goods_getAttr');
Route::any('admin/goods/add_do','Admin\GoodsController@goods_add_do');
Route::any('upload','Admin\GoodsController@upload');
Route::any('do_upload','Admin\GoodsController@do_upload');
Route::any('admin/product/add','Admin\GoodsController@product_add');

Route::prefix('admin')->group(function(){
    Route::any('wechat/login','Admin\AdminController@wechat_login');
    Route::any('wechat/login_do','Admin\AdminController@wechat_login_do');
  Route::any('product/add_do','Admin\GoodsController@product_add_do');
  Route::any('goods/show','Admin\GoodsController@goods_show');
});


Route::prefix('api')->middleware('apiheader')->group(function (){
        Route::any('login','Index\UserController@login');
        Route::any('getUser','Index\UserController@getUser');
        Route::any('goodsinfo','Index\IndexController@goodsinfo');
        Route::any('detail','Index\IndexController@detail');
        
    // Route::any('cartAdd','Index\UserController@cartAdd');
    Route::middleware('Token')->group(function(){

        Route::any('cartAdd','Index\UserController@cartAdd');
        Route::any('cartShow','Index\IndexController@cartShow');
        Route::any('dudu','Index\IndexController@dudu');
        Route::any('cateinfo','Index\IndexController@cateinfo');
    });
    
    

});
Route::any('apiTest','Test@apiTest');
Route::any('useApi','Test@useApi');
Route::any('class_show','Index\IndexController@class_show');
Route::any('student_show','Index\IndexController@student_show');
Route::any('aes_decrypt','Index\IndexController@aes_decrypt');
Route::any('aes_encrypt','Index\IndexController@aes_encrypt');
Route::any('Rsa','Key\Rsa@rsa');


Route::any('use_api','lonely\NewController@use_api');
Route::any('new/login','lonely\NewController@login');
Route::any('new/login_do','lonely\NewController@login_do');
Route::any('new/register','lonely\NewController@register');
Route::any('new/do_register','lonely\NewController@do_register');
        Route::any('new/show','lonely\NewController@show');


Route::any('wechat/login','lonely\WechatController@login');

Route::any('wechat/get_token','lonely\WechatController@get_token');
// Route::any('aa','lonely\WechatController@aa');

Route::any('wechat/login','lonely\WechatController@login');

Route::any('exam/use_api','lonely\Exam@use_api');

Route::any('exam/show','lonely\Exam@new_show');


Route::prefix('mini')->group(function(){
    Route::any('nav/lists','wechat_app\NavController@lists');
    Route::any('search','wechat_app\NavController@search');
});