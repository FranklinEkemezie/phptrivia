<?php

declare(strict_types=1);

namespace App\Controllers;

use App\Models\UserModel;
use App\Utils\Response;
use App\Utils\Session;
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
            'dashboard', null, new Layout(
                'main-layout', placeholderValues: ['title' => 'Dashboard']
            )
        ))->useComponent(
            new Component('dashboard/leaderboard', 'main-content', placeholderValues: ['username' => $user->username])
        ));    
    }
}