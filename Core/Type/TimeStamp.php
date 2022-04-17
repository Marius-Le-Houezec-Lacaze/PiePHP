<?php
namespace Type;

#[\Attribute]
class TimeStamp extends Type implements TypeInterface
{
    protected $type = 'TIMESTAMP';

    public function getType(): string
    {
        return $this->type;
    }
};
