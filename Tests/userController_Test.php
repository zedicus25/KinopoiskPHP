<?php

namespace Tests;

use Database\dbConnection;
use Database\Models\user;
use Database\UOF;


require_once 'C:\xampp\htdocs\Kinopoisk/db/UOF.php';
require_once 'C:\xampp\htdocs\Kinopoisk/db/dbConnection.php';
require_once 'C:\xampp\htdocs\Kinopoisk/db/Models/user.php';
class userController_Test
{
    private UOF $uof;
    public function __construct()
    {
        $this->uof = new UOF(dbConnection::getInstance());
    }
    public function testAddingUser() : bool
    {
        $userCont = $this->uof->getUsersController();
        return $userCont->add(new user(0, false, 'admin','admin'));
    }
    public function testDeletingUserById() : bool
    {
        $userCont = $this->uof->getUsersController();
        return $userCont->remove(1);
    }

    public function testDeletingUserByModel() : bool
    {
        $userCont = $this->uof->getUsersController();
        return $userCont->removeByModel(new user(2, false, 'admin','admin'));
    }

    public function testUpdatingUser() : bool
    {
        $userCont = $this->uof->getUsersController();
        return $userCont->update(3,new user(0, true, 'ADMIN','ADMIN'));
    }
    public function testUpdatingUserByModel() : bool
    {
        $userCont = $this->uof->getUsersController();
        return $userCont->updateByModel(new user(0, true, 'ADMIN','ADMIN'),new user(0, true, 'NEADMIN','NEADMIN'));
    }
}

$userTest = new userController_Test();
var_dump($userTest->testUpdatingUserByModel());