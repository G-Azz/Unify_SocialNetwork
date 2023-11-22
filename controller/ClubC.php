<?php
require_once '../config.php';
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
        $sql = "INSERT INTO club(name, type, description) VALUES (:name,:type,:description)";
        $db = config::getConnexion();
        try {
            $query = $db->prepare($sql);
            $query->execute([
                'name' => $club->getName(),
                'type' => $club->getType(),
                'description' => $club->getDescription(),   
            ]);
        } catch (Exception $e) {
            echo 'Error: ' . $e->getMessage();
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
            $db = config::getConnexion();
            $query = $db->prepare('UPDATE club SET name = :name, type = :type, description = :description WHERE idClub=:id');
            
            $query->execute([
                'id' => $id,
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
