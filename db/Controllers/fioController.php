<?php

namespace Database\Controllers;

use Database\Models\memberFio;
use Database\Models\model;

require_once 'C:\xampp\htdocs\Kinopoisk/db/Controllers/controller.php';
require_once 'C:\xampp\htdocs\Kinopoisk/db/Models/memberFio.php';
class fioController extends controller
{
    public function add(model $item): void
    {
        if(!($item instanceof memberFio))
            throw new \InvalidArgumentException("Wrong type!");

        $conn = $this->connection->connect();

        try {

            $name = $item->getName();
            $lastName = $item->getLastName();
            $patronymic = $item->getPatronymic();

            $sql_ins = "INSERT INTO memberfios (name, lastName, patronymic) VALUES ('$name', '$lastName', '$patronymic')";

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
            $del = "DELETE FROM memberfios WHERE Id='$id';";

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

    public function removeByModel(model $model): void
    {
        if(!($model instanceof memberFio))
            throw new \InvalidArgumentException("Wrong type!");

        $id = $model->getId();
        $this->remove($id);
    }

    public function update(int $id, model $newItem): void
    {
        if(!($newItem instanceof memberFio))
            throw new \InvalidArgumentException("Wrong type!");

        $conn = $this->connection->connect();

        try {
            $name = $newItem->getName();
            $lastName = $newItem->getName();
            $patronymic = $newItem->getPatronymic();

            $upd = "UPDATE memberfios SET name='$name',lastName='$lastName', patronymic='$patronymic' WHERE Id='$id'";

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

    public function updateByModel(model $oldItem, model $newItem): void
    {
        if(!($oldItem instanceof memberFio))
            throw new \InvalidArgumentException("Wrong type!");

        $id = $oldItem->getId();
        $this->update($id, $newItem);
    }

    public function getById(int $id): model
    {
        $conn = $this->connection->connect();

        try {
            $select = "SELECT * FROM memberfios WHERE id='$id'";
            $res = $conn->query($select);
            $result = null;
            foreach ($res as $iter){
                $result = new memberFio($iter['Id'], $iter['Name'], $iter['LastName'], $iter['Patronymic']);
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
            $select = "SELECT * FROM memberfios WHERE $text";
            $res = $conn->query($select);
            $result = array();
            foreach ($res as $iter){
                array_push($result, new memberFio($iter['Id'], $iter['Name'], $iter['LastName'], $iter['Patronymic']));
            }
            $res->free();
            return $result;

        } finally {
            $conn->close();
        }
    }
}