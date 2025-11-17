<?php

namespace App;

use Symfony\Component\HttpFoundation\Response;

class UserController
{
    public function __construct(
        private UserRepository $repo
    ) {}

    public function index(): Response
    {
        $users = $this->repo->getAll();
        ob_start();

        include dirname(__DIR__) . '/views/users.php';

        return new Response(ob_get_clean());
    }
}
