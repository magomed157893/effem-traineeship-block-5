<?php

namespace App;

class User implements \JsonSerializable
{
    public function __construct(
        private string $name  = 'John Pork',
        private string $email = 'johnpork@mail.net'
    ) {}

    public function jsonSerialize(): mixed
    {
        return [
            'name'  => $this->name,
            'email' => $this->email
        ];
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getEmail(): string
    {
        return $this->email;
    }
}
