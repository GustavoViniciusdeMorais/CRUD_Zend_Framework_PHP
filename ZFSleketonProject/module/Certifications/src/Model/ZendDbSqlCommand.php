<?php
/**
 * Created by PhpStorm.
 * User: Cliente
 * Date: 24/08/2018
 * Time: 15:43
 */

namespace Certifications\Model;

use RuntimeException;
use Zend\Db\Adapter\AdapterInterface;
use Zend\Db\Adapter\Driver\ResultInterface;
use Zend\Db\Sql\Delete;
use Zend\Db\Sql\Insert;
use Zend\Db\Sql\Sql;
use Zend\Db\Sql\Update;

class ZendDbSqlCommand implements CertificationsCommandInterface
{
    private $db;

    public function __construct(AdapterInterface $db)
    {
        $this->db = $db;
    }

    public function insertCertification(Certification $certification)
    {
        // TODO: Implement insertCertification() method.
        $insert = new Insert('certification');

        $insert->values([
            'title' => $certification->getTitle(),
            'text' => $certification->getText(),
        ]);

        $sql = new Sql($this->db);
        $statement = $sql->prepareStatementForSqlObject($insert);
        $result = $statement->execute();

        if (! $result instanceof ResultInterface) {
            throw new RuntimeException(
                'Database error occurred during certification insert operation'
            );
        }

        $id = $result->getGeneratedValue();

        return new Certification(
            $certification->getTitle(),
            $certification->getText(),
            $result->getGeneratedValue()
        );
    }

    public function updateCertification(Certification $certification)
    {
        // TODO: Implement updateCertification() method.
        if(! $certification->getId()){
            throw new RuntimeException('Cannot update certification; missing identifier');
        }

        $update = new Update('certification');
        $update->set([
            'title' => $certification->getTitle(),
            'text' => $certification->getText(),
        ]);
        $update->where(['id = ?' => $certification->getId()]);

        $sql = new Sql($this->db);
        $statement = $sql->prepareStatementForSqlObject($update);
        $result = $statement->execute();

        if (! $result instanceof ResultInterface) {
            throw new RuntimeException(
                'Database error occurred during certification update operation'
            );
        }

        return $certification;

    }

    public function deleteCertification(Certification $certification)
    {
        // TODO: Implement deleteCertification() method.
        if(! $certification->getId()){
            throw new RuntimeException('Cannot delete certification; missing identifier');
        }

        $delete = new Delete('certification');
        $delete->where(['id = ?' => $certification->getId()]);

        $sql = new Sql($this->db);
        $statement = $sql->prepareStatementForSqlObject($delete);
        $result = $statement->execute();

        if (! $result instanceof ResultInterface) {
            return false;
        }

        return true;

    }
}