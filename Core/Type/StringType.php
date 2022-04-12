<?php

namespace Type;

#[\Attribute]
class StringType extends Type implements TypeInterface
{
    protected string $type = "VARCHAR(%s)";

    public function __construct(int $lenght = 255, bool $null = false, bool $auto_increment = false, bool $primary_key = false)
    {
        $this->type = sprintf($this->type, $lenght);
        parent::__construct($null, $auto_increment, $primary_key);
    }

    public function getType(): string
    {
        return $this->type;
    }
};
