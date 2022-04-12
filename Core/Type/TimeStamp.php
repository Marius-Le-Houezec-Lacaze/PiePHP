<?php
namespace Type;

#[\Attribute]
class TimeStamp extends Type implements TypeInterface
{
    public function getType(): string
    {
        return "DATE";
    }
};
