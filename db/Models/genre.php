<?php

namespace Database\Models;
require_once 'db/Models/model.php';

class genre extends model
{
    private string $title;

    public function __construct(int $id, string $title)
    {
        $this->id = $id;
        $this->title = $title;
    }


    /**
     * @param string $title
     */
    public function setTitle(string $title): void
    {
        $this->title = $title;
    }

    /**
     * @return string
     */
    public function getTitle(): string
    {
        return $this->title;
    }

    public function __toString(): string
    {
        return "Genre: Id: $this->id Title: $this->title";
    }

    function equals($param): bool
    {
        if(!$this->instanceofThis($param))
            return false;

        if($this->id === $param->getId() && $this->title === $param->getTitle())
            return true;

        return false;
    }

    function instanceofThis($param): bool
    {
       return ($param instanceof genre);
    }
}