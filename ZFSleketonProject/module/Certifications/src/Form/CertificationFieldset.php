<?php
/**
 * Created by PhpStorm.
 * User: Cliente
 * Date: 24/08/2018
 * Time: 14:51
 */

namespace Certifications\Form;

use Certifications\Model\Certification;
use Zend\Hydrator\Reflection as ReflectionHydrator;
use Zend\Form\Fieldset;

class CertificationFieldset extends Fieldset
{
    public function init()
    {
        $this->setHydrator(new ReflectionHydrator());
        $this->setObject(new Certification('',''));
        $this->add([
            'type' => 'hidden',
            'name' => 'id',
        ]);

        $this->add([
            'type' => 'text',
            'name' => 'title',
            'options' => [
                'label' => 'Certification Title',
            ],
        ]);

        $this->add([
            'type' => 'textarea',
            'name' => 'text',
            'options' => [
                'label' => 'Certification Text',
            ],
        ]);
    }
}