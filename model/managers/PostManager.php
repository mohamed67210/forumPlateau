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

    public function newPost(){
        $postManager = new PostManager;
        $message = filter_input(INPUT_POST,'message',FILTER_SANITIZE_SPECIAL_CHARS);

        if(isset($_POST['submit'])){

            if($message){
                $data = ['contenue'=>$message,'user_id'=>1,'topic_id'=>1];
                $postManager->add($data);
            }
        }
    }
}
