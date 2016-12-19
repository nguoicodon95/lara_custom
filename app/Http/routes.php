<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It is a breeze. Simply tell Lumen the URIs it should respond to
| and give it the Closure to call when that URI is requested.
|
 */

$router->group(['middleware' => ['web']], function ($router) {
    /*
    |--------------------------------------------------------------------------
    | START Routes for Admin actions
    |--------------------------------------------------------------------------
     */
    $adminCpAccess = \Config::get('app.adminCpAccess');

    $router->group(['namespace' => 'Admin', 'prefix' => $adminCpAccess], function ($router) use ($adminCpAccess) {
        /*Auth*/
        $router->controller('auth', 'AuthController');

        $router->get('/', function () use ($adminCpAccess) {
            return redirect()->to($adminCpAccess . '/dashboard');
        });

        /*Dashboard*/
        $router->controller('dashboard', 'DashboardController');

        /*Users*/
        $router->controller('users', 'UserController');
        $router->controller('admin-users', 'UserAdminController');

        /*Pages*/
        $router->controller('pages', 'PageController');

        /*Posts*/
        $router->controller('posts', 'PostController');

        /*Categories*/
        $router->controller('categories', 'CategoryController');

        /*Products*/
        $router->controller('products', 'ProductController');

        /*Product categories*/
        $router->controller('product-categories', 'ProductCategoryController');

        /*Product attribute sets*/
        $router->controller('product-attribute-sets', 'ProductAttributeSetController');

        /*Coupons*/
        $router->controller('coupons', 'CouponController');

        /*Brands*/
        $router->controller('brands', 'BrandController');

        /*Settings*/
        // $router->controller('settings', 'SettingController');

        /*Menus*/
        $router->controller('menus', 'MenuController');

        /*Files*/
        $router->controller('files', 'FileController');

        /*Custom fields*/
        $router->controller('custom-fields', 'CustomFieldController');

        /*Countries - Cities*/
        $router->controller('countries-cities', 'CountryCityController');

        /*Contacts*/
        $router->controller('contacts', 'ContactController');

        /*Subscribed emails*/
        $router->controller('subscribed-emails', 'SubscribedEmailController');

        /*Comments*/
        $router->controller('comments', 'CommentController');

        /*Setting gernerate*/
		Route::get('settings', 'SettingController@index')->name('web.settings');
		Route::post('settings', 'SettingController@save');
		Route::post('settings/create', 'SettingController@create')->name('web.settings.create');
		Route::delete('settings/{id?}', 'SettingController@delete')->name('web.settings.delete');
		Route::get('settings/delete_value/{id}', 'SettingController@delete_value')->name('web.settings.delete_value');


        /*Developer*/
        Route::group(['namespace' => 'Dev', 'prefix' => Config::get('laraedit.uri')], function()
        {
            Route::get('/', array(
                'as' => 'laraedit_home',
                'uses' => 'SourceController@getIndex'
            ));

            Route::post('/save', array(
                'as' => 'laraedit_save',
                'uses' => 'SourceController@postSave'
            ));

            Route::post('/terminal', array(
                'as' => 'laraedit_terminal',
                'uses' => 'SourceController@postTerminal'
            ));

            Route::get('config-clear', 'DevConfigController@clearConfig')->name('config_clear');
            Route::get('config-cache', 'DevConfigController@cacheConfig')->name('config_cache');
        });
    });
    /*
    |--------------------------------------------------------------------------
    | END Routes for Admin actions
    |--------------------------------------------------------------------------
     */

    /*
    |--------------------------------------------------------------------------
    | START Routes for Front actions
    |--------------------------------------------------------------------------
     */

    $router->group(['namespace' => 'Front'], function ($router) {
        /* Authenticate disable default */
        /*$router->controller('auth', 'AuthController');
        $router->controller('password', 'PasswordController');*/

        //To use cart functions, uncomment this line
        //$router->controller('cart', 'CartController');

        $router->controller('global-actions', 'GlobalActionsController');

        $router->get('/', 'PageController@index');
        $router->get('/{slug_1}', 'PageController@_handle');

        $router->get('/bai-viet/{slug_1}', 'PostController@_handle');

        $router->get('/danh-muc/{slug_1}', 'CategoryController@_handle')->name('category.link');
        $router->get('/danh-muc/{slug_1}/{slug_2}', 'CategoryController@_handle');
        $router->get('/danh-muc/{slug_1}/{slug_2}/{slug_3}', 'CategoryController@_handle');

        $router->get('/san-pham/{slug_1}', 'ProductController@_handle')->name('product.link');

        $router->get('/danh-muc-san-pham/{slug_1}', 'ProductCategoryController@_handle');
        $router->get('/danh-muc-san-pham/{slug_1}/{slug_2}', 'ProductCategoryController@_handle');
        $router->get('/danh-muc-san-pham/{slug_1}/{slug_2}/{slug_3}', 'ProductCategoryController@_handle');
    });
    /*
|--------------------------------------------------------------------------
| END Routes for Front actions
|--------------------------------------------------------------------------
 */
});
