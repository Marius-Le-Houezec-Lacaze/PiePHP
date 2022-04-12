<?php

namespace Type;

#[\Attribute]
class Date extends Type implements TypeInterface
{
    public function getType(): string
    {
        return "DATE";
    }
};
