<?php

namespace ORM;

interface IEquals
{
    function equals($param) : bool;

    function instanceofThis($param) : bool;
}