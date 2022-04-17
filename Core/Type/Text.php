<?php

namespace Type;

#[\Attribute]
class Text extends Type
{
    protected $type = 'TEXT';


    public function getType()
    {
        return $this->type;
    }
}
