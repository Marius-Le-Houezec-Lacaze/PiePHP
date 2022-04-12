<?php

namespace Type;

interface TypeInterface
{
    public function getType(): mixed;
}

abstract class Type
{

    public function __construct(bool $null = false, bool $auto_increment = false, bool $primary_key = false)
    {
        $this->type .= implode(
            ' ',
            [
                $primary_key ? 'PRIMARY KEY' : '',
                $null ? '' : 'NOT NULL',
                $auto_increment ? 'AUTO_INCREMENT' : ''
            ]
        );
    }
}
