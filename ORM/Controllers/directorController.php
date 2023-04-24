<?php

namespace ORM\Controllers;
use ORM\Objects\director;
use ORM\Objects\model;

require_once 'ORM/Controllers/controller.php';
require_once 'ORM/Objects/director.php';
class directorController extends controller
{

    public function add(model $item): void
    {
        if(!($item instanceof director))
            throw new \InvalidArgumentException("Wrong type!");

        $conn = $this->connection->connect();

        try {

            $filmId = $item->getFilmId();
            $name = $item->getName();
            $lastName = $item->getLastName();

            $sql_ins = "INSERT INTO directors (filmId, name, lastName) VALUES ('$filmId', '$name', '$lastName')";

            if($conn->query($sql_ins)){
                echo '<p>added!</p>';
            }
            else{
                throw new \mysqli_sql_exception("Database error");
            }
        } finally {
            $conn?->close();
        }
    }

    public function remove(int $id): void
    {
        $conn = $this->connection->connect();

        try {
            $del = "DELETE FROM directors WHERE Id='$id';";

            if($conn->query($del)){
                echo '<p>deleted!</p>';
            }
            else{
                throw new \mysqli_sql_exception("Database error");
            }
        } finally {
            $conn->close();
        }
    }

    public function update(int $id, $newItem): void
    {
        if(!($newItem instanceof director))
            throw new \InvalidArgumentException("Wrong type!");

        $conn = $this->connection->connect();

        try {
            $filmId = $newItem->getFilmId();
            $name = $newItem->getName();
            $lastName = $newItem->getLastName();

            $upd = "UPDATE directors SET filmId='$filmId',name='$name', lastName='$lastName' WHERE Id='$id'";

            if($conn->query($upd)){
                echo '<p>updated!</p>';
            }
            else{
                throw new \mysqli_sql_exception("Database error");
            }
        }
        finally {
            $conn->close();
        }
    }


    public function removeByModel(model $model): void
    {
        if(!($model instanceof director))
            throw new \InvalidArgumentException("Wrong type!");

        $id = $model->getId();
        $this->remove($id);
    }

    public function updateByModel(model $oldItem, model $newItem): void
    {
        if(!($oldItem instanceof director))
            throw new \InvalidArgumentException("Wrong type!");

        $id = $oldItem->getId();
        $this->update($id, $newItem);
    }

    public function select(string $text): array
    {
        $conn = $this->connection->connect();

        try {
            $select = "SELECT * FROM directors WHERE $text";
            $res = $conn->query($select);
            $result = array();
            foreach ($res as $iter){
                array_push($result, new director($iter['Id'], $iter['FilmId'], $iter['Name'], $iter['LastName']));
            }
            $res->free();
            return $result;

        } finally {
            $conn->close();
        }
    }

    public function getById(int $id): model
    {
        $conn = $this->connection->connect();

        try {
            $select = "SELECT * FROM directors WHERE id='$id'";
            $res = $conn->query($select);
            $result = null;
            foreach ($res as $iter){
                $result = new director($iter['Id'], $iter['FilmId'], $iter['Name'], $iter['LastName']);
            }
            $res->free();
            return $result;

        } finally {
            $conn->close();
        }
    }
}