<?php

namespace Database\Models;
require_once 'C:\xampp\htdocs\Kinopoisk/db/Models/model.php';

class film extends model
{
    private int $genreId;
    private int $filmRatingId;
    private int $filmDataId;
    private bool $isPremium;

    public function __construct(int $id, int $genreId, int $filmDataId, int $filmRatingId, bool $isPremium)
    {
        $this->id = $id;
        $this->genreId = $genreId;
        $this->filmDataId = $filmDataId;
        $this->filmRatingId = $filmRatingId;
        $this->isPremium = $isPremium;
    }


    /**
     * @return int
     */
    public function getFilmDataId() : int
    {
        return $this->filmDataId;
    }

    /**
     * @return int
     */
    public function getFilmRatingId(): int
    {
        return $this->filmRatingId;
    }

    /**
     * @return int
     */
    public function getGenreId(): int
    {
        return $this->genreId;
    }

    /**
     * @return bool
     */
    public function getIsPremium(): bool
    {
        return $this->isPremium;
    }

    /**
     * @param int $filmDataId
     */
    public function setFilmDataId(int $filmDataId): void
    {
        $this->filmDataId = $filmDataId;
    }

    /**
     * @param int $filmRatingId
     */
    public function setFilmRatingId(int $filmRatingId): void
    {
        $this->filmRatingId = $filmRatingId;
    }

    /**
     * @param int $genreId
     */
    public function setGenreId(int $genreId): void
    {
        $this->genreId = $genreId;
    }

    /**
     * @param bool $isPremium
     */
    public function setIsPremium(bool $isPremium): void
    {
        $this->isPremium = $isPremium;
    }

    public function __toString(): string
    {
        return "Film: Id: $this->id FilmDataId: $this->filmDataId FilmRatingId: $this->filmRatingId FilmGenreId: $this->genreId IsPremium: $this->isPremium";
    }

    function equals($param): bool
    {
        if(!$this->instanceofThis($param))
            return false;

        if($this->id === $param->getId()
            && $this->genreId === $param->getGenreId()
            && $this->filmRatingId === $param->getFilmRatingId()
            && $this->filmDataId === $param->getFilmDataId()
            && $this->isPremium === $param->getIsPremium())
            return true;


        return true;
    }

    function instanceofThis($param): bool
    {
        return ($param instanceof film);
    }
}