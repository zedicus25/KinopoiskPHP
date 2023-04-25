<?php

namespace Database\Controllers;
use Database\Models\director;
use Database\Models\film;
use Database\Models\model;

require_once 'C:\xampp\htdocs\Kinopoisk/db/Controllers/controller.php';
require_once 'C:\xampp\htdocs\Kinopoisk/db/Models/film.php';
class filmsController extends controller
{
    public function add(model $item): bool
    {
        if(!($item instanceof film))
            return false;

        $conn = $this->connection->connect();

        try {

            $genreId = $item->getGenreId();
            $filmRatingId = $item->getFilmRatingId();
            $filmDataId = $item->getFilmDataId();
            $isPremium = $item->getIsPremium();

            $sql_ins = "INSERT INTO films (genreId, filmRatingId, filmDataId, isPremium) VALUES ('$genreId', '$filmRatingId', '$filmDataId', '$isPremium')";

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
            $del = "DELETE FROM films WHERE Id='$id';";

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
        if(!($newItem instanceof film))
            return false;

        $conn = $this->connection->connect();

        try {
            $genreId = $newItem->getGenreId();
            $filmRatingId = $newItem->getFilmRatingId();
            $filmDataId = $newItem->getFilmDataId();
            $isPremium = $newItem->getIsPremium();

            $upd = "UPDATE films SET genreId='$genreId',filmRatingId='$filmRatingId', filmDataId='$filmDataId', isPremium='$isPremium' WHERE Id='$id'";

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
        if(!($model instanceof film))
            return false;

        $id = $model->getId();
        return $this->remove($id);
    }

    public function updateByModel(model $oldItem, model $newItem): bool
    {
        if(!($oldItem instanceof film))
            return false;

        $id = $oldItem->getId();
        return $this->update($id, $newItem);
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