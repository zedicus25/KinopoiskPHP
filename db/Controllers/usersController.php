<?php

namespace Database\Controllers;
use Database\Models\model;
use Database\Models\user;

require_once 'C:\xampp\htdocs\Kinopoisk/db/Controllers/controller.php';
require_once 'C:\xampp\htdocs\Kinopoisk/db/Models/user.php';
class usersController extends controller
{

    public function add(model $item): bool
    {
        if(!($item instanceof user))
            return false;

        $conn = $this->connection->connect();

        try {

            $login = $item->getLogin();
            $pass = $item->getPassword();
            $isPremium = $item->getIsPremium();

            $sql_ins = "INSERT INTO users (login, password, isPremium) VALUES ('$login', '$pass', '$isPremium')";

            if($conn->query($sql_ins)){
                $conn?->close();
                return true;
            }
            else{
                $conn?->close();
                return false;
            }
        } finally {
        }


    }

    public function remove(int $id): bool
    {
        $conn = $this->connection->connect();

        try {
            $del = "DELETE FROM users WHERE Id='$id';";

            if($conn->query($del)){
                $conn?->close();
                return true;
            }
            else{
                $conn?->close();
                return false;
            }
        } finally {
        }
    }

    public function update(int $id, $newItem): bool
    {
        if(!($newItem instanceof user))
            return false;

        $conn = $this->connection->connect();

        try {
            $login = $newItem->getLogin();
            $pass = $newItem->getPassword();
            $isPremium = $newItem->getIsPremium();

            $upd = "UPDATE users SET login='$login',password='$pass',isPremium='$isPremium' WHERE Id='$id'";

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
        }
    }

    public function removeByModel(model $model): bool
    {
        if(!($model instanceof user))
            return false;

        $id = $model->getId();
        return $this->remove($id);
    }

    public function updateByModel(model $oldItem, model $newItem): bool
    {
        if(!($oldItem instanceof user))
            return false;

        $id = $oldItem->getId();
        return $this->update($id, $newItem);
    }

    public function getById(int $id): model
    {
        $conn = $this->connection->connect();

        try {
            $select = "SELECT * FROM users WHERE id='$id'";
            $res = $conn->query($select);
            $result = null;
            foreach ($res as $iter){
                $result = new user($iter['Id'], $iter['Login'], $iter['Password'], $iter['IsPremium']);
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
            $select = "SELECT * FROM users WHERE $text";
            $res = $conn->query($select);
            $result = array();
            foreach ($res as $iter){
                array_push($result, new user($iter['Id'], $iter['Login'], $iter['Password'], $iter['IsPremium']));
            }
            $res->free();
            return $result;

        } finally {
            $conn->close();
        }
    }
}