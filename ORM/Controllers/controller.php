<?php

namespace ORM\Controllers;

use mysqli;
use ORM\Objects\model;
require_once 'ORM/Objects/model.php';

abstract class controller
{
    protected $connection;
    protected array $collection;

    public function __construct($connection)
    {
        $this->collection = array();
        $this->connection = $connection;
    }

    public abstract function add(model $item): void;


    public abstract function remove(int $id) : void;
    public abstract function removeByModel(model $model) : void;


    public abstract function update(int $id, model $newItem) : void;
    public abstract function updateByModel(model $oldItem, model $newItem) : void;

    public abstract function getById(int $id) : model;

    public abstract function select(string $text): array;

    public function getCollection(): array
    {
        return $this->collection;
    }
}