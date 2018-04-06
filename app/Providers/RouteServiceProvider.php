<?php

namespace App\Providers;

use App\Goods;
use Illuminate\Http\Request;
use Illuminate\Routing\Router;
use Illuminate\Foundation\Support\Providers\RouteServiceProvider as ServiceProvider;

class RouteServiceProvider extends ServiceProvider
{
    /**
     * This namespace is applied to the controller routes in your routes file.
     *
     * In addition, it is set as the URL generator's root namespace.
     *
     * @var string
     */
    protected $namespace = 'App\Http\Controllers';

    /**
     * Define your route model bindings, pattern filters, etc.
     *
     * @param  \Illuminate\Routing\Router  $router
     * @return void
     */
    public function boot(Router $router)
    {
        $router->pattern('pages', '[\d]+');
        $router->pattern('administrators', '[\d]+');
        $router->pattern('handbooks', '[\d]+');
        $router->pattern('records', '[\d]+');
        $router->pattern('users', '[\d]+');
        $router->pattern('step', '[2-4]');
        $router->pattern('goods', '[\d]+');
        $router->pattern('cars', '[\d]+');
        $router->pattern('orders', '[\d]+');

        $router->model('administrators', 'App\User');
        $router->model('pages', 'App\Page');
        $router->model('handbooks', 'App\Handbook');
        $router->model('records', 'App\HandbookContent');
        $router->model('users', 'App\User');
        $router->model('goods', 'App\Goods');
        $router->model('cars', 'App\Car');
        $router->model('orders', 'App\Orders');

        parent::boot($router);
    }

    /**
     * Define the routes for the application.
     *
     * @param  \Illuminate\Routing\Router  $router
     * @return void
     */
    public function map(Router $router)
    {
        $router->group(['namespace' => $this->namespace], function ($router) {
            require app_path('Http/routes.php');
        });
    }
}
