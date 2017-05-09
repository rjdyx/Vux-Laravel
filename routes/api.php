<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::group(['namespace'=>'Admin','prefix'=>'admin'],function(){
    /**
     * 普通商品路由
     */
    Route::post('add_goods_class','Goods@addGoodsClass'); //添加普通商品分类
    Route::get('get_goods_class_list','Goods@getGoodsClassList'); //获取某个区域全部普通商品分类
    Route::post('edit_goods_class','Goods@editGoodsClass'); //修改普通商品分类
    Route::post('delete_goods_class','Goods@deleteGoodsClass'); //删除普通商品分类
    /**
     * 区域路由
     */
    Route::post('add_area','Area@addArea'); //添加区域
    Route::get('get_area_list','Area@getAreaList'); //获取全部区域
    Route::post('edit_area','Area@editArea'); //修改区域
    Route::post('delete_area','Area@deleteArea'); //删除区域
});
