<?php

namespace Database\Models;
require_once 'C:\xampp\htdocs\Kinopoisk/db/Models/model.php';
class memberFio extends model
{
    private string $name;
    private string $lastName;
    private string $patronymic;

    public function __construct(int $id, string $name, string $lastName, string $patronymic)
    {
        $this->id = $id;
        $this->name = $name;
        $this->lastName = $lastName;
        $this->patronymic = $patronymic;
    }

    /**
     * @return string
     */
    public function getLastName(): string
    {
        return $this->lastName;
    }

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @return string
     */
    public function getPatronymic(): string
    {
        return $this->patronymic;
    }

    /**
     * @param string $name
     */
    public function setName(string $name): void
    {
        $this->name = $name;
    }

    /**
     * @param string $lastName
     */
    public function setLastName(string $lastName): void
    {
        $this->lastName = $lastName;
    }

    /**
     * @param string $patronymic
     */
    public function setPatronymic(string $patronymic): void
    {
        $this->patronymic = $patronymic;
    }

    function equals($param): bool
    {
        if(!$this->instanceofThis($param))
            return false;

        if($this->id === $param->getId()
            && $this->name === $param->ge()
            && $this->name === $param->getName()
            && $this->lastName === $param->getLastName()
            && $this->patronymic === $param->getPatronymic())
            return true;


        return true;
    }

    public function __toString(): string
    {
        return "Id: $this->id Name: $this->name LastName: $this->lastName Patronymic: $this->patronymic";
    }

    function instanceofThis($param): bool
    {
        return ($param instanceof memberFio);
    }
}