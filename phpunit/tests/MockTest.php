<?php

namespace App\Tests;

use App\User;
use App\UserRepositoryInterface;
use PHPUnit\Framework\TestCase;

class MockTest extends TestCase
{
    public function testFindUserByEmailReturnUser(): void
    {
        $userRepositoryMock = $this->createMock(UserRepositoryInterface::class);

        $email = 'johnjones@mail.net';
        $user = new User('John Jones', $email);

        $userRepositoryMock
            ->method('findUserByEmail')
            ->with($email)
            ->willReturn($user);

        $result = $userRepositoryMock->findUserByEmail($email);

        $this->assertInstanceOf(User::class, $result);
        $this->assertSame($user, $result);
    }

    public function testFindUserByEmailReturnNull(): void
    {
        $userRepositoryMock = $this->createMock(UserRepositoryInterface::class);

        $email = 'johnjones@mail.net';
        $user = new User('John Jones');

        $userRepositoryMock
            ->method('findUserByEmail')
            ->with($email)
            ->willReturn(null);

        $result = $userRepositoryMock->findUserByEmail($email);

        $this->assertNull($result);
        $this->assertNotSame($user, $result);
    }
}
