<?php

use Symfony\Component\HttpClient\CurlHttpClient;
use Symfony\Component\HttpFoundation\Response;

beforeEach(function () {
    $this->client = new CurlHttpClient();
});

test('API /users корректно возвращает пользователей', function () {
    /** @var \Symfony\Contracts\HttpClient\ResponseInterface $response */
    $response = $this->client->request('GET', 'http://localhost:8000/users');

    expect($response->getStatusCode())->toBe(Response::HTTP_OK);

    $data = $response->toArray();

    expect($data)
        ->not()->toBeNull()
        ->toBeArray();

    if (is_array($data) && isset($data[0])) {
        expect($data[0])
            ->toBeArray()
            ->toHaveKey('name')
            ->toHaveKey('email');

        expect($data[0]['name'])
            ->not()->toBeEmpty()
            ->toBeString();
        expect($data[0]['email'])
            ->not()->toBeEmpty()
            ->toBeString();
    }
});
