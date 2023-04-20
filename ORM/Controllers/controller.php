<?php

namespace ORM\Controllers;

abstract class controller
{
    private $connection;
    private $collection;

    public function __construct($connection)
    {
        $this->collection = array();
        $this->connection = $connection;
    }

    public function add($item) {
        array_push($this->collection, $item);
    }

    public function remove($id) {
        $this->collection  = array_slice($this->collection, $id,1);
    }

    public function update($id, $newItem){
        $this->collection[$id] = $newItem;
    }

    public function getById($id) {
        return $this->collection[$id];
    }

    /**
     * @return array
     */
    public function getCollection(): array
    {
        return $this->collection;
    }
}