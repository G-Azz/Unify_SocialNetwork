<?php
require_once 'config.php';
class EtudiantC
{

    public function RegisterEtud($Etudiant)
    {
        $sql = "INSERT INTO registration(firstName, lastName, gender, email, password) VALUES (:firstName, :lastName, :gender, :email, :password)";
        $db = config::getConnexion();
        try {
            $query = $db->prepare($sql);
            $query->execute([
                'firstName' => $Etudiant->getFirstname(),
                'lastName' => $Etudiant->getLastname(),
                'gender' => $Etudiant->getGender(),
                'email' => $Etudiant->getEmail(),
                'password' => $Etudiant->getPassword() 
            ]);
        } catch (Exception $e) {
            die('Error:' . $e->getMessage());
        }
    }

    public function Login($Etudiant)
    {
        if (isset($_POST['login'])) {
            $db = config::getConnexion();
            $sql = "SELECT * FROM registration WHERE email = ? AND password = ?";
            $query = $db->prepare($sql);
            $query->execute(array($_POST['email'], $_POST['password'])); 
            $row = $query->rowCount();
            $fetch = $query->fetch();
            if ($row > 0) {
                return $fetch;
            } else {
                return false;
            }
        }
    }
}
