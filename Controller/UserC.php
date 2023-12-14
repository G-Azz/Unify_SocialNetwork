<?php
require_once 'C:\xampp\htdocs\Unify_SocialNetwork\Config.php';
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
    $sql = "INSERT INTO user (Nme, Lname, Email, Username, Pwd, Adress, University,classe, media) 
            VALUES (:Nme, :Lname, :Email, :Username, :Pwd, :Adress, :University ,:classe ,:media)";
    $db = config::getConnexion();
    
    try {
        $query = $db->prepare($sql);

        // Check if $User is an instance of the User class
        if ($User instanceof User) {
            $query->execute([
                'Nme' => $User->getName(),
                'Lname' => $User->getLname(),
                'Username' => $User->getUsername(),
                'Email' => $User->getEmail(),
                'Pwd' => $User->getPassword(),
                'Adress' => $User->getAdress(),
                'University' => $User->getUniversity(),
                'classe' => $User->getClasse(),
                'media' => $User->getImage(),


            ]);
        } else {
            echo 'Error: User must be an instance of User class!';
        }
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
                'UPDATE user SET Nme = :Nme,Lname = :Lname,Email = :Email,Username = :Username,Pwd = :Pwd,Adress = :Adress,University = :University,classe = :classe, media = :media
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
                'classe' => $User->getClasse(),
                'media' => $User->getImage(),
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

    public function listuserbyusername($userid)
    {
        $sql = "SELECT * FROM user WHERE Username = :userid";
        $db = config::getConnexion();
        try {
            $query = $db->prepare($sql);
            $query->bindParam(':userid', $userid, PDO::PARAM_STR);
            $query->execute();

            $liste = $query->fetchAll(PDO::FETCH_ASSOC);
            return $liste;
        } catch (Exception $e) {
            die('Error:' . $e->getMessage());
        }
    }
}
