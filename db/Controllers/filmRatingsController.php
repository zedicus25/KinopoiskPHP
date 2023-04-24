<?php

namespace Database\Controllers;
use Database\Models\filmRating;
use Database\Models\model;

require_once 'db/Controllers/controller.php';
require_once 'db/Models/filmRating.php';
class filmRatingsController extends controller
{

    public function add(model $item): void
    {
        if(!($item instanceof filmRating))
            throw new \InvalidArgumentException("Wrong type!");

        $conn = $this->connection->connect();

        try {

            $likes = $item->getLikes();
            $dislikes = $item->getDislikes();
            $imdb = $item->getImdb();

            $sql_ins = "INSERT INTO filmratings (likes, dislikes, imdb) VALUES ('$likes', '$dislikes', '$imdb')";

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
            $del = "DELETE FROM filmratings WHERE Id='$id';";

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
        if(!($newItem instanceof filmRating))
            throw new \InvalidArgumentException("Wrong type!");

        $conn = $this->connection->connect();

        try {
            $likes = $newItem->getLikes();
            $dislikes = $newItem->getDislikes();
            $imdb = $newItem->getImdb();

            $upd = "UPDATE filmratings SET likes='$likes',dislikes='$dislikes', imdb='$imdb' WHERE Id='$id'";

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
        if(!($model instanceof filmRating))
            throw new \InvalidArgumentException("Wrong type!");

        $id = $model->getId();
        $this->remove($id);
    }

    public function updateByModel(model $oldItem, model $newItem): void
    {
        if(!($oldItem instanceof filmRating))
            throw new \InvalidArgumentException("Wrong type!");

        $id = $oldItem->getId();
        $this->update($id, $newItem);
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