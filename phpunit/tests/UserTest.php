<?php

namespace App\Tests;

use App\User;
use PHPUnit\Framework\TestCase;

class UserTest extends TestCase
{
    public function testUserCanBeCreated(): void
    {
        $user = new User();

        $this->assertInstanceOf(User::class, $user);
    }

    public function testUserName(): void
    {
        $user = new User('John Jones', 'johnjones@mail.net');

        $this->assertEquals('John Jones', $user->getName());
    }

    public function testUserEmail(): void
    {
        $user = new User('John Jones', 'johnjones@mail.net');

        $this->assertEquals('johnjones@mail.net', $user->getEmail());
    }
}
