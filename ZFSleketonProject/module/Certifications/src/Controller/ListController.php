<?php
/**
 * Created by PhpStorm.
 * User: Cliente
 * Date: 23/08/2018
 * Time: 14:53
 */

namespace Certifications\Controller;

use Certifications\Model\CertificationsRepositoryInterface;
use Zend\Mvc\Controller\AbstractActionController;
use Certifications\Model\CertificationsRepository;
use Zend\View\Model\ViewModel;
use InvalidArgumentException;

class ListController extends AbstractActionController
{
    private $certificationsRepository;

    public function __construct(CertificationsRepositoryInterface $certificationsRepository)
    {
        $this->certificationsRepository = $certificationsRepository;
    }

    // Add the following method:
    public function indexAction()
    {
        return new ViewModel([
            'certifications' => $this->certificationsRepository->findAllCertifications(),
        ]);
    }

    public function detailAction()
    {
        $id = $this->params()->fromRoute('id');
        try {
            $certification = $this->certificationsRepository->findCertification($id);
        }catch (\InvalidArgumentException $ex) {
            return $this->redirect()->toRoute('certifications');
        }

        return new ViewModel([
            'certification' => $certification,
        ]);
    }
}