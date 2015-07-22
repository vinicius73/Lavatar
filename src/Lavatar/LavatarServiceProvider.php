<?php namespace Vinicius73\Lavatar;

use Illuminate\Support\ServiceProvider;
use Vinicius73\Lavatar\Providers\ProvidersInterface;

class LavatarServiceProvider extends ServiceProvider
{

    /**
     * Indicates if loading of the provider is deferred.
     *
     * @var bool
     */
    protected $defer = true;

    /**
     * Bootstrap the application events.
     *
     * @return void
     */
    public function boot()
    {
        $this->publishes([
            __DIR__ . '/../resources/config/lavatar.php' => config_path('lavatar.php')
        ]);
    }

    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register()
    {
        $app = $this->app;

        $app->singleton(
            'lavatar',
            function ($app) {
                $config = $app['config']->get('lavatar::config', array());
                return new Lavatar($config);
            }
        );

        $app->singleton(ProvidersInterface::class, function () use($app) {
            return $app['lavatar']->getProvider();
        });
    }

    /**
     * Get the services provided by the provider.
     *
     * @return array
     */
    public function provides()
    {
        return ['lavatar'];
    }

}
