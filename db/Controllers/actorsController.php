<?php

namespace Database\Controllers;
use Database\Models\actor;
use Database\Models\model;


require_once 'C:\xampp\htdocs\Kinopoisk/db/Controllers/controller.php';
require_once 'C:\xampp\htdocs\Kinopoisk/db/Models/actor.php';
class actorsController extends controller
{
    public function remove(int $id): bool
    {
        $conn = $this->connection->connect();

        try {
            $del = "DELETE FROM actors WHERE Id='$id';";

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

    public function update(int $id, model $newItem): bool
    {
        if(!($newItem instanceof actor))
            return false;

        $conn = $this->connection->connect();

        try {
            $filmId = $newItem->getFilmId();
            $fioId = $newItem->getFioId();
            $role = $newItem->getRole();

            $upd = "UPDATE actors SET filmId='$filmId',fioId='$fioId', role='$role' WHERE Id='$id'";

            if($conn->query($upd)){
                $conn->close();
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

    public function add(model $item): bool
    {
        if(!($item instanceof actor))
            return false;

        $conn = $this->connection->connect();

        try {

            $filmId = $item->getFilmId();
            $fioId = $item->getFioId();
            $role = $item->getRole();

            $sql_ins = "INSERT INTO actors (filmId, fioId, role) VALUES ('$filmId', '$fioId', '$role')";

            if($conn->query($sql_ins)){
                $conn->close();
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

    public function removeByModel(model $model): bool
    {
        if(!($model instanceof actor))
            return false;

        $id = $model->getId();
        return $this->remove($id);
    }

    public function updateByModel(model $oldItem, model $newItem): bool
    {
        if(!($oldItem instanceof actor))
           return false;

        $id = $oldItem->getId();
        return $this->update($id, $newItem);
    }

    public function select(string $text): array
    {
        $conn = $this->connection->connect();

        try {
            $select = "SELECT * FROM actors WHERE $text";
            $res = $conn->query($select);
            $result = array();
            foreach ($res as $iter){
                array_push($result, new actor($iter['Id'], $iter['FilmId'], $iter['FioId'], $iter['Role']));
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
                $result = new actor($iter['Id'], $iter['FilmId'], $iter['FioId'], $iter['Role']);
            }
            $res->free();
            return $result;

        } finally {
            $conn->close();
        }
    }
}