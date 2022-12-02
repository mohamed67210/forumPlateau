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

    public function addTopic()
    {
        if (isset($_POST['submit'])) {

            $title = filter_input(INPUT_POST, 'title', FILTER_SANITIZE_SPECIAL_CHARS);
            $description = filter_input(INPUT_POST, 'description', FILTER_SANITIZE_SPECIAL_CHARS);
            $category = filter_input(INPUT_POST, 'category', FILTER_SANITIZE_SPECIAL_CHARS);
            $closed = filter_input(INPUT_POST, 'closed', FILTER_SANITIZE_SPECIAL_CHARS);
            // $array = [$title, $description, $category, $closed];
            // var_dump($array);die;

            if ($title) {
                $sql = "INSERT INTO topic VALUES('',:title,:description,NOW(),:closed,1,1)";

                try {
                    return DAO::select($sql, ['title' => $title, 'description' => $description, 'closed' => $closed]);
                } catch (\PDOException $e) {
                    echo $e->getMessage();
                    die();
                }
            }
        } else {
            die;
        }
    }
}
