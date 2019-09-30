<?php


Route::post('login', 'Api\UsersController@login');
Route::post('logout',"Api\UsersController@logoutApi")->middleware('auth:api');
Route::post('register', 'Api\UsersController@register');

Route::get('auth/facebooka','Auth\RegisterController@redirectToProviderapi');
Route::get('auth/facebook/callback', 'Auth\RegisterController@handleProviderCallbackapi');
Route::get('auth/google', 'google@redirectToProviderapi');
Route::get('auth/google/callback', 'google@handleProviderCallbackapi');

  Route::get('slider','Api\MySiteController@slider');
  Route::get('homecats', 'Api\MySiteController@homecats');
  Route::get('fbrands', 'Api\MySiteController@fbrands');
  Route::get('root', 'Api\MySiteController@root');
  Route::get('children/{id}', 'Api\MySiteController@children');
  Route::get('catproducts/{id}', 'Api\MySiteController@catproducts');
  Route::get('allbrands', 'Api\MySiteController@allbrands');
  Route::get('allproducts', 'Api\MySiteController@allproducts');
  Route::get('brandproducts/{id}', 'Api\MySiteController@brandproducts');
  Route::get('product/{id}', 'Api\MySiteController@product');
  Route::get('popular_products', 'Api\MySiteController@popular');
  Route::get('newest_products', 'Api\MySiteController@newest');
  Route::get('offers', 'Api\MySiteController@offers');
  Route::get('user/{id}', 'Api\MySiteController@user');
  Route::get('rootchildren', 'Api\MySiteController@rootchildren');
  Route::get('search', 'Api\MySiteController@search');
  Route::get('countries', 'Api\MySiteController@countries');
  Route::get('filter/{min}/{max}', 'Api\MySiteController@filter');
  Route::get('catfilter/{id}/{min}/{max}', 'Api\MySiteController@catfilter');
  Route::get('offerfilter/{min}/{max}', 'Api\MySiteController@offerfilter');
  Route::get('brandfilter/{brand_id}/{min}/{max}', 'Api\MySiteController@brandfilter');

  Route::group(array('middleware' => 'auth:api'), function() {

  Route::get('offerrange', 'Api\ApiController@offerrange');
  Route::get('range', 'Api\ApiController@range');
  Route::get('catrange/{id}', 'Api\ApiController@catrange');
  Route::get('brandrange/{id}', 'Api\ApiController@brandrange');
  Route::get('brandsbycat/{cat_id}', 'Api\ApiController@brandsbycat');
  Route::get('brandsoffer', 'Api\ApiController@brandsoffer');
  Route::get('updatecart/{id}/{newq}', 'Api\OrderController@UpdateCart');
  Route::get('curr', 'Api\MySiteController@currency');
  Route::get('shipments', 'Api\MySiteController@shipments');
  Route::put('updateprofile/{id}', 'Api\MySiteController@updateprofile');
  Route::get('like/{user_id}/{product_id}', 'Api\MySiteController@like');
  Route::get('myorders/{user_id}', 'Api\MySiteController@myorders');
  Route::get('checklike/{user_id}/{product_id}', 'Api\MySiteController@checklike');
  Route::get('wlist/{user_id}', 'Api\MySiteController@wlist');
  Route::post ('submitshipment', 'Api\MySiteController@submitaddress');
  Route::put('editaddress/{id}', 'Api\MySiteController@editaddress');
  Route::get('showaddress/{id}', 'Api\MySiteController@showaddress');
  Route::post('order', 'Api\OrdersController@order');
  Route::get('payments', 'Api\MySiteController@payments');
  Route::get('cities/{id}', 'Api\MySiteController@cities');

});