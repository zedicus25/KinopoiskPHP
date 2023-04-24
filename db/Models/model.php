<?php

namespace Database\Models;


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