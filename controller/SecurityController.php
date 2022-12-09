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
    public function registerform()
    {

        $userManager = new UserManager();

        return [
            "view" => VIEW_DIR . "security/register.php",
            "data" => [
                "Users" => $userManager->findAll(["dateCreation", "DESC"])
            ]
        ];
    }
    public function addUser()
    {
        if (isset($_POST['submit'])) {


            $mail = filter_input(INPUT_POST, 'mail', FILTER_SANITIZE_SPECIAL_CHARS);
            $pseudo = filter_input(INPUT_POST, 'pseudo', FILTER_SANITIZE_SPECIAL_CHARS);
            $password1 = filter_input(INPUT_POST, 'password1', FILTER_SANITIZE_SPECIAL_CHARS);
            $password2 = filter_input(INPUT_POST, 'password2', FILTER_SANITIZE_SPECIAL_CHARS);
            // $role = filter_input(INPUT_POST, 'role', FILTER_SANITIZE_SPECIAL_CHARS);
            $userManager = new UserManager();
            // si les filtres passent 
            if ($mail && $pseudo && $password1) {
                $userManager = new UserManager();

                // si le mail n'existe pas dans la bdd
                if (!$userManager->CheckMail($mail)) {
                    //si le pseudo n'existe pas dans la bdd
                    if (!$userManager->CheckPseudo($pseudo)) {
                        //si les deux mot de passe identique
                        if ($password1 == $password2) {

                            $userManager->addUser($mail, $pseudo, $password1, $password2);
                            $this->redirectTo('loginform');
                        } else {
                            Session::addFlash('error', 'mot de passe incorrecte !');
                        }
                    } else {
                        Session::addFlash('error', 'ce Pseudo existe deja !');
                    }
                } else {
                    Session::addFlash('error', 'ce Mail existe deja !');
                }
                return ["view" => VIEW_DIR . "security/login.php"];
            }
        }
    }
    public function loginform()
    {
        return ['view' => VIEW_DIR . "security/login.php"];
    }
    public function login()
    {
        if (isset($_POST['submit'])) {
            $mail = filter_input(INPUT_POST, 'mail', FILTER_SANITIZE_SPECIAL_CHARS);
            // $password = filter_input(INPUT_POST, 'password', FILTER_SANITIZE_SPECIAL_CHARS);
            $password = $_POST['password'];


            if ($mail) {
                if ($password) {
                    $userManager = new UserManager();

                    $userMail = $userManager->findUserByMail($mail);
                    $userMdp = $userManager->findPasswordbyMail($mail);
                    // var_dump($userMdp);die;
                    // var_dump( $userMdp['password']);die;

                    if ($userMail) {
                        // var_dump($userMail);
                        // die;

                        $passwordVerify = password_verify($password, $userMdp['password']);
                        // var_dump($password);
                        // var_dump($userMdp['password']);
                        // var_dump(password_verify($password, $userMdp['password']));
                        // die;
                        if ($passwordVerify) {
                            Session::setUser($userMail);
                            Session::addFlash('success', 'vous etes connecté');
                            $this->redirectTo('home');
                        } else {
                            Session::addFlash('error', 'mot de passe incorrect !');
                            $this->redirectTo('security', 'loginform');
                        }
                    } else {
                        Session::addFlash('error', 'mail incorrect !');
                        $this->redirectTo('security', 'loginform');
                    }
                }
            }
        }
    }

    public function logout()
    {
        session_unset();
        Session::addFlash('success', 'vous etes déconnecté');

        $this->redirectTo('home');
    }

    // appeler cette fonction au moment en clique sur le bouton bannir

    public function deleteuser($UserId)
    {
        $UserId = $_GET['id'];
        $userManager = new UserManager();

        $userManager->BannirUser($UserId);
        Session::addFlash('error', 'vous venez de baniir ' . $UserId . '');

        $this->redirectTo('Home', 'users');
    }
    public function activeuser($UserId)
    {
        $UserId = $_GET['id'];
        $userManager = new UserManager();

        $userManager->ActiveUser($UserId);
        Session::addFlash("success", "vous venez d'activer le compte numero  " . $UserId . "");

        $this->redirectTo('Home', 'users');
    }

    // verrouiller ou deverouiller topics
    // verrouiller
    public function closeTopic()
    {
        $topicId = $_GET['id'];
        $topicmanager = new TopicManager();
        $topicmanager->activeTopic($topicId);
        $this->redirectTo('Forum', 'listTopics');
    }
    // deverrouiller
    public function openTopic()
    {
        $topicId = $_GET['id'];
        $topicmanager = new TopicManager();
        $topicmanager->closeTopic($topicId);
        $this->redirectTo('Forum', 'listTopics');
    }

    // supprimer message
    public function deletePost()
    {
        $TopicId = $_GET['idtopic'];
        $PostId = $_GET['idpost'];
        var_dump($PostId);
        $postmanager = new PostManager();
        $postmanager->deletePost($PostId);
        $this->redirectTo('forum', 'findPostbytopic', $TopicId);
    }
}
