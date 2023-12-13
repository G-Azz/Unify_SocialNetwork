<?php
class User
{
    private ?int $Id_User = null;
    private ?string $Nme = null;
    private ?string $Lname = null;

    private ?string $Email = null;

    private ?string $Username = null;

    private ?string $Pwd = null;

    private ?string $Adress = null;

    private ?string $University = null;

    private ?string $classe = null;

    private ?string $media = null;

    

    public function __construct($Id_User, $Nme, $Lname, $Email, $Username, $Pwd, $Adress, $University, $classe, $media)
    {
        $this->Id_User = $Id_User;
        $this->Nme = $Nme;
        $this->Lname = $Lname;
        $this->Email = $Email;
        $this->Username = $Username;
        $this->Pwd = $Pwd;
        $this->Adress = $Adress;
        $this->University = $University;
        $this->classe = $classe;
        $this->media = $media;
        

   
    }

    


    public function getIdUser()
    {
        return $this->Id_User;
    }
    
    public function getName()
    {
        return $this->Nme;
    }

    public function getLname()
    {
        return $this->Lname;
    }

    public function getEmail()
    {
        return $this->Email;
    }

    public function getUsername()
    {
        return $this->Username;
    }

    public function getPassword()
    {
        return $this->Pwd;
    }

    public function getAdress()
    {
        return $this->Adress;
    }

    public function getUniversity()
    {
        return $this->University;
    }

    public function getClasse()
    {
        return $this->classe;
    }

    public function getImage()
    {
        return $this->media;
    }

    public function setIdUser($Id_User)
    {
        $this->Id_User = $Id_User;

    }

    public function setName($Nme)
    {
        $this->Nme = $Nme;

    }

    public function setLname($Lname)
    {
        $this->Lname = $Lname;

    }

    public function setEmail($Email)
    {
        $this->Email = $Email;

    }

    public function setUsername($Username)
    {
        $this->Username = $Username;

    }

    public function setPassword($Pwd)
    {
        $this->Pwd = $Pwd;

    }

    public function setAdress($Adress)
    {
        $this->Adress = $Adress;

     
    }

    public function setUniversity($University)
    {
        $this->University = $University;

        return $this;
    }
    
    

    public function setClasse($classe)
    {
        $this->classe = $classe;

        
    }

    public function setImage($media)
    {
        $this->media = $media;

        
    }
    
    
}
