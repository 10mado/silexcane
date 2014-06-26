<?php
namespace Qumu\Silex\Model;

abstract class MongoCollection
{
    protected $app;
    protected $client;
    protected $db;
    protected $collection;

    protected $cache;

    abstract public function getName();
    abstract public function init();

    public function __construct(Application $app)
    {
        $this->app = $app;
        $this->client = $app['mongodb.client'];
        $this->db = $this->client->selectDB($app['config']['mongodb.db.name']);
        $this->collection = $this->db->selectCollection($this->getName());
        $this->init();
    }

    public function findById($id)
    {
        if (!self::isValidId($id)) {
            return null;
        }
        return $this->collection->findOne(['_id' => $this->toMongoId($id)]);
    }

    public function insert(array $values)
    {
        // コピーオンライトを起こさないようにする
        return $this->collection->insert($values);
    }

    public function save(array $values)
    {
        // コピーオンライトを起こさないようにする
        return $this->collection->save($values);
    }

    public function update(array $criteria, array $newData)
    {
        return $this->collection->update($criteria, $newData);
    }

    public function remove(array $criteria)
    {
        return $this->collection->remove($criteria);
    }

    public function removeById($id)
    {
        if (!self::isValidId($id)) {
            return null;
        }
        if (!($id instanceof \MongoId)) {
            $id = new \MongoId($id);
        }
        return $this->collection->remove(
            ['_id' => $this->toMongoId($id)]);
    }

    public function toMongoId($id)
    {
        if (!($id instanceof \MongoId)) {
            $id = new \MongoId($id);
        }
        return $id;
    }

    public function toStringId($id)
    {
        if ($id instanceof \MongoId) {
            $id = $id . '';
        }
        return $id;
    }

    public function timestamp(array &$values)
    {
        if (!isset($values['created_at'])) {
            $values['created_at'] = new \MongoDate();
        }
        $values['updated_at'] = new \MongoDate();
    }

    public static function getId(array $values)
    {
        if (isset($values['_id']) && $values['_id'] instanceof \MongoId) {
            return $values['_id'] . '';
        }
    }

    public static function isValidId($mongoId)
    {
        return \MongoId::isValid($mongoId);
    }
}
