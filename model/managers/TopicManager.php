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
        $sql = "SELECT *
                FROM " . $this->tableName . " WHERE category_id = :id ";

        return $this->getMultipleResults(
            DAO::select($sql, ["id" => $id]),
            $this->className
        );
    }
    // fonction ajouter topic avc la fonction add dans manager 
    public function addTopic($title, $message, $category, $user)
    {
        $topicManager = new topicManager;
        $postManager = new PostManager;
        // $data contient tt ce qu'on veut inserer dans la bdd
        $data = ['title' => $title, 'closed' => '0', 'category_id' => $category, 'user_id' => $user];
        if ($title && $message) {
            // on attribue ala variable last l'execution de la fonction add qui se trouve dans manager 
            // $last nous retourn le dernier topic inserer dans la base de donnee (on aura besoins par la suite pour l'insertion d'un message)
            $last = $topicManager->add($data);
            // var_dump($last);
            $data = ['contenue' => $message, 'user_id' => $user, 'topic_id' => $last];
            $postManager->add($data);
        }
    }

    public function findTopicbyMail($id, $order = null)
    {
        // var_dump($id);die;
        $orderQuery = ($order) ?
            "ORDER BY " . $order[0] . " " . $order[1] :
            "";
        $sql = "SELECT
        *
        FROM
        " . $this->tableName . "
        WHERE
        user_id = :id
        " . $orderQuery;
        return $this->getMultipleResults(
            DAO::select($sql, ['id' => $id]),
            $this->className
        );
    }

    public function activeTopic($topicId){
        $sql = "UPDATE topic SET closed = 0 WHERE id_topic = :topicId";
        return DAO::delete($sql, ['topicId' => $topicId]);
    }

    public function closeTopic($topicId){
        $sql = "UPDATE topic SET closed = 1 WHERE id_topic = :topicId";
        return DAO::delete($sql, ['topicId' => $topicId]);
    }
}
