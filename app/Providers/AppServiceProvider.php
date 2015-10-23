<?php

namespace AndeCollege\Providers;

use Validator;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
	    Validator::extend('invalid', function ($attribute, $value, $parameters, $validator){
		    $headers = get_headers($value);
		    dd($headers);
		    $code = substr($headers[0], 9, 3);
		    if($code == "404") {
			    return false;
		    }
		    return true;
	    });

    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
