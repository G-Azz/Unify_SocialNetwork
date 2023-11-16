<?php
include('D:/Esprit 2eme/progs/xampp/htdocs/ss/config.php');
class UserC
{
    public function listUser()
{
    $sql = "SELECT * FROM user";
    $db = config::getConnexion();
    try {
        $liste = $db->query($sql);
        return $liste; // Fetch the data
    } catch (Exception $e) {
        die('Error:' . $e->getMessage());
    }
}


    function addUser($User)
    {
        $sql = "INSERT INTO user
VALUES (NULL, :Nme,:Lname, :Email,:Username,:Pwd,:Adress,:University)";
        $db = config::getConnexion();
        try {
            $query = $db->prepare($sql);
            $query->execute([
                'Nme' => $User->getName(),
                'Lname' => $User->getLname(),
                'Username' => $User->getUsername(),
                'Email' => $User->getEmail(),
                'Pwd' => $User->getPassword(),
                'Adress'=> $User->getAdress(),
                'University'=> $User->getUniversity(),
            ]);
        } catch (Exception $e) {
            echo 'Error: ' . $e->getMessage();
        }
    }

    function deleteUser($ide)
    {
        $sql = "DELETE FROM user WHERE Id_User = :id";
        $db = config::getConnexion();
        $req = $db->prepare($sql);
        $req->bindValue(':id', $ide);

        try {
            $req->execute();
        } catch (Exception $e) {
            die('Error:' . $e->getMessage());
        }
    }
}
