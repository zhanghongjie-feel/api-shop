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
