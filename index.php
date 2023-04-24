<?php
require_once 'ORM/UOF.php';
require_once 'ORM/db.php';
require_once 'ORM/Objects/genre.php';
$uof = new \ORM\UOF(\ORM\db::getInstance());
$genre = new \ORM\Objects\genre(1,"Fantasy");
//$uof->getGenreController()->add($genre);
//$uof->getGenreController()->remove(2);
//$uof->getGenreController()->update(1, new \ORM\Objects\genre(5,'Action'));
$res = $uof->getGenreController()->getById(1);
echo $res;
?>
