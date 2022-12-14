<?php

namespace Model\Managers;

use App\Manager;
use App\DAO;

class PostManager extends Manager
{

    protected $className = "Model\Entities\Post";
    protected $tableName = "post";


    public function __construct()
    {
        parent::connect();
    }

    public function findPostbytopic($id, $order = null)
    {
        $orderQuery = ($order) ?
            "ORDER BY " . $order[0] . " " . $order[1] :
            "";
        $sql = "SELECT *
                FROM " . $this->tableName . "  WHERE topic_id = :id;
                " . $orderQuery;

        return $this->getMultipleResults(
            DAO::select($sql, ['id' => $id]),
            $this->className
        );
    }

    public function newPost($id, $userId, $message)
    {
        $postManager = new PostManager;
        if (isset($_POST['submit'])) {
            if ($message) {
                $data = ['contenue' => $message, 'user_id' => $userId, 'topic_id' => $id];
                $postManager->add($data);
            }
        }
    }

    public function findPostbyMail($id, $order = null)
    {
        // var_dump($id);die;
        $orderQuery = ($order) ?
            "ORDER BY " . $order[0] . " " . $order[1] :
            "";
        $sql = "SELECT
        *
    FROM
        post
    WHERE
        user_id = :id
       ORDER BY dateCreation DESC";
        return $this->getMultipleResults(
            DAO::select($sql, ['id' => $id]),
            $this->className
        );
    }

    public function deletePost($PostId){
        $id = $PostId;
        $postManager = new PostManager();
        $postManager->delete($id);
    }

    public function updateContenue($contenue,$postId){
        $sql = "UPDATE post SET contenue = :contenue WHERE id_post = :postId";
        return DAO::update($sql, ['contenue' => $contenue,'postId' => $postId]);
    }

    // supprimer tout les posts d'un topic
    public function deletePostsbyTopic($topicId){
        $sql = "DELETE  FROM post WHERE topic_id = :topicId ";
        return DAO::delete($sql,['topicId' => $topicId]);
    }
}
