<?php

namespace ORM\Objects;

use ORM\IEquals;
require_once 'ORM/IEquals.php';
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