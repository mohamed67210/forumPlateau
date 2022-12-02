<?php

namespace Controller;

use App\Session;
use App\AbstractController;
use App\ControllerInterface;
use Model\Managers\TopicManager;
use Model\Managers\PostManager;
use Model\Managers\CategoryManager;
use Model\Managers\UserManager;


class ForumController extends AbstractController implements ControllerInterface
{

    public function index()
    {
    }

    // les methodes pour afficher 
    public function listCategorys()
    {
        $categoryManager = new CategoryManager();

        return [
            "view" => VIEW_DIR . "forum/listCategorys.php",
            "data" => [
                "categorys" => $categoryManager->findAll(["nomCategory", "DESC"])
            ]
        ];
    }

    public function listTopics()
    {
        $topicManager = new TopicManager();

        return [
            "view" => VIEW_DIR . "forum/listTopics.php",
            "data" => [
                "topics" => $topicManager->findAll(["creationdate", "DESC"])
            ]
        ];
    }

    public function listTopicsByCategory()
    {
        $topicManager = new TopicManager();

        return [
            "view" => VIEW_DIR . "forum/listTopics.php",
            "data" => [
                "topics" => $topicManager->findByCategory(["category_id", "DESC"])
            ]
        ];
    }

    public function listUsers()
    {
        $userManager = new UserManager();

        return [
            "view" => VIEW_DIR . "forum/listUsers.php",
            "data" => [
                "users" => $userManager->findAll(["dateCreation", "DESC"])
            ]
        ];
    }

    public function findPostbytopic($id)
    {
        $PostManager = new PostManager();

        return [
            "view" => VIEW_DIR . "forum/listPosts.php",
            "data" => [
                "posts" => $PostManager->findPostbytopic($id)
            ]
        ];
    }

    public function findTopicsbyCat($id)
    {
        $topicManager = new TopicManager();

        return [
            "view" => VIEW_DIR . "forum/listTopics.php",
            "data" => [
                "topics" => $topicManager->findByCategory($id)
            ]
        ];
    }

    // partie ajout 
    public function addTopic()
    {
        $topicManager = new TopicManager;
        return [
            "view" => VIEW_DIR . "forum/listTopics.php",
            "data" => [
                "topics" => $topicManager->addTopic()
            ]
        ];
    }
}
