<?php

namespace Controller;

use App\Session;
use App\AbstractController;
use App\ControllerInterface;
use Model\Entities\Category;
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
        $topicManager = new TopicManager();
        return [
            "view" => VIEW_DIR . "forum/listPosts.php",
            "data" => [
                "posts" => $PostManager->findPostbytopic($id),
                "topics" => $topicManager->findOneById($id)
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
        if (isset($_POST['submit'])) {

            $title = filter_input(INPUT_POST, 'title', FILTER_SANITIZE_SPECIAL_CHARS);
            $message = filter_input(INPUT_POST, 'message', FILTER_SANITIZE_SPECIAL_CHARS);
            $category = filter_input(INPUT_POST, 'category', FILTER_SANITIZE_SPECIAL_CHARS);
            $user = filter_input(INPUT_GET, 'user', FILTER_SANITIZE_SPECIAL_CHARS);

            $topicManager = new TopicManager;
            $topicManager->addTopic($title, $message, $category, $user);
            $this->redirectTo('forum', 'listTopics');
        }
    }
    // ajout post on appel la fonction newPost dans postmenager
    public function addPost()
    {
        if (isset($_GET['id'])) {
            $id = $_GET['id'];
        }
        $userId = filter_input(INPUT_GET, 'user', FILTER_SANITIZE_SPECIAL_CHARS);
        $message = filter_input(INPUT_POST, 'message', FILTER_SANITIZE_SPECIAL_CHARS);
        // var_dump($userId);die;

        $PostManager = new PostManager;
        $PostManager->newPost($id, $userId, $message);
        Session::addFlash('success', 'votre sujete st bien ajouté !');
        $this->redirectTo('forum', 'findPostbytopic', $id);
    }

    public function viewProfile()
    {
        return [
            "view" => VIEW_DIR . "forum/viewProfile.php"
        ];
    }
}
