<?php
namespace Silexcane\Silex\Model;

use Doctrine\DBAL\Connection;

abstract class DbTable
{
    protected $now;
    protected $createdAtRowName = 'created_at';
    protected $updatedAtRowName = 'updated_at';
    protected $dateFormat = 'Y-m-d H:i:s';

    abstract public function getTableName();

    /**
     * @var Doctrine\DBAL\Connection
     */
    protected $conn;

    /**
     * @param Doctrine\DBAL\Connection $conn
     */
    public function __construct(Connection $conn)
    {
        $this->conn = $conn;
        $this->now = new \DateTime('now');
    }

    /**
     * Inserts a table row with specified data.
     *
     * @param array $data An associative array containing column-value pairs.
     * @return integer The number of affected rows.
     */
    public function insert(array $data)
    {
        if (!array_key_exists($this->createdAtRowName, $data)) {
            $data[$this->createdAtRowName] = $this->now->format($this->dateFormat);
        }
        if (array_key_exists($this->updatedAtRowName, $data)) {
            unset($data[$this->updatedAtRowName]);
        }
        return $this->conn->insert($this->getTableName(), $data);
    }

    /**
     * Executes an SQL UPDATE statement on a table.
     *
     * @param array $data An associative array containing column-value pairs.
     * @param array $identifier The update criteria. An associative array containing column-value pairs.
     * @return integer The number of affected rows.
     */
    public function update(array $data, array $identifier)
    {
        if (array_key_exists($this->createdAtRowName, $data)) {
            unset($data[$this->createdAtRowName]);
        }
        if (!array_key_exists($this->updatedAtRowName, $data)) {
            $data[$this->updatedAtRowName] = $this->now->format($this->dateFormat);
        }
        return $this->conn->update($this->getTableName(), $data, $identifier);
    }

    /**
     * Executes an SQL DELETE statement on a table.
     *
     * @param array $identifier The deletion criteria. An associative array containing column-value pairs.
     * @return integer The number of affected rows.
     */
    public function delete(array $identifier)
    {
        return $this->conn->delete($this->getTableName(), $identifier);
    }

    /**
     * Returns the ID of the last inserted row, or the last value from a sequence object.
     *
     * @param string $seqName Name of the sequence object from which the ID should be returned.
     * @return string A string representation of the last inserted ID.
     */
    public function lastInsertId($seqName = null)
    {
        return $this->conn->lastInsertId($seqName);
    }

    /**
     * Returns a record by supplied id.
     *
     * @param mixed $id
     * @return array
     */
    public function find($id)
    {
        return $this->conn->fetchAssoc(
            sprintf('select * from %s where id=?', $this->getTableName()),
            [(int) $id]
        );
    }

    /**
     * Returns the escaped string for like-queries.
     *
     * @param string $str
     * @return string
     */
    protected function escapeLikeString($str)
    {
        $str = preg_replace('/\\\\/u', '\\\\', $str);
        $str = preg_replace('/%/u', '\%', $str);
        $str = preg_replace('/_/u', '\\_', $str);
        return $str;
    }
}
