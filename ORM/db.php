<?php

namespace ORM;
use ORM\Controllers\actorsController;
use ORM\Controllers\directorController;
use ORM\Controllers\filmDataController;
use ORM\Controllers\filmRatingsController;
use ORM\Controllers\filmsController;
use ORM\Controllers\genreController;
use ORM\Controllers\usersController;

require_once 'ORM/Controllers/actorsController.php';
require_once 'ORM/Controllers/directorController.php';
require_once 'ORM/Controllers/filmDataController.php';
require_once 'ORM/Controllers/filmRatingsController.php';
require_once 'ORM/Controllers/filmsController.php';
require_once 'ORM/Controllers/genreController.php';
require_once 'ORM/Controllers/usersController.php';
class db
{
    private $conn;
    private $actorController;
    private $directorController;
    private $filmDataController;
    private $filmRatingsController;
    private $filmsController;
    private $genreController;
    private $usersController;

    public function __construct()
    {
        $this->conn = new mysqli("localhost", "root", "", "kinopoiskdb");
        $this->actorController = new actorsController($this->conn);
        $this->directorController = new directorController($this->conn);
        $this->filmDataController = new filmDataController($this->conn);
        $this->filmRatingsController = new filmRatingsController($this->conn);
        $this->filmsController = new filmsController($this->conn);
        $this->genreController = new genreController($this->conn);
        $this->usersController = new usersController($this->conn);

    }

    /**
     * @return actorsController
     */
    public function getActorController(): actorsController
    {
        return $this->actorController;
    }

    /**
     * @return directorController
     */
    public function getDirectorController(): directorController
    {
        return $this->directorController;
    }

    /**
     * @return filmDataController
     */
    public function getFilmDataController(): filmDataController
    {
        return $this->filmDataController;
    }

    /**
     * @return filmRatingsController
     */
    public function getFilmRatingsController(): filmRatingsController
    {
        return $this->filmRatingsController;
    }

    /**
     * @return filmsController
     */
    public function getFilmsController(): filmsController
    {
        return $this->filmsController;
    }

    /**
     * @return genreController
     */
    public function getGenreController(): genreController
    {
        return $this->genreController;
    }

    /**
     * @return usersController
     */
    public function getUsersController(): usersController
    {
        return $this->usersController;
    }
}
