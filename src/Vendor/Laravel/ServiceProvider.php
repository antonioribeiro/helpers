<?php namespace PragmaRX\Helpers\Vendor\Laravel;
 
use PragmaRX\Helpers\Helpers;

use PragmaRX\Helpers\Support\Config;

use Illuminate\Support\ServiceProvider as IlluminateServiceProvider;
use Illuminate\Foundation\AliasLoader as IlluminateAliasLoader;

class ServiceProvider extends IlluminateServiceProvider {

    const PACKAGE_NAMESPACE = 'pragmarx/helpers';

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
        $this->package(self::PACKAGE_NAMESPACE, self::PACKAGE_NAMESPACE, __DIR__.'/../..');

        if( $this->app['config']->get(self::PACKAGE_NAMESPACE.'::create_helpers_alias') )
        {
            IlluminateAliasLoader::getInstance()->alias(
                                                            $this->getConfig('helpers_alias'),
                                                            'PragmaRX\Helpers\Vendor\Laravel\Facade'
                                                        );
        }

        $this->wakeUp();
    }

    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register()
    {   
        $this->registerConfig();

        $this->registerHelpers();
    }

    /**
     * Get the services provided by the provider.
     *
     * @return array
     */
    public function provides()
    {
        return array('helpers');
    }

    /**
     * Takes all the components of Helpers and glues them
     * together to create Helpers.
     *
     * @return void
     */
    private function registerHelpers()
    {
        $this->app['helpers'] = $this->app->share(function($app)
        {
            $app['helpers.loaded'] = true;

            return new Helpers($app['helpers.config']);
        });
    }

    public function registerConfig()
    {
        $this->app['helpers.config'] = $this->app->share(function($app)
        {
            return new Config($app['config'], self::PACKAGE_NAMESPACE);
        });
    }

    private function wakeUp()
    {
        $this->app['helpers']->boot();
    }

    private function getConfig($key)
    {
        return $this->app['config']->get(self::PACKAGE_NAMESPACE.'::'.$key);
    }

}
