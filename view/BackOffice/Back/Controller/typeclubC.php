<?php
require_once 'config.php';
class typeclubC
{

    public function listtypeclub()
    {
        $sql = "SELECT * FROM typeclub ";
        $db = config::getConnexion();
        try {
            $liste = $db->query($sql);
            return $liste;
        } catch (Exception $e) {
            die('Error:' . $e->getMessage());
        }
    }

    function deletetypeclub($id)
    {
        $sql = "DELETE FROM typeclub WHERE idType = :id";
        $db = config::getConnexion();
        $req = $db->prepare($sql);
        $req->bindValue(':id', $id);

        try {
            $req->execute();
        } catch (Exception $e) {
            die('Error:' . $e->getMessage());
        }
    }


    function addtypeclub($typeclub)
    {

        $currentDirectory = getcwd();
        $uploadDirectory = "/uploads/";
        $fileName = $_FILES['image']['name'];
        $fileTmpName  = $_FILES['image']['tmp_name'];
        $uploadPath = $currentDirectory . $uploadDirectory . basename($fileName);
            $didUpload = move_uploaded_file($fileTmpName, $uploadPath);
            $sql = "INSERT INTO typeclub(type, description,image) VALUES (:type,:description,:image)";
            $db = config::getConnexion();
            try {
                $query = $db->prepare($sql);
                $query->execute([
                    'image' => $typeclub->getImage(),
                    'type' => $typeclub->getType(),
                    'description' => $typeclub->getDescription(),
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
    function showtypeclub($id)
    {
        $sql = "SELECT * FROM typeclub where idType = $id";
        $db = config::getConnexion();
        try {
            $query = $db->prepare($sql);
            $query->execute();
            $typeclub = $query->fetch();
            return $typeclub;
        } catch (Exception $e) {
            die('Error: ' . $e->getMessage());
        }
    }

    function Recherchetypeclub($id)
    {
        $sql = "SELECT club.name, typeclub.type, typeclub.description, typeclub.image FROM typeclub INNER JOIN club ON club.idType = typeclub.idType where typeclub.idType = $id";
        $db = config::getConnexion();
        try {
            $query = $db->prepare($sql);
            $query->execute();
            $typeclub = $query->fetchAll();
            return $typeclub;
        } catch (Exception $e) {
            die('Error: ' . $e->getMessage());
        }
    }

    function updatetypeclub($typeclub, $id)
    {
        try {
            
        $currentDirectory = getcwd();
        $uploadDirectory = "/uploads/";
        $fileName = $_FILES['image']['name'];
        $fileTmpName  = $_FILES['image']['tmp_name'];
        $uploadPath = $currentDirectory . $uploadDirectory . basename($fileName);
            $didUpload = move_uploaded_file($fileTmpName, $uploadPath);
            $db = config::getConnexion();
            $query = $db->prepare('UPDATE typeclub SET  type = :type, description = :description , image = :image WHERE idType=:id');

            $query->execute([
                'id' => $id,
                'image' => $typeclub->getImage(),
                'type' => $typeclub->getType(),
                'description' => $typeclub->getDescription(),
            ]);

            echo $query->rowCount() . " records UPDATED successfully <br>";
        } catch (PDOException $e) {
            $e->getMessage();
        }
    }
}
