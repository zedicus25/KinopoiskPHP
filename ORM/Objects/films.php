<?php

namespace ORM\Objects;
class films
{
    private $id;
    private $genreId;
    private $filmRatingId;
    private $filmDataId;
    private $isPremium;

    public function __construct($id, $genreId, $filmDataId, $filmRatingId, $isPremium)
    {
        $this->id = $id;
        $this->genreId = $genreId;
        $this->filmDataId = $filmDataId;
        $this->filmRatingId = $filmRatingId;
        $this->isPremium = $isPremium;
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
    public function getFilmDataId()
    {
        return $this->filmDataId;
    }

    /**
     * @return mixed
     */
    public function getFilmRatingId()
    {
        return $this->filmRatingId;
    }

    /**
     * @return mixed
     */
    public function getGenreId()
    {
        return $this->genreId;
    }

    /**
     * @return mixed
     */
    public function getIsPremium()
    {
        return $this->isPremium;
    }

    /**
     * @param mixed $id
     */
    public function setId($id): void
    {
        $this->id = $id;
    }

    /**
     * @param mixed $filmDataId
     */
    public function setFilmDataId($filmDataId): void
    {
        $this->filmDataId = $filmDataId;
    }

    /**
     * @param mixed $filmRatingId
     */
    public function setFilmRatingId($filmRatingId): void
    {
        $this->filmRatingId = $filmRatingId;
    }

    /**
     * @param mixed $genreId
     */
    public function setGenreId($genreId): void
    {
        $this->genreId = $genreId;
    }

    /**
     * @param mixed $isPremium
     */
    public function setIsPremium($isPremium): void
    {
        $this->isPremium = $isPremium;
    }
}