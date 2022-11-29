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

    public function findByCategory($order = null)
    {

        $orderQuery = ($order) ?
            "ORDER BY " . $order[0] . " " . $order[1] :
            "";

        $sql = "SELECT *
                FROM " . $this->tableName . " a INNER join category ON a.category_id = category.id_category
                " . $orderQuery;

        return $this->getMultipleResults(
            DAO::select($sql),
            $this->className
        );
    }
}
