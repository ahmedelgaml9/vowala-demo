<?php

              session_start();
            if (!isset($_SESSION['cart'])) {
                $_SESSION['cart'] = null;
                $_SESSION['total'] = 0;
             
            }

              Route::get('shipments', function () {
                  return $_SESSION['t'];
                 return $_SESSION['shipping'];
             });
          
             if (Session::get('local') == 'ar') {
                     Session::put('local', 'ar');
              } else {
                     Session::put('local', 'en');
              }
    
             Route::get('lang/en', function () {
             $data= App\Main::find(1);
             $data->setlang= 1;
             $data->save();
             return Redirect::back();
              
              });
          
             Route::get('lang/ar', function () {
             $data= App\Main::find(1);
             $data->setlang= 0;
             $data->save();
              return Redirect::back();
            });

            Auth::routes();
            Route::get('/home', 'HomeController@index')->name('home');
            Route::group(array('middleware' => array('auth', 'admin'), 'prefix' => 'admin'), function () {
            Route::resource('messages', 'MessagesController');
            Route::get('unseen', 'MessagesController@create');
            Route::resource('notifications', 'NotificationsController');
            Route::get('unseen-notifications', 'NotificationsController@create');

            Route::get('/', function () {
                return view('admin.counters');
            });
            
            Route::resource('users', 'UsersController');
            Route::resource('currency', 'CurrencyController');
            Route::resource('area', 'AreasController');
            Route::resource('ourcatalog', 'CatalogController'); 
            Route::resource('sections', 'SectionController'); 
            Route::resource('subcats', 'SubcatController'); 
            Route::resource('payment', 'PaymentController');  
            Route::resource('discounts', 'DiscountController');  
            Route::resource('brands', 'BrandController');
            Route::resource('blocks', 'BlockController');
            Route::resource('adds',   'AddController');
            Route::resource('benefits', 'BenefitsController');  
            Route::resource('cartproducts', 'ProductController');
            Route::resource('size', 'SizesController'); 
            Route::resource('color', 'ColorsController'); 

            Route::get('copyproducts/{id}','ProductController@createcopyproducts');

            Route::get('myproducts', 'ProductController@myproducts');
            Route::get('cartproducts/create/catalog', 'ProductController@createcatalog');
            Route::put('cartproducts/store/catalog', 'ProductController@storecatalog');
            Route::delete('delgal/{id}', 'ProductController@delgal');
            Route::delete('delsize/{id}', 'ProductController@delsize');
            Route::delete('delspec/{id}', 'ProductController@delspec');
            Route::delete('delcolor/{id}', 'ProductController@delcolor');

            Route::put('updatespec/{id}', 'DetailsController@update');
            Route::post('updateSIZE/{id}', 'DetailsController@edit');
            Route::patch('updatephoto/{id}', 'DetailsController@show');
            Route::resource('Continents', 'ContinentController');
            Route::resource('countries', 'CountryController');
            Route::resource('zones', 'ZoneController');
            Route::delete('delcont/{id}', 'ZoneController@delcont');
            Route::resource('shipments', 'ShipmentController');
            Route::resource('shipmentprices', 'ShipmentpricesController');
            Route::post('getzones', 'ShipmentpricesController@getzones');
            Route::post('getrelatedproducts', 'ProductController@relateproducts');
            Route::delete('delzone/{id}', 'ShipmentController@delzone');
            Route::delete('delweghit/{id}', 'ShipmentController@delweghit');
            Route::put('updateweight/{id}', 'ShipmentController@updateweight');
            Route::put('price', 'ShipmentController@price');
            Route::delete('destroyShipmentPrice', 'ShipmentController@destroyShipmentPrice');
            Route::resource('orders', 'OrderController');
            Route::get('sendToSeller', 'OrderController@sendToSeller');
            Route::get('settings', 'MainController@index');
            Route::get('about_settings', 'MainController@aboutus');
            Route::get('contact_settings', 'MainController@contactus');
            Route::get('header_settings', 'MainController@header');
            Route::get('footer_settings', 'MainController@footer');
            Route::put('about_settings', 'MainController@update');
            Route::get('seo_settings', 'MainController@seo');
            Route::get('banner_settings', 'MainController@banner');
            Route::put('banner_settings', 'MainController@update');

            Route::put('seo_settings', 'MainController@update');
            Route::get('managerusers', 'UsersController@managers');
            Route::get('sellerusers', 'UsersController@sellers');
            Route::get('clientusers', 'UsersController@clients');
            Route::put('contact_settings', 'MainController@update');
            Route::put('header_settings', 'MainController@update');
            Route::put('footer_settings', 'MainController@update');
            Route::put('about_settings', 'MainController@update');
            Route::get('/', 'OrdersController@orderschart');
            Route::get('searchcategory','CatalogController@search');
            Route::get('sortorders','OrderController@sortorders');
            Route::put('settings', 'MainController@update');
            Route::get('contacts','SiteController@contacts');
            Route::get('subscribers','SiteController@subscribers');
            Route::post('storezones', 'ZoneController@storezones')->name('storezones');
            Route::delete('contacts/{id}', 'SiteController@destroycontacts');
            Route::delete('subscribers/{id}','SiteController@destroysubscribtion');
            Route::resource('blogcat', 'BlogcatController');
            Route::resource('blog', 'BlogController');
            Route::get('gallary', 'MainController@create');
            Route::post('gallary', 'MainController@store');
            Route::delete('del/{id}', 'MainController@destroy');
            Route::get('ar/settings', 'MainController@arindex');
            Route::get('adds', 'AddController@index');
            Route::get('adds/{id}/edit', 'AddController@edit');
            Route::PATCH('adds/{id}', 'AddController@update');
            Route::resource('faqs', 'FaqsController');
            Route::resource('slider', 'SliderController');
            Route::get('exportcatalogs', 'CatalogController@Exportcatalogs');  // Catalogs
            Route::get('importexcel', 'CatalogController@getImportExcel');  // Catalogs
            Route::post('import-from-excel', 'CatalogController@importExcel')->name('importExcel');  // Catalogs
            
            });
  
            Route::get('calc/{id}', function ($id) {
               return App\Shipment::Shipment_price($id);
              });
    
            Route::group(array('middleware' => array('auth', 'productCoordinator'), 'prefix' => 'productCoordinator'), function () {
            Route::get('/', function () {
                 return view('coordinators.productCoordinator.dashboard');
              });
            Route::resource('products-request', 'Coordinators\productCoordinator\CoordinatorController');
            Route::resource('catalogs', 'Coordinators\productCoordinator\CatalogController');  // Catalogs
            Route::get('import-from-excel', 'Coordinators\productCoordinator\CatalogController@getImportExcel');  // Catalogs
            Route::post('import-from-excel', 'Coordinators\productCoordinator\CatalogController@importExcel')->name('importExcel');  // Catalogs
            Route::post('approveProduct/{productId}', 'Coordinators\productCoordinator\CoordinatorController@approveProduct')->name('approveProduct');
            Route::post('toggleCanceled/{productId}', 'Coordinators\productCoordinator\CoordinatorController@toggleCanceled')->name('toggleCanceled');
                 });
            Route::group(array('middleware' => array('auth', 'shipmentCoordinator'), 'prefix' => 'shipmentCoordinator', 'namespace'=>'Coordinators\shipmentCoordinator'), function () {
            Route::get('/', function () {
                   return view('coordinators.shipmentCoordinator.dashboard');
                });
    
             Route::resource('continents', 'ContinentController');
             Route::resource('country', 'CountryController');
             Route::resource('zones', 'ZoneController');
             Route::delete('delcont/{id}', 'ZoneController@delcont');
             Route::resource('shipment', 'ShipmentController');
             Route::delete('delzone/{id}', 'ShipmentController@delzone');
             Route::delete('delweghit/{id}', 'ShipmentController@delweghit');
             Route::put('updateweight/{id}', 'ShipmentController@updateweight');
             Route::resource('orders', 'OrderController');
              });
    
            Route::group(array('middleware' => array('auth', 'seller'), 'prefix' => 'seller'), function () {
            Route::get('/', function () {
               return view('seller.dashboard');
               })->name('sellerProfile');
            
            Route::resource('ourproducts', 'Seller\ProductController');
            Route::resource('catalog', 'Seller\CatalogController');//Show All, Show Details
            Route::get('catalog/create/{id}', 'Seller\CatalogController@create');//Add Product To Catalog Has Id
    
            Route::delete('delgal/{id}', 'Seller\ProductController@delgal');
            Route::delete('delsize/{id}', 'Seller\ProductController@delsize');
            Route::delete('delspec/{id}', 'Seller\ProductController@delspec');
            Route::put('updatespec/{id}', 'Seller\DetailsController@update');
            Route::post('updateSIZE/{id}', 'Seller\DetailsController@edit');
            Route::patch('updatephoto/{id}', 'Seller\DetailsController@show');
            Route::get('orders', 'Seller\OrderController@index');
            Route::put('confirm/{id}', 'Seller\OrderController@update');
            Route::get('pending', 'Seller\OrderController@pending');
            });
            Route::group(array('middleware' => array('auth', 'support'), 'prefix' => 'support'), function(){
            Route::get('/', function () {
              return  view('support.dashboard');
              });
            Route::resource('orders', 'Support\OrderController');
               });
            Route::group(array('middleware' => array('auth')), function() {
            Route::get('profile', 'SiteController@profile');
            Route::get('myorders', 'SiteController@myorder');
            Route::get('mywishlist', 'SiteController@mywishlist');
            Route::put('editprofile/{id}', 'SiteController@editprofile');
            Route::get('checkout', 'SiteController@checkoutshipment');
            Route::post('/submit', 'OrdersController@CheckOut')->name('submitForm');
            Route::post('submitaddress', 'SiteController@submitaddress')->name('submitaddress');
            Route::post('submitshipment', 'SiteController@submitshipment')->name('submitshipment');
            Route::get('checkoutorder', 'SiteController@checkoutourorders');
            Route::put('editaddress/{id}', 'SiteController@editaddress');
            Route::get('addressbook', 'SiteController@myaddresses');
            Route::get('editaddress/{id}', 'SiteController@editmyaddress');
            Route::put('editorders/{id}', 'SiteController@edit');
            Route::get('returnorder/{id}', 'OrdersController@returnorder');
            Route::get('editorder/{id}', 'SiteController@editfinalorder')->name('editorder');
            Route::post('/bankmasrcheckout', 'OrdersController@paymentcheckout')->name('checkoutpayment');
            Route::get('cancelpayment', 'SiteController@cancelpayment');
            Route::get('bankmasrpage/{id}','SiteController@showbankmasrpage');
              
            Route::get('errorepayment', 'SiteController@errorpayment');
            Route::get('timeoutpayment', 'SiteController@timeoutpayment');
            Route::get('order/{id}', 'SiteController@order');
            Route::post('checkout', 'AjaxController@postcheckout');
            Route::post('addreview', 'AjaxController@addreview');
            Route::get('addtowishlist/{id}', 'AjaxController@addtowishlist'); 
            Route::get('removefromwlist/{id}', 'AjaxController@removefromwlist');
              });
            Route::group(array('middleware' => array('guest')), function () {
            Route::get('user/login', 'SiteController@getlogin');
            Route::post('user/login', 'AjaxController@login'); //ajax
            Route::get('user/register', 'SiteController@getregister');
            Route::post('user/register', 'AjaxController@register'); //ajax
            Route::get('seller/register', 'SiteController@getsellerrequesr');
            Route::patch('seller/register', 'AjaxController@sellerrequest');    
             });
            Route::get('/', 'SiteController@index');
            Route::get('aboutus', 'SiteController@AboutUs');
            Route::get('contactus', 'SiteController@contactus');
            Route::post('contactus', 'SiteController@submitcontactus');
            Route::get('product/{id}', 'SiteController@Product');
            Route::get('category/{id}', 'SiteController@Category');
            Route::get('categorylist/{id}', 'SiteController@Categorylist');
            Route::get('categories/{id}', 'SiteController@categories');
            Route::get('section/{id}', 'SiteController@section');
            Route::get('brand/{id}', 'SiteController@brand');
            Route::get('brandlist/{id}', 'SiteController@brandlist');
            Route::get('brands', 'SiteController@brands');
            Route::get('clients', 'SiteController@clients');
            Route::get('blogs', 'SiteController@blogs');
            Route::get('blog/{id}', 'SiteController@blog');
            Route::get('blogcat/{id}', 'SiteController@blogcat');
            Route::get('clients', 'SiteController@clients');
            Route::get('search', 'SiteController@search');
            Route::get('sort', 'SiteController@sort');
            Route::get('sortlist', 'SiteController@sortlist');
            Route::get('offers', 'SiteController@offers');
            Route::get('addtocart/{id}', 'AjaxController@addtocart');
            Route::get('addtocartmore/{id}', 'AjaxController@addtocartmore');
            Route::get('smallcartcontent', 'AjaxController@smallcartcontent'); 
            Route::get('Cart', 'SiteController@getcart'); 
            Route::get('cartcontent', 'AjaxController@getcartcontent'); 
            Route::get('removfromcart/{id}', 'AjaxController@removfromcart');
            Route::get('removeall', 'AjaxController@removeall');
            Route::get('auth/facebook', 'Auth\RegisterController@redirectToProvider');
            Route::get('auth/facebook/callback', 'Auth\RegisterController@handleProviderCallback');
            Route::get('auth/google', 'google@redirectToProvider');
            Route::get('auth/google/callback', 'google@handleProviderCallback');
            Route::get('updatecart/{id}/{newq}', 'AjaxController@UpdateCart');
            Route::get('total', 'AjaxController@total'); 
            Route::get('quantity', 'AjaxController@quantity'); 
            Route::get('shipments', 'AjaxController@shipments'); 
            Route::post('subscribe', 'SiteController@subscribe')->name('subscribe');
            Route::get('searchblogs','SiteController@searchblog');
            Route::get('sortprice','SiteController@sortprice');
            Route::get('sortpricelist','SiteController@sortpricelist');
            Route::get('searchajax',array('as'=>'searchajax','uses'=>'SiteController@autoComplete'));
            Route::get('getapi','Api\UsersController@getbankmasrapi');
