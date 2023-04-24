<?php

namespace Database\Models;

interface IEquals
{
    function equals($param) : bool;

    function instanceofThis($param) : bool;
}