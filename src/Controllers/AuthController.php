<?php

declare(strict_types=1);

namespace App\Controllers;

use App\Entities\User;
use App\Models\UserModel;
use App\Utils\FlashMessage;
use App\Utils\FormValidator;
use App\Utils\MessageFlasher;
use App\Utils\Redirector;
use App\Utils\Response;

class AuthController extends BaseController
{

    public function displayLogin(): Response
    {
        echo 'Display login form';

        prettyPrint($this->request->GET);
        echo $this->request->method, '<br/>';
        echo $this->request->path, '<br/>';

        echo MessageFlasher::flash('login', $this->request->path) ?? "Route not allowed for flashing";

        return new Response(200, "");
    }

    public function login(): Response
    {
        echo 'Logging in...';

        prettyPrint($this->request->POST);
        echo $this->request->method, '<br/>';
        echo $this->request->path, '<br/>';

        return new Response(200, "");
    }

    public function displaySignup(): Response
    {
        echo 'Display sign up form';

        prettyPrint($this->request->GET);
        echo $this->request->method, '<br/>';
        echo $this->request->path, '<br/>';

        MessageFlasher::register('login', 'Registration successful');

        (new Redirector())('/login');
        
        return new Response(200, "");
    }

    public function signup(): Response
    {
        // Get form data and perform validation
        $formData = $this->request->POST;

        $username = $formData['username'] ?? null;
        if (($username_validation = FormValidator::validateUsername($username))['error']) {
            echo $username_validation['message'];
        }

        $email = $formData['email'] ?? null;
        if (($email_validation = FormValidator::validateEmail($email))['error']) {
            echo $email_validation['message'];
        }

        $experienceLevel = (int) ($formData['experience_level'] ?? "1");
        if (($experienceLevel_validation = FormValidator::validateExperienceLevel($experienceLevel))['error']) {
            echo $experienceLevel_validation['message'];
        }

        $uid = User::getUID();

        // Create a new user
        $user = new User($uid, $username, $email, $experienceLevel);

        // Initiate a User Model to handle the signup
        $userModel = new UserModel($this->config->db);

        if (($userID = $userModel->register($user)) !== false) {

            // Flash message
            FlashMessage::flash('registration-success', 'Registration successful!', '/');

            // Redirect to the home page
            Redirector::redirect('/');
        }

        // Login user in: Redirect to login


        return new Response(200, "Registration Successful! <br/> User ID: $userID");
    }


}