<?php namespace Vinicius73\Lavatar;

use Illuminate\Support\ServiceProvider;

class LavatarServiceProvider extends ServiceProvider
{

   /**
    * Indicates if loading of the provider is deferred.
    *
    * @var bool
    */
   protected $defer = false;

   /**
    * Bootstrap the application events.
    *
    * @return void
    */
   public function boot()
   {
      $this->package('vinicius73/lavatar', 'lavatar');
   }

   /**
    * Register the service provider.
    *
    * @return void
    */
   public function register()
   {
      // Bind 'stolz.assets' shared component to the IoC container
      $this->app->singleton(
         'vinicius73.lavatar',
         function ($app) {
            $config = $app->config->get('lavatar::config', array());
            return new Lavatar($config);
         }
      );
   }

   /**
    * Get the services provided by the provider.
    *
    * @return array
    */
   public function provides()
   {
      return array();
   }

}
