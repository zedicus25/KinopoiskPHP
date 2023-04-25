<?php

namespace Database\Models;
require_once 'C:\xampp\htdocs\Kinopoisk/db/Models/IEquals.php';

abstract class model implements IEquals
{
    protected int $id;

    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }
}