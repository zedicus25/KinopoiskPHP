<?php

namespace Database\Controllers;
use Database\Models\actor;
use Database\Models\model;


require_once 'db/Controllers/controller.php';
require_once "db/Models/actor.php";
class actorsController extends controller
{
    public function remove(int $id): void
    {
        $conn = $this->connection->connect();

        try {
            $del = "DELETE FROM actors WHERE Id='$id';";

            if($conn->query($del)){
                echo '<p>deleted!</p>';
            }
            else{
                throw new \mysqli_sql_exception("db error");
            }
        } finally {
            $conn->close();
        }
    }

    public function update(int $id, model $newItem): void
    {
        if(!($newItem instanceof actor))
            throw new \InvalidArgumentException("Wrong type!");

        $conn = $this->connection->connect();

        try {
            $filmId = $newItem->getFilmId();
            $name = $newItem->getName();
            $lastName = $newItem->getLastName();

            $upd = "UPDATE actors SET filmId='$filmId',name='$name', lastName='$lastName' WHERE Id='$id'";

            if($conn->query($upd)){
                echo '<p>updated!</p>';
            }
            else{
                throw new \mysqli_sql_exception("db error");
            }
        }
        finally {
            $conn->close();
        }

    }

    public function add(model $item): void
    {
        if(!($item instanceof actor))
            throw new \InvalidArgumentException("Wrong type!");

        $conn = $this->connection->connect();

        try {

            $filmId = $item->getFilmId();
            $name = $item->getName();
            $lastName = $item->getLastName();

            $sql_ins = "INSERT INTO actors (filmId, name, lastName) VALUES ('$filmId', '$name', '$lastName')";

            if($conn->query($sql_ins)){
                echo '<p>added!</p>';
            }
            else{
                throw new \mysqli_sql_exception("db error");
            }
        } finally {
            $conn?->close();
        }
    }

    public function removeByModel(model $model): void
    {
        if(!($model instanceof actor))
            throw new \InvalidArgumentException("Wrong type!");

        $id = $model->getId();
        $this->remove($id);
    }

    public function updateByModel(model $oldItem, model $newItem): void
    {
        if(!($oldItem instanceof actor))
            throw new \InvalidArgumentException("Wrong type!");

        $id = $oldItem->getId();
        $this->update($id, $newItem);
    }

    public function select(string $text): array
    {
        $conn = $this->connection->connect();

        try {
            $select = "SELECT * FROM actors WHERE $text";
            $res = $conn->query($select);
            $result = array();
            foreach ($res as $iter){
                array_push($result, new actor($iter['Id'], $iter['FilmId'], $iter['Name'], $iter['LastName']));
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
            $select = "SELECT * FROM actors WHERE id='$id'";
            $res = $conn->query($select);
            $result = null;
            foreach ($res as $iter){
                $result = new actor($iter['Id'], $iter['FilmId'], $iter['Name'], $iter['LastName']);
            }
            $res->free();
            return $result;

        } finally {
            $conn->close();
        }
    }
}