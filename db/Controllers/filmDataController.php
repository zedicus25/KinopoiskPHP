<?php

namespace Database\Controllers;
use Database\Models\filmData;
use Database\Models\model;

require_once 'C:\xampp\htdocs\Kinopoisk/db/Controllers/controller.php';
require_once 'C:\xampp\htdocs\Kinopoisk/db/Models/filmData.php';
class filmDataController extends controller
{

    public function add(model $item): void
    {
        if(!($item instanceof filmData))
            throw new \InvalidArgumentException("Wrong type!");

        $conn = $this->connection->connect();

        try {

            $country = $item->getCountry();
            $title = $item->getTitle();
            $year = $item->getYear();
            $duration = $item->getDuration();

            $sql_ins = "INSERT INTO filmdata (country, title, year, duration) VALUES ('$country', '$title', '$year', '$duration')";

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
            $del = "DELETE FROM filmdata WHERE Id='$id';";

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
        if(!($newItem instanceof filmData))
            throw new \InvalidArgumentException("Wrong type!");

        $conn = $this->connection->connect();

        try {
            $country = $newItem->getCountry();
            $title = $newItem->getTitle();
            $year = $newItem->getYear();
            $duration = $newItem->getDuration();

            $upd = "UPDATE filmdata SET country='$country',title='$title', year='$year', duration='$duration' WHERE Id='$id'";

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
        if(!($model instanceof filmData))
            throw new \InvalidArgumentException("Wrong type!");


        $id = $model->getId();
        $this->remove($id);
    }

    public function updateByModel(model $oldItem, model $newItem): void
    {
        if(!($oldItem instanceof filmData))
            throw new \InvalidArgumentException("Wrong type!");

        $id = $oldItem->getId();
        $this->update($id, $newItem);
    }

    public function select(string $text): array
    {
        $conn = $this->connection->connect();

        try {
            $select = "SELECT * FROM filmdata WHERE $text";
            $res = $conn->query($select);
            $result = array();
            foreach ($res as $iter){
                array_push($result, new filmData($iter['Id'], $iter['Country'], $iter['Title'], $iter['Year'], $iter['Duration']));
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
            $select = "SELECT * FROM filmdata WHERE id='$id'";
            $res = $conn->query($select);
            $result = null;
            foreach ($res as $iter){
                $result = new filmData($iter['Id'], $iter['Country'], $iter['Title'], $iter['Year'], $iter['Duration']);
            }
            $res->free();
            return $result;

        } finally {
            $conn->close();
        }
    }
}