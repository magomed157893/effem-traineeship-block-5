<?php

namespace App;

interface UserRepositoryInterface
{
    public function findUserByEmail(string $email): ?User;
}
