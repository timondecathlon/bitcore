<?php

namespace Bitkit\Core\Interfaces; 

interface UnitActions
{
    function createLine(array $fields_array, array $values_array) ;

    function getLine();

    function updateLine(array $fields_array, array $values_array);

    function deleteLine();
}