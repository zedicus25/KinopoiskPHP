<?php

namespace ORM\Objects;
use ORM\IEquals;
require_once 'ORM/Objects/filmData.php';
class filmData extends model
{
    private string $country;
    private string $title;
    private int $year;
    private int $duration;

    public function __construct(int $id, string $country, string $title, int $year, int $duration)
    {
        $this->id = $id;
        $this->country = $country;
        $this->title = $title;
        $this->year = $year;
        $this->duration = $duration;
    }


    /**
     * @return string
     */
    public function getCountry() : string
    {
        return $this->country;
    }

    /**
     * @return int
     */
    public function getDuration() : int
    {
        return $this->duration;
    }

    /**
     * @return string
     */
    public function getTitle() : string
    {
        return $this->title;
    }

    /**
     * @return int
     */
    public function getYear() : int
    {
        return $this->year;
    }


    /**
     * @param string $country
     */
    public function setCountry(string $country): void
    {
        $this->country = $country;
    }

    /**
     * @param int $duration
     */
    public function setDuration(int $duration): void
    {
        $this->duration = $duration;
    }

    /**
     * @param string $title
     */
    public function setTitle(string $title): void
    {
        $this->title = $title;
    }

    /**
     * @param int $year
     */
    public function setYear(int $year): void
    {
        $this->year = $year;
    }

    public function __toString(): string
    {
        return "FilmData: Id: $this->id Title: $this->title Country: $this->country Year: $this->year Duration: $this->duration";
    }

    function equals($param): bool
    {
        if(!$this->instanceofThis($param))
            return false;

        if($this->id === $param->getId()
            && $this->country === $param->getCountry()
            && $this->title === $param->getTitle()
            && $this->year === $param->getYear()
            && $this->duration === $param->getDuration())
            return true;

        return false;
    }

    function instanceofThis($param): bool
    {
        return ($param instanceof filmData);
    }
}