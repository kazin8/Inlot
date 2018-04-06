<?php
/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| This route group applies the "web" middleware group to every route
| it contains. The "web" middleware group is defined in your HTTP
| kernel and includes session state, CSRF protection, and more.
|
*/

Route::group(['middleware' => 'web'], function () {
    Route::auth();

    Route::post('/checkLogin', ['as' => 'auth.checkLogin', 'uses' => 'Auth\AuthController@checkLogin']);
    Route::post('/checkEmailIsUnique', ['as' => 'auth.checkEmailIsUnique', 'uses' => 'Auth\AuthController@checkEmail']);
    Route::post('/checkCompany', ['as' => 'auth.checkCompany', 'uses' => 'Auth\AuthController@checkCompany']);
    Route::post(
        '/checkEmailIsSet',
        ['as' => 'auth.checkEmailIsSet', 'uses' => 'Auth\PasswordController@checkEmail']
    );
    Route::post('/choose-region', ['uses' => 'Common\ListController@getCitiesByRegionId'])->name('choose-region');
    Route::post('/choose-mark', ['uses' => 'Common\ListController@getModelsByMarkId'])->name('choose-mark');

    Route::get('/goods-gallery/{goods}', ['uses' => 'Cabinet\Goods\GoodsController@getGoodsGallery'])->name('goodsGallery');
    Route::post('/goods-gallery/delete/{goods}', ['uses' => 'Cabinet\Goods\GoodsController@deleteGallery'])->name('goodsGallery.delete');
    Route::get('/goods-image/{goods}', ['uses' => 'Cabinet\Goods\GoodsController@getGoodsImage'])->name('goodsImage');
    Route::post('/goods-image/delete/{goods}', ['uses' => 'Cabinet\Goods\GoodsController@deleteImage'])->name('goodsImage.delete');
    Route::get('/car/image/fl/{car}', ['uses' => 'Cabinet\Goods\Categories\Cars\CarController@getFlImage'])->name('carFlImage');
    Route::post('/car/image/fl/delete/{car}', ['uses' => 'Cabinet\Goods\Categories\Cars\CarController@deleteFlImage'])->name('carFlImage.delete');
    Route::get('/car/image/fr/{car}', ['uses' => 'Cabinet\Goods\Categories\Cars\CarController@getFrImage'])->name('carFrImage');
    Route::post('/car/image/fr/delete/{car}', ['uses' => 'Cabinet\Goods\Categories\Cars\CarController@deleteFrImage'])->name('carFrImage.delete');
    Route::get('/car/image/bl/{car}', ['uses' => 'Cabinet\Goods\Categories\Cars\CarController@getBlImage'])->name('carBlImage');
    Route::post('/car/image/bl/delete/{car}', ['uses' => 'Cabinet\Goods\Categories\Cars\CarController@deleteBlImage'])->name('carBlImage.delete');
    Route::get('/car/image/br/{car}', ['uses' => 'Cabinet\Goods\Categories\Cars\CarController@getBrImage'])->name('carBrImage');
    Route::post('/car/image/br/delete/{car}', ['uses' => 'Cabinet\Goods\Categories\Cars\CarController@deleteBrImage'])->name('carBrImage.delete');

    Route::get('/', 'HomeController@index')->name('main');
    Route::post('/', 'Goods\SearchController@search')->name('search');
    Route::get('/help/{category?}/{slug?}', 'HelpController@index')->name('help');

    Route::get('/pages/{slug}', 'HomeController@page')->name('text-page');
});

Route::group(['middleware' => ['web', 'auth'], 'namespace' => 'Routes'], function() {
    Route::group(['middleware' => 'notAdmin' ,'namespace' => 'Cabinet', 'prefix' => 'cabinet'], function() {

        Route::get('/', ['uses' => 'ProfileRouteController@index'])->name('cabinet');
        Route::get('/profile', ['uses' => 'ProfileRouteController@profile'])->name('cabinet.profile');
        Route::patch('/profile', ['uses' => 'ProfileRouteController@update'])->name('cabinet.profile.update');

        Route::group(['middleware' => ['entity'], 'prefix' => 'goods'], function() {
            Route::get('/add', ['uses' => 'GoodsRouteController@create'])->name('cabinet.goods.add');
            Route::post('/add', ['uses' => 'GoodsRouteController@store'])->name('cabinet.goods.store');
            Route::get('/edit/{step}/{goods}', ['uses' => 'GoodsRouteController@edit'])->name('cabinet.goods.edit');
            Route::patch('/edit/{step}/{goods}', ['uses' => 'GoodsRouteController@update'])->name('cabinet.goods.update');
        });
    });
});

Route::group(['middleware' => ['web', 'auth', 'entity']], function() {
    Route::post('/cabinet/profile', ['uses' => 'Cabinet\Entity\ProfileController@becomeDealer'])->name('cabinet.profile.becomeDealer');
});

Route::group(['middleware' => ['web'], 'namespace' => 'Routes'], function() {
    Route::group(['namespace' => 'Goods', 'prefix' => 'goods'], function() {
        Route::get('/{goods}', ['uses' => 'GoodsRouteController@view'])->name('goods.item');
        Route::get('/{slug}', ['uses' => 'CategoryRouteController@goodsList'])->name('goods.list');
        Route::post('/{slug}', ['uses' => 'CategoryRouteController@filterAndViewPartial'])->name('goods.list.filterAndViewPartial');
        Route::post('/{slug}/pagination', ['uses' => 'CategoryRouteController@pagination'])->name('goods.list.pagination');
    });
});

Route::group(['namespace' => 'Goods'], function() {
    Route::post('/search', ['uses' => 'SearchController@filterAndViewPartial'])->name('goods.searchList.filter');
    Route::post('/search/pagination', ['uses' => 'SearchController@pagination'])->name('goods.searchList.pagination');
});

Route::group(['middleware' => ['web', 'notAdmin'], 'namespace' => 'Goods', 'prefix' => 'goods'], function() {
    Route::get('/order/{goods}', ['uses' => 'OrderController@view'])->name('goods.viewOrder');
    Route::post('/order/{goods}', ['uses' => 'OrderController@order'])->name('goods.order');
});

Route::group(['middleware' => ['web', 'notAdmin'], 'prefix' => 'orders'], function() {
    Route::get('/{order}', ['uses' => 'OrderController@view'])->name('orders.item');
});

Route::group(['middleware' => ['web', 'auth', 'notAdmin'], 'namespace' => 'Cabinet', 'prefix' => 'cabinet'], function() {
    Route::group(['namespace' => 'Goods'], function() {
        Route::group(['middleware' => 'entity'], function() {
            Route::group(['prefix' => 'goods'], function() {
                Route::get('/', ['uses' => 'GoodsController@fullList'])->name('cabinet.goods.fullList');
                Route::get('/on-sale', ['uses' => 'GoodsController@onSaleList'])->name('cabinet.goods.onSaleList');
                Route::get('/drafts', ['uses' => 'GoodsController@draftList'])->name('cabinet.goods.draftList');
                Route::get('/deleted', ['uses' => 'GoodsController@deletedList'])->name('cabinet.goods.deletedList');
                Route::post('/pagination', ['uses' => 'GoodsController@pagination'])->name('cabinet.goods.pagination');
                Route::patch('/disactivate/{goods}', ['uses' => 'GoodsController@disactivateAndViewPartials'])->name('cabinet.goods.disactivate');
                Route::patch('/activate/{goods}', ['uses' => 'GoodsController@activateAndViewPartials'])->name('cabinet.goods.activate');
                Route::delete('/destroy/{goods}', ['uses' => 'GoodsController@destroyAndViewPartials'])->name('cabinet.goods.destroy');
                Route::patch('/restore/{id}', ['uses' => 'GoodsController@restoreAndViewPartials'])->name('cabinet.goods.restore');
            });
            Route::get('/sales', ['uses' => 'OrderController@sales'])->name('cabinet.sales');
        });
        Route::get('/orders', ['uses' => 'OrderController@orders'])->name('cabinet.orders');
        Route::patch('/orders/change-status', ['uses' => 'OrderController@changeStatus'])->name('cabinet.orders.changeStatus');
        Route::post('/orders/pagination', ['uses' => 'OrderController@pagination'])->name('cabinet.orders.pagination');
    });
    Route::group(['prefix' => 'settings'], function() {
        Route::get('/', ['uses' => 'SettingsController@index'])->name('cabinet.settings.index');
        Route::patch('/change-password', ['uses' => 'SettingsController@changePassword'])
            ->name('cabinet.settings.password.change');
        Route::patch('/change-email', ['uses' => 'SettingsController@changeEmail'])
            ->name('cabinet.settings.email.change');
        Route::patch('/change-login', ['uses' => 'SettingsController@changeLogin'])
            ->name('cabinet.settings.login.change');
        Route::delete('/', ['uses' => 'SettingsController@deleteAccount'])
            ->name('cabinet.settings.account.delete');
    });

    Route::group(['prefix' => 'messages'], function() {
        Route::get('/', ['uses' => 'DialogController@index'])->name('cabinet.dialog.index');
        Route::get('/{dialog_id}', ['uses' => 'DialogController@view'])->name('cabinet.dialog.view');
        Route::post('/', ['uses' => 'DialogController@create'])->name('cabinet.dialog.create');
        Route::post('/{dialog_id}', ['uses' => 'DialogController@createMessage'])->name('cabinet.dialog.message.create');
    });
});

Route::group(
    [
        'prefix' => 'admin',
        'namespace' => 'Admin',
        'middleware' => ['web', 'admin']
    ],
    function()
    {
        Route::get('/', ['as' => 'admin', 'uses' => 'IndexController@index']);

        /* Page module routes */
        Route::get('/pages', ['as' => 'pages.index', 'uses' => 'PageController@index']);
        Route::get('/pages/{pages}/edit', ['as' => 'pages.edit', 'uses' => 'PageController@edit']);
        Route::patch('/pages/{pages}', ['as' => 'pages.update', 'uses' => 'PageController@update']);
        Route::get('/pages/create', ['as' => 'pages.add', 'uses' => 'PageController@create']);
        Route::post('/pages', ['as' => 'pages.store', 'uses' => 'PageController@store']);
        Route::delete('/pages/{pages}', ['as' => 'pages.delete', 'uses' => 'PageController@destroy']);
        Route::delete('/pages/delete-many', ['as' => 'pages.deleteMany', 'uses' => 'PageController@destroyMany']);
        /* end page module */

        /* Administrator module routes */
        Route::resource('administrators', 'AdministratorController');
        Route::delete(
            '/administrators/delete-many',
            ['as' => 'admin.administrators.deleteMany', 'uses' => 'AdministratorController@destroyMany']
        );
        /* End administrator module */

        /* User module routes */
        Route::resource('users', 'UserController');
        Route::delete(
            '/users/delete-many',
            ['as' => 'admin.users.deleteMany', 'uses' => 'UserController@destroyMany']
        );
        /* End administrator module */

        /* Handbook module routes */
        Route::resource('handbooks', 'HandbookController');
        Route::delete(
            '/handbooks/delete-many',
            ['as' => 'admin.handbooks.deleteMany', 'uses' => 'HandbookController@destroyMany']
        );
        Route::delete(
            '/handbooks/delete-record/{records}',
            ['as' => 'admin.handbooks.deleteRecord', 'uses' => 'HandbookController@destroyRecord']
        );
        /* End handbook module */

        /* Help module routes */
        Route::get('/help/{category?}', ['as' => 'help.index', 'uses' => 'HelpController@index']);
        Route::get('/help/{category}/edit', ['as' => 'help.edit', 'uses' => 'HelpController@edit']);
        Route::patch('/help/{category}', ['as' => 'help.update', 'uses' => 'HelpController@update']);
        Route::get('/help/create', ['as' => 'help.add', 'uses' => 'HelpController@create']);
        Route::post('/help', ['as' => 'help.store', 'uses' => 'HelpController@store']);
        Route::delete('/help/{category}', ['as' => 'help.delete', 'uses' => 'HelpController@destroy']);
        Route::delete('/help/delete-many', ['as' => 'help.deleteMany', 'uses' => 'HelpController@destroyMany']);

        Route::get('/help/{category}/{page}/edit', ['as' => 'help.page.edit', 'uses' => 'HelpController@editPage']);
        Route::patch('/help/{category}/{page}', ['as' => 'help.page.update', 'uses' => 'HelpController@updatePage']);
        Route::get('/help/{category}/create', ['as' => 'help.page.add', 'uses' => 'HelpController@createPage']);
        Route::post('/help/{category}', ['as' => 'help.page.store', 'uses' => 'HelpController@storePage']);
        Route::delete('/help/{category}/{page}', ['as' => 'help.page.delete', 'uses' => 'HelpController@destroyPage']);
        Route::delete('/help/{category}/delete-many', ['as' => 'help.page.deleteMany', 'uses' => 'HelpController@destroyManyPage']);
        /* End help module */
    }
);
