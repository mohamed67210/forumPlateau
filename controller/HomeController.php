<?php

namespace Controller;

use App\Session;
use App\AbstractController;
use App\ControllerInterface;
use Model\Managers\UserManager;
use Model\Managers\TopicManager;
use Model\Managers\PostManager;

class HomeController extends AbstractController implements ControllerInterface
{

    public function index()
    {


        return [
            "view" => VIEW_DIR . "home.php"
        ];
    }



    public function users()
    {
        $this->restrictTo("admin");

        $manager = new UserManager();
        $users = $manager->findAll(['dateCreation', 'DESC']);

        return [
            "view" => VIEW_DIR . "security/users.php",
            "data" => [
                "users" => $users
            ]
        ];
    }

    public function addCategory()
    {
        $this->restrictTo("admin");
        return [
            "view" => VIEW_DIR . "forum/listCategorys.php"
        ];
    }

    public function forumRules()
    {

        return [
            "view" => VIEW_DIR . "rules.php"
        ];
    }

    /*public function ajax(){
            $nb = $_GET['nb'];
            $nb++;
            include(VIEW_DIR."ajax.php");
        }*/
}
