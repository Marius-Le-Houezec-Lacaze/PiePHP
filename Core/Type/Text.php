<?php

namespace Type;

#[\Attribute]
class Text extends Type
{
    public function getType()
    {
        return "TEXT";
    }
}
