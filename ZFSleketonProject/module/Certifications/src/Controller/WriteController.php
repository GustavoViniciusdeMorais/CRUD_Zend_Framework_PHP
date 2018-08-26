<?php
/**
 * Created by PhpStorm.
 * User: Cliente
 * Date: 24/08/2018
 * Time: 14:59
 */

namespace Certifications\Controller;

use Certifications\Form\CertificationForm;
use Certifications\Model\Certification;
use Certifications\Model\CertificationsCommandInterface;
use Certifications\Model\CertificationsRepositoryInterface;
use InvalidArgumentException;
use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;

class WriteController extends AbstractActionController
{
    private $command;
    private $form;
    private $repository;

    /* public function __construct(CertificationsCommandInterface $command, CertificationForm $form)
    {
        $this->command = $command;
        $this->form = $form;
    } */
    public function __construct(
        CertificationsCommandInterface $command,
        CertificationForm $form,
        CertificationsRepositoryInterface $repository
    )
    {
        $this->command = $command;
        $this->form = $form;
        $this->repository = $repository;
    }

    public function addAction()
    {
        $request   = $this->getRequest();
        $viewModel = new ViewModel(['form' => $this->form]);

        if (! $request->isPost()) {
            return $viewModel;
        }

        $this->form->setData($request->getPost());

        if (! $this->form->isValid()) {
            return $viewModel;
        }

        //$data = $this->form->getData()['certification'];
        $certification = $this->form->getData(); /* new Certification($data['title'], $data['text']); */
        try {
            $certification = $this->command->insertCertification($certification);
        } catch (\Exception $ex) {
            // An exception occurred; we may want to log this later and/or
            // report it to the user. For now, we'll just re-throw.
            throw $ex;
        }

        return $this->redirect()->toRoute(
            'certifications/detail',
            ['id' => $certification->getId()]
        );
    }

    public function editAction()
    {
        $id = $this->params()->fromRoute('id');
        if (! $id) {
            return $this->redirect()->toRoute('certifications');
        }

        try{
            $certification = $this->repository->findCertification($id);
        } catch (InvalidArgumentException $ex) {
            return $this->redirect()->toRoute('certifications');
        }

        $this->form->bind($certification);
        $viewModel = new ViewModel(['form' => $this->form]);

        $request = $this->getRequest();
        if (! $request->isPost()) {
            return $viewModel;
        }

        $this->form->setData($request->getPost());

        if (! $this->form->isValid()) {
            return $viewModel;
        }

        $certification = $this->command->updateCertification($certification);
        return $this->redirect()->toRoute(
            'certifications/detail',
            ['id' => $certification->getId()]
        );

    }

}