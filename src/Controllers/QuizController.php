<?php

declare(strict_types=1);

namespace App\Controllers;

use App\Utils\Response;

class QuizController extends BaseController
{

    public function getLeaderboard(): Response
    {

        return new Response(200, 'Leaderboard');
    }
}