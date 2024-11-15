<?php

declare(strict_types=1);

namespace App\Controllers;

use App\Models\UserModel;
use App\Utils\Response;
use App\Utils\Session;
use App\Views\Layout;
use App\Views\View;

class UserController extends BaseController
{

    public function dashboard(): Response
    {

        $userUID = Session::get('user_id') ?? "";

        $user = (new UserModel($this->config->db))->getUserWithUID($userUID);

        return new Response(200, new View('dashboard', null, new Layout(
            'layout', placeholderValues: [
                'title' => 'Dashboard'
            ]
        ), [
            'username' => $user->username
        ]));
    }
}