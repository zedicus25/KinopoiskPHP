<?php

namespace Database\Controllers;
use Database\Models\director;
use Database\Models\model;

require_once 'C:\xampp\htdocs\Kinopoisk/db/Controllers/controller.php';
require_once 'C:\xampp\htdocs\Kinopoisk/db/Models/director.php';
class directorController extends controller
{

    public function add(model $item): bool
    {
        if(!($item instanceof director))
            return false;

        $conn = $this->connection->connect();

        try {

            $filmId = $item->getFilmId();
            $fioId = $item->getFioId();

            $sql_ins = "INSERT INTO directors (filmId, fioId) VALUES ('$filmId', '$fioId')";

            if($conn->query($sql_ins)){
                $conn?->close();
                return true;
            }
            else{
                $conn?->close();
                return false;
            }
        } finally {
            $conn?->close();
        }
    }

    public function remove(int $id): bool
    {
        $conn = $this->connection->connect();

        try {
            $del = "DELETE FROM directors WHERE Id='$id';";

            if($conn->query($del)){
                $conn?->close();
                return true;
            }
            else{
                $conn?->close();
                return false;
            }
        } finally {
            $conn->close();
        }
    }

    public function update(int $id, $newItem): bool
    {
        if(!($newItem instanceof director))
            return false;

        $conn = $this->connection->connect();

        try {
            $filmId = $newItem->getFilmId();
            $fioId = $newItem->getFioId();

            $upd = "UPDATE directors SET filmId='$filmId',fioId='$fioId' WHERE Id='$id'";

            if($conn->query($upd)){
                $conn?->close();
                return true;
            }
            else{
                $conn?->close();
                return false;
            }
        }
        finally {
            $conn->close();
        }
    }


    public function removeByModel(model $model): bool
    {
        if(!($model instanceof director))
            return false;

        $id = $model->getId();
        return $this->remove($id);
    }

    public function updateByModel(model $oldItem, model $newItem): bool
    {
        if(!($oldItem instanceof director))
            return false;

        $id = $oldItem->getId();
        return $this->update($id, $newItem);
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