<?php

namespace App;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class FormController
{
    public function show(Request $request): Response
    {
        if (empty($_SESSION['csrf_token'])) {
            $_SESSION['csrf_token'] = bin2hex(random_bytes(32));
        }

        $token = $_SESSION['csrf_token'];

        $template = "
            <h1 style=\"margin: 8px 0; padding: 8px;\">
                Форма пользователя
            </h1>
            <form action=\"/submit\" method=\"POST\">
                <div style=\"padding: 8px;\">
                    <label>
                        <strong>Имя:</strong>
                        <input type=\"text\" name=\"name\" />
                    </label>
                </div>
                <div style=\"padding: 8px;\">
                    <label>
                        <strong>Почта:</strong>
                        <input type=\"email\" name=\"email\" />
                    </label>
                </div>
                <input type=\"hidden\" name=\"csrf\" value=\"$token\" />
                <div style=\"padding: 8px;\">
                    <button type=\"submit\">
                        Отправить
                    </button>
                </div>
            </form>
        ";

        return new Response($template);
    }

    public function handle(Request $request): Response
    {
        $token = $request->request->get('csrf');

        if (!$token || $token !== ($_SESSION['csrf_token'] ?? null)) {
            return new Response("
                <h1 style=\"margin: 8px 0; padding: 8px;\">
                    CSRF Проверка провалена
                </h1>
                <p style=\"margin: 8px 0; padding: 8px;\">
                    <strong>Токен</strong> не совпадает или отсутствует.
                </p>
                <p style=\"margin: 8px 0; padding: 8px;\">
                    <a href=\"/\">
                        Вернуться назад
                    </a>
                </p>
            ", Response::HTTP_BAD_REQUEST);
        }

        $name  = htmlspecialchars($request->request->get('name'), ENT_QUOTES | ENT_SUBSTITUTE, 'UTF-8');
        $email = htmlspecialchars($request->request->get('email'), ENT_QUOTES | ENT_SUBSTITUTE, 'UTF-8');

        $template = "
            <div>
                <h1 style=\"margin: 8px 0; padding: 8px;\">
                    Ответ
                </h1>
                <div style=\"padding: 8px;\">
                    <span>
                        Ваше имя: <strong>$name</strong>
                    </span>
                </div>
                <div style=\"padding: 8px;\">
                    <span>
                        Ваша почта: <strong>$email</strong>
                    </span>
                </div>
                <p style=\"margin: 8px 0; padding: 8px;\">
                    <a href=\"/\" rel=\"nofollow\">
                        Вернуться назад
                    </a>
                </p>
            </div>
        ";

        session_regenerate_id(true);

        return new Response($template);
    }
}
