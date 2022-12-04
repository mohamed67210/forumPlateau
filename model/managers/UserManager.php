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
    public function findUserByEmail($mail)
    {
        $sql = "SELECT *
                FROM " . $this->tableName . " WHERE mail = :mail ";

        return $this->getMultipleResults(
            DAO::select($sql, ["id" => $mail]),
            $this->className
        );
    }
    public function newUser()
    {

        $userManager = new UserManager;
        // $findUser = $userManager->findAll();
        if (isset($_POST['submit'])) {
            $mail = filter_input(INPUT_POST, 'mail', FILTER_SANITIZE_SPECIAL_CHARS);
            $pseudo = filter_input(INPUT_POST, 'pseudo', FILTER_SANITIZE_SPECIAL_CHARS);
            $password1 = filter_input(INPUT_POST, 'password1', FILTER_SANITIZE_SPECIAL_CHARS);
            $password2 = filter_input(INPUT_POST, 'password2', FILTER_SANITIZE_SPECIAL_CHARS);
            $role = filter_input(INPUT_POST, 'role', FILTER_SANITIZE_SPECIAL_CHARS);
            // on verifie si les deux mdp inserer par l'user sont identique ou pas 
            if ($password1 === $password2) {
                // requete pour voir si le mail inserer existe deja ou pas 
                // $sql = "SELECT mail FROM user WHERE mail = :mail";
                // return $mailveirify = DAO::select($sql, ['mail' => $mail]);
                // var_dump($mailveirify);die;
                // if (!empty($mailveirify)) {
                    $passwordHash = password_hash($password1, PASSWORD_DEFAULT);
                    $data = ['mail' => $mail, 'pseudo' => $pseudo, 'password' => $passwordHash, 'role' => $role];

                    // var_dump($passwordHash);
                    // die;
                    $userManager->add($data);
                // }
            } else {
                echo 'les deux mot de passe ne sont pas identique';
            }
        }
    }
}
