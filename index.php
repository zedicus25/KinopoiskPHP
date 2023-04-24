<?php
require_once 'ORM/UOF.php';
require_once 'ORM/db.php';
require_once 'ORM/Models/genre.php';
$uof = new Database\UOF(Database\db::getInstance());
$genre = new \ORM\Objects\genre(1,"Fantasy");
//$uof->getGenreController()->add($genre);
//$uof->getGenreController()->remove(2);
//$uof->getGenreController()->update(1, new \ORM\Models\genre(5,'Action'));
$res = $uof->getGenreController()->getById(1);
echo $res;
?>
