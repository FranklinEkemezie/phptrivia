<?php

declare(strict_types=1);

namespace App\Controllers;

use App\Entities\User;
use App\Models\UserModel;
use App\Utils\FlashMessage;
use App\Utils\FormValidator;
use App\Utils\Redirector;
use App\Utils\RequestPortal;
use App\Utils\Response;
use App\Views\Layout;
use App\Views\View;

class AuthController extends BaseController
{

    public function getLogin(): Response
    {

        return new Response(
            200,
            new View('login', null, 
            new Layout('layout', placeholderValues: [
                        'title' => 'Login'
                    ]
                )
            )
        );
    }

    public function login(): Response
    {
        echo 'Logging in...';

        prettyPrint($this->request->POST);
        echo $this->request->method, '<br/>';
        echo $this->request->path, '<br/>';

        return new Response(200, "");
    }

    public function getSignup(): Response
    {

        // Get the error info
        $signupErrorInfo = RequestPortal::catch('signup-error', $this->request->path) ?? [];
        $signupFormData  = RequestPortal::catch('signup-data', $this->request->path) ?? [];
        
        return new Response(200, 
        (new View('signup', null, 
            new Layout('layout', placeholderValues: [
                'title' => 'Signup'
            ]), array_merge($signupErrorInfo, $signupFormData)))
        );
    }

    public function signup(): Response
    {
        // Get form data and perform validation
        $formData = $this->request->POST;

        $formData = [
            'username'  => $formData['username'] ?? '',
            'email'     => $formData['email'] ?? '',
            'password'  => $formData['password'] ?? '',
            'password-confirm'  => $formData['password-confirm'] ?? '',
            'experience-level'  => (int) $formData['experience-level'] ?? ''
        ];

        $formData['password-confirm'] = [
            $formData['password'],
            $formData['password-confirm']
        ];

        $validationResult = FormValidator::validateAll($formData);
        if(! empty($validationResult)) {
    
            FlashMessage::flash(new FlashMessage('signup-error', 'Registration failed', '/signup', 'danger'));

            $signupError = [];
            foreach($validationResult as $field => $message) {
                $signupError["$field-error"] = $message;
            }

            RequestPortal::throw('signup-error', $signupError, '/signup');
            RequestPortal::throw('signup-data', [
                'username'  => $formData['username'],
                'email'     => $formData['email']
            ], '/signup');

            // Redirect to the home page
            Redirector::redirect('/signup');
        }

        // Go on with form registration
        $username   = $formData['username'];
        $email      = $formData['email'];
        $password   = $formData['password'];
        $user_uid   = User::getUID();
        $experienceLevel = $formData['experience-level'];

        // Create a new User
        $user = new User($user_uid, $username, $email, $password, $experienceLevel);

        // Get the user model to handle the signup
        $userModel = new UserModel($this->config->db);
        if (($userID = $userModel->register($user)) !== false) {

            // Flash message
            FlashMessage::flash(new FlashMessage('registration-success', "Registration successful. Your ID is $userID", '/login', 'success'));

            // Redirect to the login page
            Redirector::redirect('/login');

        } else {
            // Flash message
            FlashMessage::flash(new FlashMessage('registration-failed', "Something went wrong", '/', 'danger'));

            // Redirect to the home page
            Redirector::redirect('/');
        }

        exit;
    }


}