<?php

namespace Database\Models;
require_once 'C:\xampp\htdocs\Kinopoisk/db/Models/model.php';
class director extends model
{
    private int $filmId;
    private int $fioId;


    public function __construct(int $id, int $filmId, int $fioId)
    {
        $this->id = $id;
        $this->filmId = $filmId;
        $this->fioId = $fioId;
    }

    /**
     * @return int
     */
    public function getFioId(): int
    {
        return $this->fioId;
    }

    /**
     * @return int
     */
    public function getFilmId() : int
    {
        return $this->filmId;
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

    public function __toString(): string
    {
        return "Director: Id: $this->id FilmId: $this->filmId FioId: $this->fioId";
    }

    function equals($param): bool
    {
        if(!$this->instanceofThis($param))
            return false;

        if($this->id === $param->getId()
            && $this->fioId === $param->getFioId()
            && $this->filmId === $param->getFilmId())
            return true;

        return false;

    }

    function instanceofThis($param): bool
    {
        return $param instanceof director;
    }
}