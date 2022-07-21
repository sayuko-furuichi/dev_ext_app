<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Schema;
use Illuminate\Routing\UrlGenerator;

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

    /*
       public function boot()
      {
          Schema::defaultStringLength(191);

          if (\App::environment('production')) {
              \URL::forceScheme('https');
          }


      }


      //httpsでの通信を強制
        public function boot(UrlGenerator $url)
 {
          $url->forceScheme('https');
      }
      */

    public function boot()
    {
        /* if (env('FORCE_HTTPS', false)) {
            URL::forceScheme('https');
        
       }   

        */
  
    if (\App::environment(['production'])) {
        \URL::forceScheme('https');
    }
    }
}
