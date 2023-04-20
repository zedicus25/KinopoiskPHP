<?php

namespace ORM\Objects;
class user
{
    private $id;
    private $login;
    private $password;
    private $isPremium;

    public function __construct($id, $isPremium, $login, $password)
    {
        $this->id = $id;
        $this->isPremium = $isPremium;
        $this->login = $login;
        $this->password = $password;
    }

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @return mixed
     */
    public function getIsPremium()
    {
        return $this->isPremium;
    }

    /**
     * @return mixed
     */
    public function getLogin()
    {
        return $this->login;
    }

    /**
     * @return mixed
     */
    public function getPassword()
    {
        return $this->password;
    }

    /**
     * @param mixed $id
     */
    public function setId($id): void
    {
        $this->id = $id;
    }

    /**
     * @param mixed $isPremium
     */
    public function setIsPremium($isPremium): void
    {
        $this->isPremium = $isPremium;
    }

    /**
     * @param mixed $login
     */
    public function setLogin($login): void
    {
        $this->login = $login;
    }

    /**
     * @param mixed $password
     */
    public function setPassword($password): void
    {
        $this->password = $password;
    }
}