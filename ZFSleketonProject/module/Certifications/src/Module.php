<?php
/**
 * Created by PhpStorm.
 * User: Cliente
 * Date: 23/08/2018
 * Time: 14:31
 */

namespace Certifications;


use Zend\ModuleManager\Feature\ConfigProviderInterface;

class Module implements ConfigProviderInterface
{
    public function getConfig()
    {
        // TODO: Implement getConfig() method.
        return include __DIR__ . '/../config/module.config.php';
    }
}