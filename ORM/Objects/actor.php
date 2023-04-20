<?php

namespace ORM\Objects;
class actor
{
    private $id;
    private $filmId;
    private $name;
    private $lastName;
    public function __construct($id, $filmId, $name, $lastName)
    {
        $this->id = $id;
        $this->filmId = $filmId;
        $this->name = $name;
        $this->lastName = $lastName;
    }

    /**
     * @return mixed
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @return mixed
     */
    public function getFilmId()
    {
        return $this->filmId;
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
    public function getLastName()
    {
        return $this->lastName;
    }

    /**
     * @param mixed $filmId
     */
    public function setFilmId($filmId): void
    {
        $this->filmId = $filmId;
    }

    /**
     * @param mixed $id
     */
    public function setId($id): void
    {
        $this->id = $id;
    }

    /**
     * @param mixed $lastName
     */
    public function setLastName($lastName): void
    {
        $this->lastName = $lastName;
    }

    /**
     * @param mixed $name
     */
    public function setName($name): void
    {
        $this->name = $name;
    }
}