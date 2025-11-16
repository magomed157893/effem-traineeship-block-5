<?php

use App\User;

test('User объект создается корректно', function () {
    $user = new User();

    expect($user)->toBeInstanceOf(User::class);
});

test('User корректно возвращает имя', function () {
    $user = new User('John Jones', 'johnjones@mail.net');

    expect($user->getName())->toBe('John Jones');
});

test('User корректно возвращает почту', function () {
    $user = new User('John Jones', 'johnjones@mail.net');

    expect($user->getEmail())->toBe('johnjones@mail.net');
});
