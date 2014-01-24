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

namespace PragmaRX\Helpers;

use PragmaRX\Helpers\Support\Config;

use PragmaRX\Helpers\Data\RepositoryManager as RepositoryManager;

class Helpers
{
    private $config;

    private $session;

    public function __construct(
                                    Config $config, 
                                    RepositoryManager $repositoryManager
                                )
    {
        $this->config = $config;

        $this->repositoryManager = $repositoryManager;
    }

    public function boot()
    {
        if ($this->config->get('enabled'))
        {
            /// what to do when booting?
        }
    }

}