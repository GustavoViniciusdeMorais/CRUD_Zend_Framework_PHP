<?php
/**
 * Created by PhpStorm.
 * User: Cliente
 * Date: 25/08/2018
 * Time: 14:05
 */

namespace Certifications\Factory;

use Certifications\Controller\DeleteController;
use Certifications\Model\CertificationsCommandInterface;
use Certifications\Model\CertificationsRepositoryInterface;
use Interop\Container\ContainerInterface;
use Zend\ServiceManager\Factory\FactoryInterface;

class DeleteControllerFactory implements FactoryInterface
{
    public function __invoke(ContainerInterface $container, $requestedName, array $options = null)
    {
        // TODO: Implement __invoke() method.
        return new DeleteController(
          $container->get(CertificationsCommandInterface::class),
          $container->get(CertificationsRepositoryInterface::class)
        );
    }
}