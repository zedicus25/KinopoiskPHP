<?php

namespace Database\Controllers;
use Database\Models\genre;
use Database\Models\model;

require_once 'C:\xampp\htdocs\Kinopoisk/db/Controllers/controller.php';
require_once 'C:\xampp\htdocs\Kinopoisk/db/Models/genre.php';
class genreController extends controller
{
    public function add(model $item): bool
    {
        if(!($item instanceof genre))
            return false;

        $conn = $this->connection->connect();
        try {

            $title = $item->getTitle();

            $sql_ins = "INSERT INTO genres (title) VALUES ('$title')";

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
            $del = "DELETE FROM genres WHERE Id='$id';";

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
        if(!($newItem instanceof genre))
           return false;

        $conn = $this->connection->connect();

        try {
            $title = $newItem->getTitle();

            $upd = "UPDATE genres SET title='$title' WHERE Id='$id'";

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
        if(!($model instanceof genre))
            return false;

        $id = $model->getId();
        return $this->remove($id);
    }

    public function updateByModel(model $oldItem, model $newItem): bool
    {
        if(!($oldItem instanceof genre))
            return false;

        $id = $oldItem->getId();
        return $this->update($id, $newItem);
    }

    public function getById(int $id): model
    {
        $conn = $this->connection->connect();

        try {
            $select = "SELECT * FROM genres WHERE id='$id'";
            $res = $conn->query($select);
            $result = null;
            foreach ($res as $iter){
                $result = new genre($iter['Id'], $iter['Title']);
            }
            $res->free();
            return $result;

        } finally {
            $conn->close();
        }
    }

    public function select(string $text): array
    {
        $conn = $this->connection->connect();

        try {
            $select = "SELECT * FROM genres WHERE $text";
            $res = $conn->query($select);
            $result = array();
            foreach ($res as $iter){
                array_push($result, new genre($iter['Id'], $iter['Title']));
            }
            $res->free();
            return $result;

        } finally {
            $conn->close();
        }
    }
}