<?php



namespace Type {
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

    #[\Attribute]
    class Date extends Type implements TypeInterface
    {
        public function getType(): string
        {
            return "DATE";
        }
    };

    #[\Attribute]
    class TimeStamp extends Type implements TypeInterface
    {
        public function getType(): string
        {
            return "DATE";
        }
    };

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

    #[\Attribute]
    class Text extends Type
    {
        public function getType()
        {
            return "TEXT";
        }
    }

    #[\Attribute]

    class IntType extends Type
    {
        protected $type = "INT ";

        public function getType()
        {
            return $this->type;
        }
    }
}
