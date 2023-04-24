<?php

namespace ORM\Controllers;
use ORM\Objects\film;
use ORM\Objects\model;

require_once 'ORM/Controllers/controller.php';
require_once 'ORM/Objects/film.php';
class filmsController extends controller
{

    public function add(model $item): void
    {
        if(!($item instanceof film))
            throw new \InvalidArgumentException("Wrong type!");

        $conn = $this->connection->connect();

        try {

            $genreId = $item->getGenreId();
            $filmRatingId = $item->getFilmRatingId();
            $filmDataId = $item->getFilmDataId();
            $isPremium = $item->getIsPremium();

            $sql_ins = "INSERT INTO films (genreId, filmRatingId, filmDataId, isPremium) VALUES ('$genreId', '$filmRatingId', '$filmDataId', '$isPremium')";

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
            $del = "DELETE FROM films WHERE Id='$id';";

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
        if(!($newItem instanceof film))
            throw new \InvalidArgumentException("Wrong type!");

        $conn = $this->connection->connect();

        try {
            $genreId = $newItem->getGenreId();
            $filmRatingId = $newItem->getFilmRatingId();
            $filmDataId = $newItem->getFilmDataId();
            $isPremium = $newItem->getIsPremium();

            $upd = "UPDATE films SET genreId='$genreId',filmRatingId='$filmRatingId', filmDataId='$filmDataId', isPremium='$isPremium' WHERE Id='$id'";

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
        if(!($model instanceof film))
            throw new \InvalidArgumentException("Wrong type!");

        $id = $model->getId();
        $this->remove($id);
    }

    public function updateByModel(model $oldItem, model $newItem): void
    {
        if(!($oldItem instanceof film))
            throw new \InvalidArgumentException("Wrong type!");

        $id = $oldItem->getId();
        $this->update($id, $newItem);
    }

    public function getById(int $id): model
    {
        $conn = $this->connection->connect();

        try {
            $select = "SELECT * FROM films WHERE id='$id'";
            $res = $conn->query($select);
            $result = null;
            foreach ($res as $iter){
                $result = new film($iter['Id'], $iter['GanreId'], $iter['FilmDataId'], $iter['FilmRatingId'], $iter['IsPremium']);
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
            $select = "SELECT * FROM films WHERE $text";
            $res = $conn->query($select);
            $result = array();
            foreach ($res as $iter){
                array_push($result, new film($iter['Id'], $iter['GanreId'], $iter['FilmDataId'], $iter['FilmRatingId'], $iter['IsPremium']));
            }
            $res->free();
            return $result;

        } finally {
            $conn->close();
        }
    }
}