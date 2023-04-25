<?php

use Database\dbConnection;
use Database\Models\director;
use Database\Models\memberFio;
use Database\UOF;
require_once 'C:\xampp\htdocs\Kinopoisk\db\UOF.php';
require_once 'C:\xampp\htdocs\Kinopoisk\db\dbConnection.php';
require_once 'C:\xampp\htdocs\Kinopoisk\db/Models/director.php';
require_once 'C:\xampp\htdocs\Kinopoisk\db/Models/memberFio.php';

if ($_SERVER['REQUEST_METHOD'] == "GET") {
    if (isset($_GET['getByAuthor'])) {

        if (isset($_GET['name']) && isset($_GET['lastName']) && isset($_GET['patronymic'])) {

            $uof = new UOF(dbConnection::getInstance());

            $name = $_GET['name'];
            $lastName = $_GET['lastName'];
            $patronymic = $_GET['patronymic'];

            $fioId = $uof->getFioController()->select("name='$name' and lastName='$lastName' and patronymic='$patronymic'")[0];
            $dir = new director(0, 0, $fioId->getId());
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
    $actorsController = $uof->getActorController();
    $fioController = $uof->getFioController();

    $dirFioId = $director->getFioId();
    $dirFio =  $fioController->getById($dirFioId);

    $directors = $dirCont->select("fioId='$dirFioId'");

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

    $actors = array();
    foreach ($films as $film) {
        $filmId = $film->getId();
        array_push($actors, $actorsController->select("filmId='$filmId'"));
    }

    $res = array();

    for ($i = 0; $i < count($films); $i++) {

        $filmActors = "";
        foreach ($actors as $act){
            foreach ($act as $ac){
                if($ac->getFilmId() === $films[$i]->getId()){
                    $acFio = $fioController->getById($ac->getFioId());
                    $actName = $acFio->getName();
                    $actLastName = $acFio->getLastName();
                    $actPatronymic = $acFio->getPatronymic();
                    $filmActors = $filmActors. "$actLastName $actName $actPatronymic ";
                }
            }

        }


        array_push($res,
            [
                'id' => $films[$i]->getId(),
                'title' => $filmsData[$i]->getTitle(),
                'country' => $filmsData[$i]->getCountry(),
                'year' => $filmsData[$i]->getYear(),
                'duration' => $filmsData[$i]->getDuration(),
                'genre' => $genres[$i]->getTitle(),
                'director'=> $dirFio->getName()." ". $dirFio->getLastName(),
                'actors'=> $filmActors,
                'rating' => [
                    'likes' => $filmsRatings[$i]->getLikes(),
                    'dislikes' => $filmsRatings[$i]->getDislikes(),
                    'imdb' => $filmsRatings[$i]->getImdb(),
                ],
            ]);
    }
    return $res;
}

