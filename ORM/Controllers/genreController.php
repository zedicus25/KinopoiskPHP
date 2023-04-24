<?php

namespace ORM\Controllers;
use ORM\Objects\genre;
use ORM\Objects\model;

require_once 'ORM/Controllers/controller.php';
require_once 'ORM/Objects/genre.php';
class genreController extends controller
{

    public function add(model $item): void
    {
        if(!($item instanceof genre))
            throw new \InvalidArgumentException("Wrong type!");

        $conn = $this->connection->connect();
        try {

            $title = $item->getTitle();

            $sql_ins = "INSERT INTO genres (title) VALUES ('$title')";

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
            $del = "DELETE FROM genres WHERE Id='$id';";

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
        if(!($newItem instanceof genre))
            throw new \InvalidArgumentException("Wrong type!");

        $conn = $this->connection->connect();

        try {
            $title = $newItem->getTitle();

            $upd = "UPDATE genres SET title='$title' WHERE Id='$id'";

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
        if(!($model instanceof genre))
            throw new \InvalidArgumentException("Wrong type!");

        $id = $model->getId();
        $this->remove($id);
    }

    public function updateByModel(model $oldItem, model $newItem): void
    {
        if(!($oldItem instanceof genre))
            throw new \InvalidArgumentException("Wrong type!");

        $id = $oldItem->getId();
        $this->update($id, $newItem);
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