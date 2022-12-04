<?php

namespace Model\Managers;

use App\Manager;
use App\DAO;

class TopicManager extends Manager
{

    protected $className = "Model\Entities\Topic";
    protected $tableName = "topic";


    public function __construct()
    {
        parent::connect();
    }

    public function findByCategory($id)
    {

        // $orderQuery = ($order) ?
        //     "ORDER BY " . $order[0] . " " . $order[1] :
        //     "";

        $sql = "SELECT *
                FROM " . $this->tableName . " WHERE category_id = :id ";

        return $this->getMultipleResults(
            DAO::select($sql, ["id" => $id]),
            $this->className
        );
    }
    // fonction ajouter topic avc la fonction add dans manager 
    public function addTopictest()
    {
        $topicManager = new topicManager;
        $postManager = new PostManager;
        if (isset($_POST['submit'])) {

            $title = filter_input(INPUT_POST, 'title', FILTER_SANITIZE_SPECIAL_CHARS);
            $message = filter_input(INPUT_POST, 'message', FILTER_SANITIZE_SPECIAL_CHARS);
            $category = filter_input(INPUT_POST,'category',FILTER_SANITIZE_SPECIAL_CHARS);
            // $data contient tt ce qu'on veut inserer dans la bdd
            $data = ['title' => $title, 'closed' => '0', 'category_id' => $category, 'user_id' => '1'];

            if ($title && $message) {
                // on attribue ala variable last l'execution de la fonction add qui se trouve dans manager 
                // $last nous retourn le dernier topic inserer dans la base de donnee (on aura besoins par la suite pour l'insertion d'un message)
                $last = $topicManager->add($data);
                // var_dump($last);

                $data = ['contenue' => $message, 'user_id' => 1, 'topic_id' => $last];
                $postManager->add($data);
            }
        } else {
            echo 'erreur';
            die;
        }
    }
    // fonction personnaliser pour ajouter nouveau topic
    // public function addTopic()
    // {
    //     if (isset($_POST['submit'])) {

    //         $title = filter_input(INPUT_POST, 'title', FILTER_SANITIZE_SPECIAL_CHARS);
    //         $message = filter_input(INPUT_POST, 'message', FILTER_SANITIZE_SPECIAL_CHARS);
    //         $category = filter_input(INPUT_POST, 'category', FILTER_SANITIZE_SPECIAL_CHARS);
    //         $closed = filter_input(INPUT_POST, 'closed', FILTER_SANITIZE_SPECIAL_CHARS);
    //         // $array = [$title, $description, $category, $closed];
    //         // var_dump($array);die;

    //         if ($title) {
    //             $sql = "INSERT INTO topic VALUES('',:title,'',NOW(),:closed,1,1)";

    //             try {
    //                 return DAO::select($sql, ['title' => $title, 'closed' => $closed]);
    //             } catch (\PDOException $e) {
    //                 echo $e->getMessage();
    //                 die();
    //             }
    //         }
    //     } else {
    //         echo 'erreur';
    //         die;
    //     }
    // }
}
