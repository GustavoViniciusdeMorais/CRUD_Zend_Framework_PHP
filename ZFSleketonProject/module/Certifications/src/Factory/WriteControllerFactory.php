<?php
/**
 * Created by PhpStorm.
 * User: Cliente
 * Date: 24/08/2018
 * Time: 15:04
 */

namespace Certifications\Factory;

use Certifications\Controller\WriteController;
use Certifications\Form\CertificationForm;
use Certifications\Model\CertificationsCommandInterface;
use Certifications\Model\CertificationsRepositoryInterface;
use Interop\Container\ContainerInterface;
use Zend\ServiceManager\Factory\FactoryInterface;

class WriteControllerFactory implements FactoryInterface
{
    public function __invoke(ContainerInterface $container, $requestedName, array $options = null)
    {
        $formManager = $container->get('FormElementManager');
        return new WriteController(
            $container->get(CertificationsCommandInterface::class),
            $formManager->get(CertificationForm::class),
            $container->get(CertificationsRepositoryInterface::class)
            /* $container->get(CertificationsCommandInterface::class),
            $formManager->get(CertificationForm::class) */
        );
    }
}