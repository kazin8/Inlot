<?php

namespace App\Providers;

use Form;
use Collective\Html\HtmlServiceProvider;

class MacroServiceProvider extends HtmlServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        Form::macro('boolean', function($name, $value = false) {
            return Form::hidden($name, 0) . Form::checkbox($name, 1, $value);
        });
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
