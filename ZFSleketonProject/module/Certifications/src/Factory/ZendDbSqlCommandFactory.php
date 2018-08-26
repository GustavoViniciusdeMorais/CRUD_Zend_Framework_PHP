<?php
/**
 * Created by PhpStorm.
 * User: Cliente
 * Date: 24/08/2018
 * Time: 15:51
 */

namespace Certifications\Factory;

use Interop\Container\ContainerInterface;
use Certifications\Model\ZendDbSqlCommand;
use Zend\Db\Adapter\AdapterInterface;
use Zend\ServiceManager\Factory\FactoryInterface;

class ZendDbSqlCommandFactory implements FactoryInterface
{
    public function __invoke(ContainerInterface $container, $requestedName, array $options = null)
    {
        // TODO: Implement __invoke() method.
        return new ZendDbSqlCommand($container->get(AdapterInterface::class));
    }
}