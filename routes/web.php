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

Auth::routes();

## ADMIN
Route::get('/', function () {

    return redirect(route('login'));
});

## ADMIN
Route::group(['prefix' => '/', 'middleware' => ['auth', 'web']], function () {

    ## HOME
    Route::get('home', ['as' => 'home', 'uses' => 'HomeController@index']);

    ## PROMOTERS
    Route::group(['prefix' => 'promoters'], function () {
        Route::get('/', ['as' => 'promoters', 'uses' => 'PromotersController@getIndex']);
        Route::get('add', ['as' => 'promotersAdd', 'uses' => 'PromotersController@getAdd']);
        Route::post('add', ['as' => 'promotersAdd', 'uses' => 'PromotersController@postAdd']);
        Route::get('edit/{promotersId?}', ['as' => 'promotersEdit', 'uses' => 'PromotersController@getEdit']);
        Route::put('edit', ['as' => 'promotersEditPut', 'uses' => 'PromotersController@putEdit']);
        Route::delete('delete', ['as' => 'promotersDelete', 'uses' => 'PromotersController@delete']);
    });

    ## CUSTOMERS
    Route::group(['prefix' => 'customers'], function () {
        Route::get('/', ['as' => 'customers', 'uses' => 'CustomersController@getIndex']);
        Route::get('add', ['as' => 'customersAdd', 'uses' => 'CustomersController@getAdd']);
        Route::post('add', ['as' => 'customersAdd', 'uses' => 'CustomersController@postAdd']);
        Route::get('edit/{customersId?}', ['as' => 'customersEdit', 'uses' => 'CustomersController@getEdit']);
        Route::put('edit', ['as' => 'customersEditPut', 'uses' => 'CustomersController@putEdit']);
        Route::delete('delete', ['as' => 'customersDelete', 'uses' => 'CustomersController@delete']);
    });

    ## TypeCustomers
    Route::group(['prefix' => 'type-customers'], function () {
        Route::get('/', ['as' => 'typeCustomers', 'uses' => 'TypeCustomersController@getIndex']);
        Route::get('add', ['as' => 'typeCustomersAdd', 'uses' => 'TypeCustomersController@getAdd']);
        Route::post('add', ['as' => 'typeCustomersAdd', 'uses' => 'TypeCustomersController@postAdd']);
        Route::get('edit/{typeCustomersId?}', ['as' => 'typeCustomersEdit', 'uses' => 'TypeCustomersController@getEdit']);
        Route::put('edit', ['as' => 'typeCustomersEditPut', 'uses' => 'TypeCustomersController@putEdit']);
        Route::delete('delete', ['as' => 'typeCustomersDelete', 'uses' => 'TypeCustomersController@delete']);
    });

    ## CATEGORIES
    Route::group(['prefix' => 'categories'], function () {
        Route::get('/', ['as' => 'categories', 'uses' => 'CategoriesController@getIndex']);
        Route::get('add', ['as' => 'categoriesAdd', 'uses' => 'CategoriesController@getAdd']);
        Route::post('add', ['as' => 'categoriesAdd', 'uses' => 'CategoriesController@postAdd']);
        Route::get('edit/{categoriesId?}', ['as' => 'categoriesEdit', 'uses' => 'CategoriesController@getEdit']);
        Route::put('edit', ['as' => 'categoriesEditPut', 'uses' => 'CategoriesController@putEdit']);
        Route::delete('delete', ['as' => 'categoriesDelete', 'uses' => 'CategoriesController@delete']);
    });

    ## EMPLOYEES
    Route::group(['prefix' => 'employees'], function () {
        Route::get('/', ['as' => 'employees', 'uses' => 'EmployeesController@getIndex']);
        Route::get('add', ['as' => 'employeesAdd', 'uses' => 'EmployeesController@getAdd']);
        Route::post('add', ['as' => 'employeesAdd', 'uses' => 'EmployeesController@postAdd']);
        Route::get('edit/{employeesId?}', ['as' => 'employeesEdit', 'uses' => 'EmployeesController@getEdit']);
        Route::put('edit', ['as' => 'employeesEditPut', 'uses' => 'EmployeesController@putEdit']);
        Route::delete('delete', ['as' => 'employeesDelete', 'uses' => 'EmployeesController@delete']);
    });

    ## PRODUCTS
    Route::group(['prefix' => 'products'], function () {
        Route::get('/', ['as' => 'products', 'uses' => 'ProductsController@getIndex']);
        Route::post('/', ['as' => 'productsList', 'uses' => 'ProductsController@postIndex']);
        Route::get('add', ['as' => 'productsAdd', 'uses' => 'ProductsController@getAdd']);
        Route::post('add', ['as' => 'productsAdd', 'uses' => 'ProductsController@postAdd']);
        Route::get('edit/{productsId?}', ['as' => 'productsEdit', 'uses' => 'ProductsController@getEdit']);
        Route::put('edit', ['as' => 'productsEditPut', 'uses' => 'ProductsController@putEdit']);
        Route::delete('delete', ['as' => 'productsDelete', 'uses' => 'ProductsController@delete']);
    });

    ## ORDERS
    Route::group(['prefix' => 'orders'], function () {
        Route::get('/', ['as' => 'orders', 'uses' => 'OrdersController@getIndex']);
        Route::get('add', ['as' => 'ordersAdd', 'uses' => 'OrdersController@getAdd']);
        Route::post('add', ['as' => 'ordersAdd', 'uses' => 'OrdersController@postAdd']);
        Route::get('view/{ordersId?}', ['as' => 'ordersView', 'uses' => 'OrdersController@getView']);
    });
    ## INVENTORIES
    Route::group(['prefix' => 'inventories'], function () {
        Route::get('/', ['as' => 'inventories', 'uses' => 'InventoriesController@getIndex']);
        Route::get('add/step-one', ['as' => 'inventoriesAddStepOne', 'uses' => 'InventoriesController@getAddStepOne']);
        Route::post('list/products', ['as' => 'inventoriesListProducts', 'uses' => 'InventoriesController@postListProducts']);
        Route::get('add/step-two/product/id/{productsId?}', ['as' => 'inventoriesAddStepTwo', 'uses' => 'InventoriesController@getAddStepTwo']);
        Route::post('add', ['as' => 'inventoriesAdd', 'uses' => 'InventoriesController@postAdd']);
        Route::get('view/{inventoriesId?}', ['as' => 'inventoriesView', 'uses' => 'InventoriesController@getView']);
    });

    ## LOSSES
    Route::group(['prefix' => 'losses'], function () {
        Route::get('/', ['as' => 'losses', 'uses' => 'LossesController@getIndex']);
        Route::get('add/step-one', ['as' => 'lossesAddStepOne', 'uses' => 'LossesController@getAddStepOne']);
        Route::post('list/products', ['as' => 'lossesListProducts', 'uses' => 'LossesController@postListProducts']);
        Route::get('add/step-two/product/id/{productsId?}', ['as' => 'lossesAddStepTwo', 'uses' => 'LossesController@getAddStepTwo']);
        Route::post('add', ['as' => 'lossesAdd', 'uses' => 'LossesController@postAdd']);
        Route::get('view/{lossesId?}', ['as' => 'lossesView', 'uses' => 'LossesController@getView']);
    });

    ## Drawers
    Route::group(['prefix' => 'drawers'], function () {
        Route::get('/', ['as' => 'drawers', 'uses' => 'DrawersController@getIndex']);
        Route::get('add', ['as' => 'drawersAdd', 'uses' => 'DrawersController@getAdd']);
        Route::post('add', ['as' => 'drawersAdd', 'uses' => 'DrawersController@postAdd']);
        Route::get('edit/{drawersId?}', ['as' => 'drawersEdit', 'uses' => 'DrawersController@getEdit']);
        Route::put('edit', ['as' => 'drawersEditPut', 'uses' => 'DrawersController@putEdit']);
        Route::delete('delete', ['as' => 'drawersDelete', 'uses' => 'DrawersController@delete']);

    });

    ## Cashiers
    Route::group(['prefix' => 'cashiers'], function () {
        Route::get('/', ['as' => 'cashiers', 'uses' =>'CashiersController@getIndex']);
        Route::get('add', ['as' => 'cashiersAdd', 'uses' => 'CashiersController@getAdd']);
        Route::post('add', ['as' => 'cashiersAdd', 'uses' => 'CashiersController@postAdd']);
        Route::get('edit/{cashiersId?}', ['as' => 'cashiersEdit', 'uses' => 'CashiersController@getEdit']);
        Route::put('edit', ['as' => 'cashiersEditPut', 'uses' => 'CashiersController@putEdit']);
        Route::delete('delete', ['as' => 'cashiersDelete', 'uses' => 'CashiersController@delete']);

    });

    ## SETTINGS
    Route::group(['prefix' => 'settings'], function () {
        Route::get('/', ['as' => 'settings', 'uses' => 'SettingsController@getIndex']);
        Route::put('/', ['as' => 'settingsPut', 'uses' => 'SettingsController@putUpdate']);
    });

    ## PROFILE
    Route::group(['prefix' => 'profile'], function () {
        Route::get('/', ['as' => 'profile', 'uses' => 'ProfileController@getIndex']);
        Route::put('edit', ['as' => 'profilePut', 'uses' => 'ProfileController@putUpdate']);
    });

    ## USERS
    Route::group(['prefix' => 'users'], function () {
        Route::get('/', ['as' => 'users', 'uses' => 'UsersController@getIndex']);
        Route::get('add', ['as' => 'usersAdd', 'uses' => 'UsersController@getAdd']);
        Route::post('add', ['as' => 'usersAdd', 'uses' => 'UsersController@postAdd']);
        Route::get('edit/{userId?}', ['as' => 'usersEdit', 'uses' => 'UsersController@getEdit']);
        Route::put('edit', ['as' => 'usersEditPut', 'uses' => 'UsersController@putEdit']);
        Route::get('permissions/{userId?}', ['as' => 'usersPermissions', 'uses' => 'UsersController@getPermissions']);
        Route::post('permissions', ['as' => 'usersPermissionsPost', 'uses' => 'UsersController@postPermissions']);
        Route::delete('delete', ['as' => 'usersDelete', 'uses' => 'UsersController@delete']);
    });

    ## LOGOUT
    Route::get('logout', ['as' => 'logout', 'uses' => 'Auth\LoginController@logout']);

    ##CATEGORY
    Route::group(['prefix' => 'select-category'], function () {
        Route::get('{modalTitle?}/{modalName?}/{modalDatabaseTable?}', ['as' => 'selectCategory', 'uses' => 'CategoryModalController@getIndex']);
        Route::post('add', ['as' => 'selectCategoryAdd', 'uses' => 'CategoryModalController@postAdd']);
        Route::put('edit', ['as' => 'selectCategoryEdit', 'uses' => 'CategoryModalController@putEdit']);
        Route::delete('delete', ['as' => 'selectCategoryDelete', 'uses' => 'CategoryModalController@delete']);
        Route::post('refresh', ['as' => 'selectCategoryRefresh', 'uses' => 'CategoryModalController@postRefresh']);
    });
});