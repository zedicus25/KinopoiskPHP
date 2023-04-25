<?php

namespace Database;
use Database\Controllers\actorsController;
use Database\Controllers\directorController;
use Database\Controllers\filmDataController;
use Database\Controllers\filmRatingsController;
use Database\Controllers\filmsController;
use Database\Controllers\fioController;
use Database\Controllers\genreController;
use Database\Controllers\usersController;

require_once 'C:\xampp\htdocs\Kinopoisk/db/Controllers/actorsController.php';
require_once 'C:\xampp\htdocs\Kinopoisk/db/Controllers/directorController.php';
require_once 'C:\xampp\htdocs\Kinopoisk/db/Controllers/filmDataController.php';
require_once 'C:\xampp\htdocs\Kinopoisk/db/Controllers/filmRatingsController.php';
require_once 'C:\xampp\htdocs\Kinopoisk/db/Controllers/filmsController.php';
require_once 'C:\xampp\htdocs\Kinopoisk/db/Controllers/genreController.php';
require_once 'C:\xampp\htdocs\Kinopoisk/db/Controllers/usersController.php';
require_once 'C:\xampp\htdocs\Kinopoisk/db/Controllers/fioController.php';
class UOF
{
    private $conn;
    private  fioController $fioController;
    private actorsController $actorController;
    private directorController $directorController;
    private filmDataController $filmDataController;
    private filmRatingsController $filmRatingsController;
    private filmsController $filmsController;
    private genreController $genreController;
    private usersController $usersController;

    public function __construct($db)
    {
        $this->conn = $db;
        $this->actorController = new actorsController($this->conn);
        $this->directorController = new directorController($this->conn);
        $this->filmDataController = new filmDataController($this->conn);
        $this->filmRatingsController = new filmRatingsController($this->conn);
        $this->filmsController = new filmsController($this->conn);
        $this->genreController = new genreController($this->conn);
        $this->usersController = new usersController($this->conn);
        $this->fioController = new fioController($this->conn);

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

    /**
     * @return fioController
     */
    public function getFioController(): fioController
    {
        return $this->fioController;
    }
}
