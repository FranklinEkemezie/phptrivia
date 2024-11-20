<?php

declare(strict_types=1);

namespace App\Controllers;

use App\Models\UserModel;
use App\Utils\Response;
use App\Utils\Session;
use App\Views\Component;
use App\Views\Layout;
use App\Views\View;

class UserController extends BaseController
{

    public function dashboard(): Response
    {

        $userUID = Session::get('user_id') ?? '';

        $user = (new UserModel($this->config->db))->getUserWithUID($userUID);



        return new Response(200, (new View(
            'dashboard', null, (new Layout(
                'main-layout', placeholderValues: ['title' => 'Dashboard']
            ))->useStyleSheets('dashboard', 'def', 'forms', 'process')
        ))->useComponent(
            new Component('dashboard/dashboard', 'main-content', placeholderValues: ['username' => $user->username])
        ));


    }

    public function profile(): Response
    {

        $userUID = Session::get('user_id') ?? '';

        $user = (new UserModel($this->config->db))->getUserWithUID($userUID);

        return new Response(200, (new View(
            'dashboard', null, (new Layout(
                'main-layout', placeholderValues: ['title' => 'Dashboard']
            ))->useStyleSheets('dashboard')
        ))->useComponent(
            new Component('dashboard/profile', 'main-content',
            placeholderValues: [
                'username'  => $user->username,
                'email'     => $user->email,
                'experience_level'=>$user->experienceLevel
            ])
        ));

    }
}