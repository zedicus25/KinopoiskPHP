<?php

namespace Database\Controllers;
use Database\Models\filmRating;
use Database\Models\model;

require_once 'C:\xampp\htdocs\Kinopoisk/db/Controllers/controller.php';
require_once 'C:\xampp\htdocs\Kinopoisk/db/Models/filmRating.php';
class filmRatingsController extends controller
{

    public function add(model $item): bool
    {
        if(!($item instanceof filmRating))
            return false;

        $conn = $this->connection->connect();

        try {

            $likes = $item->getLikes();
            $dislikes = $item->getDislikes();
            $imdb = $item->getImdb();

            $sql_ins = "INSERT INTO filmratings (likes, dislikes, imdb) VALUES ('$likes', '$dislikes', '$imdb')";

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
            $del = "DELETE FROM filmratings WHERE Id='$id';";

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
        if(!($newItem instanceof filmRating))
            throw new \InvalidArgumentException("Wrong type!");

        $conn = $this->connection->connect();

        try {
            $likes = $newItem->getLikes();
            $dislikes = $newItem->getDislikes();
            $imdb = $newItem->getImdb();

            $upd = "UPDATE filmratings SET likes='$likes',dislikes='$dislikes', imdb='$imdb' WHERE Id='$id'";

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
        if(!($model instanceof filmRating))
           return false;

        $id = $model->getId();
        return $this->remove($id);
    }

    public function updateByModel(model $oldItem, model $newItem): bool
    {
        if(!($oldItem instanceof filmRating))
            return false;

        $id = $oldItem->getId();
        return $this->update($id, $newItem);
    }

    public function getById(int $id): model
    {
        $conn = $this->connection->connect();

        try {
            $select = "SELECT * FROM filmratings WHERE id='$id'";
            $res = $conn->query($select);
            $result = null;
            foreach ($res as $iter){
                $result = new filmRating($iter['Id'], $iter['Likes'], $iter['Dislikes'], $iter['IMDb']);
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
            $select = "SELECT * FROM filmratings WHERE $text";
            $res = $conn->query($select);
            $result = array();
            foreach ($res as $iter){
                array_push($result, new filmRating($iter['Id'], $iter['Likes'], $iter['Dislikes'], $iter['IMDb']));
            }
            $res->free();
            return $result;

        } finally {
            $conn->close();
        }
    }
}