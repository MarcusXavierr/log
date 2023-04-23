<?php

namespace App\Traits;

trait ReadableProtectedAttribute
{
    public function __get($name)
    {
        return $this->{$name};
    }
}
