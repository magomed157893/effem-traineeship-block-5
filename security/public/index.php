<?php

require_once dirname(__DIR__) . '/vendor/autoload.php';

use App\FormController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

session_set_cookie_params([
    'lifetime' => 0,
    'path'     => '/',
    'secure'   => false, // Только HTTPS
    'httponly' => true,
    'samesite' => 'Strict'
]);

session_start();

$request = Request::createFromGlobals();

$path = $request->getPathInfo();
$method = $request->getMethod();

$controller = new FormController();

switch ($path) {
    case '/':
        if ($method === 'GET')
            $response = $controller->show($request);
        else
            $response = new Response('Method Not Allowed', Response::HTTP_METHOD_NOT_ALLOWED);
        break;
    case '/submit':
        if ($method === 'POST')
            $response = $controller->handle($request);
        else
            $response = new Response('Method Not Allowed', Response::HTTP_METHOD_NOT_ALLOWED);
        break;
    default:
        $response = new Response('Not Found', Response::HTTP_NOT_FOUND);
}

$response->send();
