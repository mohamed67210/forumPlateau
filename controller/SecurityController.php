<?php

namespace Controller;

use App\Session;
use App\AbstractController;
use App\ControllerInterface;
use Model\Managers\TopicManager;
use Model\Managers\PostManager;
use Model\Managers\CategoryManager;
use Model\Managers\UserManager;


class SecurityController extends AbstractController implements ControllerInterface
{
    public function index()
    {
    }

    public function addUser(){
        $userManager = new UserManager();
        return [
            "view" => VIEW_DIR . "security/register.php",
            "data" => [
                "User" => $userManager->newUser()
            ]
        ];
    }
}
