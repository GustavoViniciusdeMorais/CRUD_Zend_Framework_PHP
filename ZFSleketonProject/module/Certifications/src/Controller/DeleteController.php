<?php
/**
 * Created by PhpStorm.
 * User: Cliente
 * Date: 25/08/2018
 * Time: 13:51
 */

namespace Certifications\Controller;

use Certifications\Model\Certification;
use Certifications\Model\CertificationsCommandInterface;
use Certifications\Model\CertificationsRepositoryInterface;
use InvalidArgumentException;
use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;

class DeleteController extends AbstractActionController
{

    private $command;
    private $repository;

    public function __construct(
        CertificationsCommandInterface $comand,
        CertificationsRepositoryInterface $repository
    )
    {
        $this->command = $comand;
        $this->repository = $repository;
    }

    public function deleteAction(){
        $id = $this->params()->fromRoute('id');
        if (! $id) {
            return $this->redirect()->toRoute('certifications');
        }

        try{
            $certification = $this->repository->findCertification($id);
        } catch (InvalidArgumentException $ex) {
            return $this->redirect()->toRoute('certifications');
        }

        $request = $this->getRequest();
        if (! $request->isPost()) {
            return new ViewModel(['certification' => $certification]);
        }

        if ($id != $request->getPost('id')
            || 'Delete' !== $request->getPost('confirm', 'no')
        ) {
            return $this->redirect()->toRoute('certifications');
        }

        $certification = $this->command->deleteCertification($certification);
        return $this->redirect()->toRoute('certifications');

    }

}