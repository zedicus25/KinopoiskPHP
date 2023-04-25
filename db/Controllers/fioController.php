<?php

namespace Database\Controllers;

use Database\Models\memberFio;
use Database\Models\model;

require_once 'C:\xampp\htdocs\Kinopoisk/db/Controllers/controller.php';
require_once 'C:\xampp\htdocs\Kinopoisk/db/Models/memberFio.php';
class fioController extends controller
{
    public function add(model $item): bool
    {
        if(!($item instanceof memberFio))
            return false;

        $conn = $this->connection->connect();

        try {

            $name = $item->getName();
            $lastName = $item->getLastName();
            $patronymic = $item->getPatronymic();

            $sql_ins = "INSERT INTO memberfios (name, lastName, patronymic) VALUES ('$name', '$lastName', '$patronymic')";

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
            $del = "DELETE FROM memberfios WHERE Id='$id';";

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

    public function removeByModel(model $model): bool
    {
        if(!($model instanceof memberFio))
            return false;

        $id = $model->getId();
        return $this->remove($id);
    }

    public function update(int $id, model $newItem): bool
    {
        if(!($newItem instanceof memberFio))
            return false;

        $conn = $this->connection->connect();

        try {
            $name = $newItem->getName();
            $lastName = $newItem->getName();
            $patronymic = $newItem->getPatronymic();

            $upd = "UPDATE memberfios SET name='$name',lastName='$lastName', patronymic='$patronymic' WHERE Id='$id'";

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

    public function updateByModel(model $oldItem, model $newItem): bool
    {
        if(!($oldItem instanceof memberFio))
            return false;

        $id = $oldItem->getId();
        return $this->update($id, $newItem);
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