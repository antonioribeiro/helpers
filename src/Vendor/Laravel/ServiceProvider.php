<?php 
 
/**
 * Part of the Helpers package.
 *
 * NOTICE OF LICENSE
 *
 * Licensed under the 3-clause BSD License.
 *
 * This source file is subject to the 3-clause BSD License that is
 * bundled with this package in the LICENSE file.  It is also available at
 * the following URL: http://www.opensource.org/licenses/BSD-3-Clause
 *
 * @package    Helpers
 * @version    1.0.0
 * @author     Antonio Carlos Ribeiro @ PragmaRX
 * @license    BSD License (3-clause)
 * @copyright  (c) 2013, PragmaRX
 * @link       http://pragmarx.com
 */

namespace PragmaRX\Helpers\Vendor\Laravel;
 
use PragmaRX\Helpers\Helpers;

use PragmaRX\Support\ServiceProvider as PragmaRXServiceProvider;

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

    public function getRootDirectory()
    {
        return __DIR__.'/../..';
    }

}
