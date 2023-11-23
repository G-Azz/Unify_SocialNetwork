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
                'Adress' => $User->getAdress(),
                'University' => $User->getUniversity(),
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

    public function updateuser($User, $id)
    {
        try {
            $db = config::getConnexion();
            $query = $db->prepare(
                'UPDATE user SET Nme = :Nme,Lname = :Lname,Email = :Email,Username = :Username,Pwd = :Pwd,Adress = :Adress,University = :University
        WHERE  Id_User = :id'
            );
            $query->execute([
                'id' => $id,
                'Nme' => $User->getName(),
                'Lname' => $User->getLname(),
                'Username' => $User->getUsername(),
                'Email' => $User->getEmail(),
                'Pwd' => $User->getPassword(),
                'Adress' => $User->getAdress(),
                'University' => $User->getUniversity(),
            ]);

            return $query->rowCount(); // Return the number of updated records
        } catch (PDOException $e) {
            // Log or handle the exception
            return 0; // Return 0 to indicate failure
        }
    }


    function showuser($id)
    {
        $sql = "SELECT * FROM user WHERE Id_User = :Id_User";
        $db = config::getConnexion();
        try {
            $query = $db->prepare($sql);
            $query->bindParam(':Id_User', $id, PDO::PARAM_INT);
            $query->execute();
            $user = $query->fetch();
            return $user;
        } catch (Exception $e) {
            die('Error: ' . $e->getMessage());
        }
    }
}
