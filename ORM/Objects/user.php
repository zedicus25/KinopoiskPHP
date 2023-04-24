<?php

namespace ORM\Objects;
use ORM\IEquals;
require_once 'ORM/Objects/model.php';
class user extends model
{
    private string $login;
    private string $password;
    private bool $isPremium;

    public function __construct(int $id, bool $isPremium, string $login, string $password)
    {
        $this->id = $id;
        $this->isPremium = $isPremium;
        $this->login = $login;
        $this->password = $password;
    }


    /**
     * @return bool
     */
    public function getIsPremium() : bool
    {
        return $this->isPremium;
    }

    /**
     * @return string
     */
    public function getLogin() : string
    {
        return $this->login;
    }

    /**
     * @return string
     */
    public function getPassword() : string
    {
        return $this->password;
    }

    /**
     * @param bool $isPremium
     */
    public function setIsPremium(bool $isPremium): void
    {
        $this->isPremium = $isPremium;
    }

    /**
     * @param string $login
     */
    public function setLogin(string $login): void
    {
        $this->login = $login;
    }

    /**
     * @param string $password
     */
    public function setPassword(string $password): void
    {
        $this->password = $password;
    }

    public function __toString(): string
    {
        return "User: Id: $this->id Login: $this->login IsPremium: $this->isPremium";
    }

    function equals($param): bool
    {
        if(!$this->instanceofThis($param))
            return false;

        if($this->id === $param->getId()
            && $this->isPremium === $param->getIsPremium()
            && $this->login === $param->getLogin()
            && $this->password === $param->getPassword())
            return true;

        return false;
    }

    function instanceofThis($param): bool
    {
        return ($param instanceof user);
    }
}