<?php

namespace ORM\Objects;
use ORM\IEquals;
require_once 'ORM/IEquals.php';
class director implements IEquals
{
    private int $id;
    private int $filmId;
    private string $name;
    private string $lastName;

    public function __construct(int $id, int $filmId, string $name, string $lastName)
    {
        $this->id = $id;
        $this->filmId = $filmId;
        $this->name = $name;
        $this->lastName = $lastName;
    }

    /**
     * @return string
     */
    public function getName() : string
    {
        return $this->name;
    }

    /**
     * @return int
     */
    public function getFilmId() : int
    {
        return $this->filmId;
    }

    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * @return string
     */
    public function getLastName() : string
    {
        return $this->lastName;
    }

    /**
     * @param int $filmId
     */
    public function setFilmId(int $filmId): void
    {
        $this->filmId = $filmId;
    }


    /**
     * @param string $lastName
     */
    public function setLastName(string $lastName): void
    {
        $this->lastName = $lastName;
    }

    /**
     * @param string $name
     */
    public function setName(string $name): void
    {
        $this->name = $name;
    }

    public function __toString(): string
    {
        return "Director: Id: $this->id FilmId: $this->filmId Name: $this->name Last Name: $this->lastName";
    }

    function equals($param): bool
    {
        if(!($param instanceof director))
            return false;

        if($this->id === $param->getId()
            && $this->name === $param->getName()
            && $this->lastName === $param->getLastName()
            && $this->filmId === $param->getFilmId())
            return true;

        return false;

    }
}