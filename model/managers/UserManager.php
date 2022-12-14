<?php

namespace Model\Managers;

use App\Manager;
use App\DAO;

class UserManager extends Manager
{

    protected $className = "Model\Entities\User";
    protected $tableName = "user";

    public function __construct()
    {
        parent::connect();
    }


    public function CheckMail($mail)
    {
        $sql = "SELECT mail FROM user WHERE mail = :mail";
        return  DAO::select($sql, ['mail' => $mail]);
    }
    public function CheckPseudo($pseudo)
    {
        $sql = "SELECT pseudo FROM user WHERE pseudo = :pseudo";
        return  DAO::select($sql, ['pseudo' => $pseudo]);
    }
    public function addUser($mail, $pseudo, $password1, $image)
    {
        $userManager = new UserManager;
        $passwordHash = password_hash($password1, PASSWORD_DEFAULT);
        $data = ['mail' => $mail, 'pseudo' => $pseudo, 'password' => $passwordHash,'image' =>$image];
        $userManager->add($data);
    }

    public function findUserByMail($mail)
    {
        $sql = "SELECT *
                FROM " . $this->tableName . " WHERE mail = :mail ";

        return $this->getOneOrNullResult(
            DAO::select($sql, ["mail" => $mail], false),
            $this->className
        );
    }
    public function findPasswordbyMail($mail)
    {
        $sql = "SELECT password
                FROM " . $this->tableName . " WHERE mail = :mail ";

        return $this->getSingleScalarResult(
            DAO::select($sql, ["mail" => $mail]),
            $this->className
        );
    }

    // bannir user en changant la valeur de isBanish to true
    public function BannirUser($UserId)
    {
        $sql = "UPDATE user SET isBanish = 1 WHERE id_user = :userId";
        return DAO::update($sql, ['userId' => $UserId]); 
    }
    // activer le compte d'un user apres etre bannir
    public function ActiveUser($UserId){
        $sql = "UPDATE user SET isBanish = 0 WHERE id_user = :userId";
        return DAO::update($sql, ['userId' => $UserId]);
    }

    // modifier role user 
    public function updateRole($userId,$role){
        $sql = "UPDATE user SET role = :role WHERE id_user= :userId";
        return DAO::update($sql, ['role' => $role,'userId' => $userId]);

    }
}
