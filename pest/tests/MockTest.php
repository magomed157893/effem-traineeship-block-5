<?php

use App\User;
use App\UserRepositoryInterface;

test('Успешно находит пользователя по почте', function () {
    $userRepositoryMock = $this->createMock(UserRepositoryInterface::class);

    $email = 'johnjones@mail.net';
    $user = new User('John Jones', $email);

    $userRepositoryMock
        ->method('findUserByEmail')
        ->with($email)
        ->willReturn($user);

    $result = $userRepositoryMock->findUserByEmail($email);

    expect($result)->toBeInstanceOf(User::class);
    expect($result)->toBe($user);
});

test('Корректно возвращает null, если пользователь не найден', function () {
    $userRepositoryMock = $this->createMock(UserRepositoryInterface::class);

    $email = 'johnjones@mail.net';
    $user = new User('John Jones');

    $userRepositoryMock
        ->method('findUserByEmail')
        ->with($email)
        ->willReturn(null);

    $result = $userRepositoryMock->findUserByEmail($email);

    expect($result)->toBeNull();
    expect($result)->not->toBe($user);
});
