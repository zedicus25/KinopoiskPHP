<?php

namespace ORM\Objects;
use ORM\IEquals;
require_once 'ORM/Objects/model.php';
class filmRating extends model
{
    private int $likes;
    private int $dislikes;
    private float $imdb;

    public function __construct(int $id, int $likes, int $dislikes, float $imdb)
    {
        $this->id = $id;
        $this->likes = $likes;
        $this->dislikes = $dislikes;
        $this->imdb = $imdb;
    }

    /**
     * @return int
     */
    public function getDislikes() : int
    {
        return $this->dislikes;
    }

    /**
     * @return float
     */
    public function getImdb() : float
    {
        return $this->imdb;
    }

    /**
     * @return int
     */
    public function getLikes() : int
    {
        return $this->likes;
    }

    /**
     * @param int $dislikes
     */
    public function setDislikes(int $dislikes): void
    {
        $this->dislikes = $dislikes;
    }

    /**
     * @param float $imdb
     */
    public function setImdb(float $imdb): void
    {
        $this->imdb = $imdb;
    }

    /**
     * @param int $likes
     */
    public function setLikes(int $likes): void
    {
        $this->likes = $likes;
    }

    public function __toString(): string
    {
        return "FilmRating Id: $this->id IMDb: $this->imdb Dislikes: $this->dislikes Likes: $this->likes";
    }

    function equals($param): bool
    {
        if(!$this->instanceofThis($param))
            return false;

        if($this->id === $param->getId()
            && $this->imdb === $param->getImdb()
            && $this->dislikes === $param->getDislikes()
            && $this->likes === $param->getLikes())
            return true;

        return false;
    }

    function instanceofThis($param): bool
    {
        return ($param instanceof filmRating);
    }
}