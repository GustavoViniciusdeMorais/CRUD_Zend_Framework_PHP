<?php
/**
 * Created by PhpStorm.
 * User: Cliente
 * Date: 24/08/2018
 * Time: 10:05
 */

namespace Certifications\Model;


interface CertificationsCommandInterface
{
    public function insertCertification(Certification $certification);
    public function updateCertification(Certification $certification);
    public function deleteCertification(Certification $certification);
}