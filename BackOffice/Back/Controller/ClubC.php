<?php
require_once 'config.php';
class ClubC
{

    public function listClub()
    {
        $sql = "SELECT * FROM club ";
        $db = config::getConnexion();
        try {
            $liste = $db->query($sql);
            return $liste;
        } catch (Exception $e) {
            die('Error:' . $e->getMessage());
        }
    }

    function deleteClub($ide)
    {
        $sql = "DELETE FROM club WHERE idClub = :id";
        $db = config::getConnexion();
        $req = $db->prepare($sql);
        $req->bindValue(':id', $ide);

        try {
            $req->execute();
        } catch (Exception $e) {
            die('Error:' . $e->getMessage());
        }
    }


    function addClub($club)
    {
        $currentDirectory = getcwd();
        $uploadDirectory = "/uploads/";
        $fileName = $_FILES['image']['name'];
        $fileTmpName  = $_FILES['image']['tmp_name'];
        $uploadPath = $currentDirectory . $uploadDirectory . basename($fileName);
            $didUpload = move_uploaded_file($fileTmpName, $uploadPath);
        $sql = "INSERT INTO club(name, type, description,image) VALUES (:name,:type,:description,:image)";
        $db = config::getConnexion();
        try {
            $query = $db->prepare($sql);
            $query->execute([
                'image' => $club->getImage(),
                'name' => $club->getName(),
                'type' => $club->getType(),
                'description' => $club->getDescription(),   
            ]);
        } catch (Exception $e) {
            echo 'Error: ' . $e->getMessage();
        }
        if ($didUpload) {
            echo "The file " . basename($fileName) . " has been uploaded";
          } else {
            echo $errors;
          }
    }


    function showClub($id)
    {
        $sql = "SELECT * from club where idClub = $id";
        $db = config::getConnexion();
        try {
            $query = $db->prepare($sql);
            $query->execute();
            $club = $query->fetch();
            return $club;
        } catch (Exception $e) {
            die('Error: ' . $e->getMessage());
        }
    }

    function updateClub($club, $id)
    {   
        try {
            $currentDirectory = getcwd();
            $uploadDirectory = "/uploads/";
            $fileName = $_FILES['image']['name'];
            $fileTmpName  = $_FILES['image']['tmp_name'];
            $uploadPath = $currentDirectory . $uploadDirectory . basename($fileName);
                $didUpload = move_uploaded_file($fileTmpName, $uploadPath);
            $db = config::getConnexion();
            $query = $db->prepare('UPDATE club SET name = :name, type = :type, description = :description ,image = :image WHERE idClub=:id');
            
            $query->execute([
                'id' => $id,
                'image' => $club->getImage(),
                'name' => $club->getName(),
                'type' => $club->getType(),
                'description' => $club->getDescription(),
            ]);
            
            echo $query->rowCount() . " records UPDATED successfully <br>";
        } catch (PDOException $e) {
            $e->getMessage();
        }
    }
}
