<?php

require_once dirname(__DIR__) . '/vendor/autoload.php';

use App\UserController;
use App\UserRepository;
use Symfony\Component\Dotenv\Dotenv;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

$dotenv = new Dotenv();
$dotenv->load(dirname(__DIR__) . '/.env');

$request = Request::createFromGlobals();

$path   = $request->getPathInfo();
$method = $request->getMethod();

$controller = new UserController(new UserRepository());

switch ($path) {
    case '/':
        if ($method === 'GET')
            $response = $controller->index();
        else
            $response = new Response('Method Not Allowed', Response::HTTP_METHOD_NOT_ALLOWED);
        break;
    default:
        $response = new Response('Not Found', Response::HTTP_NOT_FOUND);
}

$response->send();
