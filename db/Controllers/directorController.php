<?php

namespace Database\Controllers;
use Database\Models\director;
use Database\Models\model;

require_once 'C:\xampp\htdocs\Kinopoisk/db/Controllers/controller.php';
require_once 'C:\xampp\htdocs\Kinopoisk/db/Models/director.php';
class directorController extends controller
{

    public function add(model $item): void
    {
        if(!($item instanceof director))
            throw new \InvalidArgumentException("Wrong type!");

        $conn = $this->connection->connect();

        try {

            $filmId = $item->getFilmId();
            $fioId = $item->getFioId();

            $sql_ins = "INSERT INTO directors (filmId, fioId) VALUES ('$filmId', '$fioId')";

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

    public function remove(int $id): void
    {
        $conn = $this->connection->connect();

        try {
            $del = "DELETE FROM directors WHERE Id='$id';";

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

    public function update(int $id, $newItem): void
    {
        if(!($newItem instanceof director))
            throw new \InvalidArgumentException("Wrong type!");

        $conn = $this->connection->connect();

        try {
            $filmId = $newItem->getFilmId();
            $fioId = $newItem->getFioId();

            $upd = "UPDATE directors SET filmId='$filmId',fioId='$fioId' WHERE Id='$id'";

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
                array_push($result, new director($iter['Id'], $iter['FilmId'], $iter['FioId']));
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
                $result = new director($iter['Id'], $iter['FilmId'], $iter['FioId']);
            }
            $res->free();
            return $result;

        } finally {
            $conn->close();
        }
    }
}