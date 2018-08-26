<?php
/**
 * Created by PhpStorm.
 * User: Cliente
 * Date: 23/08/2018
 * Time: 15:09
 */

namespace Certifications\Model;

interface CertificationsRepositoryInterface
{
    public function findAllCertifications();
    public function findCertification($id);
}