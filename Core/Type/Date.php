<?php

namespace Type;

#[\Attribute]
class Date extends Type implements TypeInterface
{
    private $type = 'DATE ';
    public function getType(): string
    {
        return $this->type;
    }
};
