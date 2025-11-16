<?php

require_once dirname(__DIR__) . '/vendor/autoload.php';

use App\User;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

$request = Request::createFromGlobals();

$users = [
    new User('Tom Aspinall', 'tomaspinall@mail.net'),
    new User('Alex Pereira', 'alexpereira@mail.net'),
    new User('Khamzat Chimaev', 'khamzatchimaev@mail.net'),
    new User('Islam Makhachev', 'islammakhachev@mail.net'),
    new User('Ilia Topuria', 'iliatopuria@mail.net'),
    new User('Alexander Volkanovski', 'alexandervolkanovski@mail.net'),
    new User('Merab Dvalishvili', 'merabdvalishvili@mail.net'),
    new User('Alexandre Pantoja', 'alexandrepantoja@mail.net')
];

switch ($request->getPathInfo()) {
    case '/users':
        $response = new JsonResponse($users);
        break;
    default:
        $response = new Response('Not Found', Response::HTTP_NOT_FOUND);
}

$response->send();
