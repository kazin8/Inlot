<?php

namespace App\Plugins;

use Illuminate\Support\Facades\View;

class Breadcrumbs {

    /*
     *  array with breadcrumbs data
     * ['name', 'url']
     */
    protected static $data = [];

    /*
     * Add element to breadcrumbs chain
     * @params array $element [name => 'Home', url => '#']
     */
    public static function add(array $element){
        array_push(self::$data, $element);
    }

    public static function render(){
        View::share('breadcrumbs', self::$data);
    }
}