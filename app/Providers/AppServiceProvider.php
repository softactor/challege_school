<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\Validator;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Schema::defaultStringLength(255);
		
		//Add this custom validation rule.
		Validator::extend('alpha_space', function ($attribute, $value, $parameters, $validator) {
            //alphabets with _ ,`.'^- & space
			return preg_match('/^([^\x00-\x80]|[a-zA-Z\\\ \\\_\\\,\\\`\\\.\\\'\\\^\-])+$/', $value); 
			
		});
		
		Validator::extend('phone_number', function ($attribute, $value, $parameters, $validator) {

			// This will only accept numbers with - and +.
			return preg_match('/^([\+][0-9]{1,3}([ \.\-])?)?([\(][0-9]{1,6}[\)])?([0-9 \.\-]{1,32})(([A-Za-z \:]{1,11})?[0-9]{1,4}?)$/', $value); 		
		});
		
		Validator::extend('alpha_num_spl', function ($attribute, $value, $parameters, $validator) {
			
			//alphabets,numbers with _ ,`.'^- & space
			return preg_match('/^[0-9a-zA-Z\ \_\,\`\.\'\^\-\&]+$/', $value); 		
		});
		
		Validator::extend('alpha_spl_without_end', function ($attribute, $value, $parameters, $validator) {
			
			//alphabets,numbers with _ ,`.'^- & space
			return preg_match('/^[0-9a-zA-Z\ \_\,\`\.\'\^\-]+$/', $value); 	
		});
		
		Validator::extend('alpha_spl', function ($attribute, $value, $parameters, $validator) {
			
			//alphabets,numbers with _ ,`.'^- & space
			return preg_match('/^[a-zA-Z\ \_\,\`\.\'\^\-\&]+$/', $value); 		
		});
    }
}
