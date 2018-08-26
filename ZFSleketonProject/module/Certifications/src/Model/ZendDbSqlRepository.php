<?php
/**
 * Created by PhpStorm.
 * User: Cliente
 * Date: 24/08/2018
 * Time: 10:18
 */

namespace Certifications\Model;

use InvalidArgumentException;
use RuntimeException;
use Zend\Hydrator\HydratorInterface;
use Zend\Db\Adapter\AdapterInterface;
use Zend\Db\Adapter\Driver\ResultInterface;
//use Zend\Hydrator\Reflection as ReflectionHydrator;
use Zend\Db\ResultSet\HydratingResultSet;
use Zend\Db\Sql\Sql;

class ZendDbSqlRepository implements CertificationsRepositoryInterface
{

    private $db;
    private $hydrator;
    private $certificationPrototype;

    /*public function __construct(AdapterInterface $db)
    {
        $this->db = $db;
    }*/
    public function __construct(
        AdapterInterface $db,
        HydratorInterface $hydrator,
        Certification $certificationPrototype
    ) {
        $this->db            = $db;
        $this->hydrator      = $hydrator;
        $this->certificationPrototype = $certificationPrototype;
    }

    public function findAllCertifications()
    {
        // TODO: Implement findAllCertifications() method.
        $sql = new Sql($this->db);
        $select = $sql->select('certification');
        $stmt = $sql->prepareStatementForSqlObject($select);
        $result = $stmt->execute();

        if (! $result instanceof ResultInterface || ! $result->isQueryResult()) {
            return [];
        }

        $resultSet = new HydratingResultSet($this->hydrator, $this->certificationPrototype);
        $resultSet->initialize($result);
        return $resultSet;
        /*$resultSet = new HydratingResultSet(
            new ReflectionHydrator(),
            new Certification('', '')
        );
        $resultSet->initialize($result);
        return $resultSet;
        */
        //return $result;
    }

    public function findCertification($id)
    {
        // TODO: Implement findCertification() method.
        $sql = new Sql($this->db);
        $select = $sql->select('certification');
        $select->where(['id = ?' => $id]);
        $stmt = $sql->prepareStatementForSqlObject($select);
        $result    = $stmt->execute();

        if (! $result instanceof ResultInterface || ! $result->isQueryResult()) {
            throw new RuntimeException(sprintf(
                'Failed retrieving Certification with identifier "%s"; unknown database error.',
                $id
            ));
        }

        $resultSet = new HydratingResultSet($this->hydrator, $this->certificationPrototype);
        $resultSet->initialize($result);
        $certification = $resultSet->current();

        if (! $certification){
            throw new InvalidArgumentException(sprintf(
                'Certification with identifier "%s" not found.',
                $id
            ));
        }
        return $certification;
    }

}