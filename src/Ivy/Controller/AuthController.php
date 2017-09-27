<?php

namespace Ivy\Controller;

use Aya\Core\Dao;
// use Aya\Core\User;
use Aya\Helper\AuthManager;

class AuthController extends FrontController {

    public function indexAction () {
        // auto user sign in
        if ($_ENV['app'] === 'local') {
            $userEntity = Dao::entity('user');
            $user = $userEntity->getAuthenticatedUser(140);
            AuthManager::setUser($user);
            
            $this->actionForward('index', 'home', true);
            header('Location: '.BASE_URL, true, 303);
        }
    }

    public function loginAction() {
        if (AuthManager::login()) {
            $this->actionForward('index', 'home', true);
            header('Location: '.BASE_URL, true, 303);
        }
    }

    public function logoutAction() {
        AuthManager::logout();
    }
}