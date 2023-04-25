<?php

namespace Database\Models;
require_once 'C:\xampp\htdocs\Kinopoisk/db/Models/model.php';
class actor extends model
{
    private int $filmId;
    private int $fioId;
    private string $role;

    public function __construct(int $id, int $filmId, int $fioId, string $role)
    {
        $this->id = $id;
        $this->filmId = $filmId;
        $this->fioId = $fioId;
        $this->role = $role;
    }


    /**
     * @return int
     */
    public function getFilmId() : int
    {
        return $this->filmId;
    }

    /**
     * @return string
     */
    public function getRole(): string
    {
        return $this->role;
    }

    /**
     * @return int
     */
    public function getFioId(): int
    {
        return $this->fioId;
    }

    /**
     * @param int $filmId
     */
    public function setFilmId(int $filmId): void
    {
        $this->filmId = $filmId;
    }


    /**
     * @param int $fioId
     */
    public function setFioId(int $fioId): void
    {
        $this->fioId = $fioId;
    }

    /**
     * @param string $role
     */
    public function setRole(string $role): void
    {
        $this->role = $role;
    }

    public function __toString(): string
    {
        return "Actor: Id: $this->id FilmId: $this->filmId FioId: $this->fioId Role: $this->role";
    }

    function equals($param): bool
    {
        if(!$this->instanceofThis($param))
            return false;

        if($this->id === $param->getId()
            && $this->fioId === $param->getFioId()
            && $this->filmId === $param->getFilmId()
            && $this->role === $param->getRole())
            return true;

        return false;

    }

    function instanceofThis($param): bool
    {
        return $param instanceof actor;
    }
}