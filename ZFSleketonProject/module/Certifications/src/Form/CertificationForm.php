<?php
/**
 * Created by PhpStorm.
 * User: Cliente
 * Date: 24/08/2018
 * Time: 14:54
 */

namespace Certifications\Form;


use Zend\Form\Form;

class CertificationForm extends Form
{
    public function init()
    {
        $this->add([
            'name' => 'certification',
            'type' => CertificationFieldset::class,
            'options' => [
                'use_as_base_fieldset' => true,
            ],
        ]);
        $this->add([
            'type' => 'submit',
            'name' => 'submit',
            'attributes' => [
                'value' => 'Insert new Certification',
            ],
        ]);
    }
}