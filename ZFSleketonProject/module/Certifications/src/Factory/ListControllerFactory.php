<?php
/**
 * Created by PhpStorm.
 * User: Cliente
 * Date: 23/08/2018
 * Time: 15:39
 */

namespace Certifications\Factory;

use Certifications\Controller\ListController;
use Certifications\Model\CertificationsRepositoryInterface;
use Interop\Container\ContainerInterface;
use Zend\ServiceManager\Factory\FactoryInterface;

class ListControllerFactory implements FactoryInterface
{
    public function __invoke(ContainerInterface $container, $requestedName, array $options = null)
    {
        // TODO: Implement __invoke() method.
        return new ListController($container->get(CertificationsRepositoryInterface::class));
    }
}