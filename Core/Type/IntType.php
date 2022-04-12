<?php

namespace Type;

#[\Attribute]

class IntType extends Type
{
    protected $type = "INT ";

    public function getType()
    {
        return $this->type;
    }
}
