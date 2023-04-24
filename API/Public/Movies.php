<?php

use Database\dbConnection;
use Database\Models\director;
use Database\UOF;
require_once 'C:\xampp\htdocs\Kinopoisk\db\UOF.php';
require_once 'C:\xampp\htdocs\Kinopoisk\db\dbConnection.php';
require_once 'C:\xampp\htdocs\Kinopoisk\db/Models/director.php';

if ($_SERVER['REQUEST_METHOD'] == "GET") {
    if (isset($_GET['getByAuthor'])) {

        if (isset($_GET['name']) && isset($_GET['lastName'])) {

            $dir = new director(0, 0, $_GET['name'], $_GET['lastName']);
            $res = getByAuthor($dir);
            $resJson = json_encode($res, JSON_PRETTY_PRINT);
            echo $resJson;
        } else
            echo "400";
    } else
        echo "400";
}

function getByAuthor(director $director): array
{
    $uof = new UOF(dbConnection::getInstance());
    $dirCont = $uof->getDirectorController();
    $filmsCont = $uof->getFilmsController();
    $filmsDataCont = $uof->getFilmDataController();
    $filmsRatingsCont = $uof->getFilmRatingsController();
    $filmsGenreCont = $uof->getGenreController();

    $dirName = $director->getName();
    $dirLastName = $director->getLastName();
    $directors = $dirCont->select("name like '$dirName' AND lastName like '$dirLastName'");

    $films = array();
    foreach ($directors as $dir) {
        array_push($films, $filmsCont->getById($dir->getFilmId()));
    }

    $filmsData = array();
    foreach ($films as $film) {
        array_push($filmsData, $filmsDataCont->getById($film->getFilmDataId()));
    }

    $filmsRatings = array();
    foreach ($films as $film) {
        array_push($filmsRatings, $filmsRatingsCont->getById($film->getFilmRatingId()));
    }

    $genres = array();
    foreach ($films as $film) {
        array_push($genres, $filmsGenreCont->getById($film->getGenreId()));
    }

    $res = array();

    for ($i = 0; $i < count($films); $i++) {
        array_push($res,
            [
                'id' => $films[$i]->getId(),
                'title' => $filmsData[$i]->getTitle(),
                'country' => $filmsData[$i]->getCountry(),
                'year' => $filmsData[$i]->getYear(),
                'duration' => $filmsData[$i]->getDuration(),
                'genre' => $genres[$i]->getTitle(),
                'director' => $directors[$i]->getLastName() . " " . $directors[$i]->getName(),
                'rating' => [
                    'likes' => $filmsRatings[$i]->getLikes(),
                    'dislikes' => $filmsRatings[$i]->getDislikes(),
                    'imdb' => $filmsRatings[$i]->getImdb(),
                ],
            ]);
    }
    return $res;
}

