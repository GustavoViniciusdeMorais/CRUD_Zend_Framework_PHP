<?php
/**
 * Created by PhpStorm.
 * User: Cliente
 * Date: 23/08/2018
 * Time: 15:13
 */

namespace Certifications\Model;
use DomainException;

class CertificationsRepository implements CertificationsRepositoryInterface
{

    private $data = [
        1 => [
            'id' => 1,
            'title' => 'Zend Certified Engineer',
            'text' => 'Gustavo is an expert in the PHP programming language',
        ],
        2 => [
            'id'    => 2,
            'title' => 'ITIL Foundation',
            'text'  => 'Information Technology Infrastructure Library',
        ],
    ];

    public function findAllCertifications()
    {
        // TODO: Implement findAllCertifications() method.
        return array_map(function ($certification) {
            return new Certification(
                $certification['title'],
                $certification['text'],
                $certification['id']
            );
        }, $this->data);
    }
    public function findCertification($id)
    {
        // TODO: Implement findCertification() method.
        if (! isset($this->data[$id])) {
            throw new DomainException(sprintf('Post by id "%s" not found', $id));
        }

        return new Certification(
            $this->data[$id]['title'],
            $this->data[$id]['text'],
            $this->data[$id]['id']
        );
    }
}