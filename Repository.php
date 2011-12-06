<?php

namespace Knp;

use Doctrine\DBAL\Connection;

/**
 * Represents a base Repository.
 * 
 * @abstract
 * @package 
 * @version $id$
 */
abstract class Repository
{
    abstract public function getTableName();

    public $db;

    public function __construct(Connection $db)
    {
        $this->db = $db;
    }

    public function insert(array $data)
    {
        return $this->db->insert($this->getTableName(), $data);
    }

    public function update(array $data, array $identifier)
    {
        return $this->db->update($this->getTableName(), $data, $identifier);
    }

    public function delete(array $identifier)
    {
        return $this->db->delete($this->getTableName(), $identifier);
    }

    /**
     * Returns a record by supplied id.
     * 
     * @param mixed $id 
     * @access public
     * @return array
     */
    public function find($id)
    {
        return $this->db->fetchAssoc(sprintf('SELECT * FROM %s WHERE id = ? LIMIT 1', $this->getTableName()), array((int) $id));
    }

    /**
     * Returns all records from this repository's table. 
     * 
     * @access public
     * @return array
     */
    public function findAll()
    {
        return $this->db->fetchAll(sprintf('SELECT * FROM %s', $this->getTableName()));
    }
}
