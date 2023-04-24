<?php

namespace ORM\Controllers;
use ORM\Objects\model;
use ORM\Objects\user;

require_once 'ORM/Controllers/controller.php';
require_once 'ORM/Objects/user.php';
class usersController extends controller
{

    public function add(model $item): void
    {
        if(!($item instanceof user))
            throw new \InvalidArgumentException("Wrong type!");

        $conn = $this->connection->connect();

        try {

            $login = $item->getLogin();
            $pass = $item->getPassword();
            $isPremium = $item->getIsPremium();

            $sql_ins = "INSERT INTO users (login, password, isPremium) VALUES ('$login', '$pass', '$isPremium')";

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
            $del = "DELETE FROM users WHERE Id='$id';";

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
        if(!($newItem instanceof users))
            throw new \InvalidArgumentException("Wrong type!");

        $conn = $this->connection->connect();

        try {
            $login = $newItem->getLogin();
            $pass = $newItem->getPassword();
            $isPremium = $newItem->getIsPremium();

            $upd = "UPDATE users SET login='$login',password='$pass',isPremium='$isPremium' WHERE Id='$id'";

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
        if(!($model instanceof user))
            throw new \InvalidArgumentException("Wrong type!");

        $id = $model->getId();
        $this->remove($id);
    }

    public function updateByModel(model $oldItem, model $newItem): void
    {
        if(!($oldItem instanceof user))
            throw new \InvalidArgumentException("Wrong type!");

        $id = $oldItem->getId();
        $this->update($id, $newItem);
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