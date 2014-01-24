<?php namespace PragmaRX\Helpers\Vendor\Laravel;
 
use PragmaRX\Helpers\Helpers;

use PragmaRX\Helpers\Support\Config;

use PragmaRX\Support\ServiceProvider as PragmaRXServiceProvider;

use Illuminate\Foundation\AliasLoader as IlluminateAliasLoader;

class ServiceProvider extends PragmaRXServiceProvider {

    protected $packageVendor = 'pragmarx';
    protected $packageVendorCapitalized = 'PragmaRX';

    protected $packageName = 'helpers';
    protected $packageNameCapitalized = 'Helpers';

    protected $packageNamespace = 'pragmarx/helpers';

    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register()
    {   
        $this->preRegister();

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

}
