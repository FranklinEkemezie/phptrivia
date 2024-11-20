<?php

declare(strict_types=1);

namespace App\Controllers;

use App\Models\UserModel;
use App\Utils\Response;
use App\Utils\Session;
use App\Utils\ViewRenderer;
use App\Views\Component;
use App\Views\Layout;
use App\Views\View;

class QuizController extends BaseController
{

    public function getLeaderboard(): Response
    {

        $userUID = Session::get('user_id') ?? '';

        $user = (new UserModel($this->config->db))->getUserWithUID($userUID);


        return new Response(200, (new View(
            'dashboard', null, (new Layout(
                'main-layout', placeholderValues: ['title' => 'Leaderboard']
            ))->useStyleSheets('dashboard')
        ))->useComponent(
            new Component('dashboard/leaderboard', 'main-content', null,['username' => $user->username])
        ));    
    }

    public function getQuizzes(): Response
    {
        $userUID = Session::get('user_id') ?? '';

        $user = (new UserModel($this->config->db))->getUserWithUID($userUID);

        $userArr = [
            'name' => $user->username,
            'email' => $user->email,
            'bio' => "Some crazy bio about me!",
            'experience level' => $user->experienceLevel
        ];
        
        return new Response(
            200,
            (new View(
                'dashboard',
                null,
                (new Layout(
                    'main-layout',
                    placeholderValues: ['title' => 'Quizzes']
                ))->useStyleSheets('dashboard')
            ))->useComponent(
                new Component(
                    'dashboard/quizzes',
                    'main-content',
                    null,
                    [
                        'username' => $user->username,
                        'user' => $userArr
                    ]
                )
            )
        );

    }
}