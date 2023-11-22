<?php
class Club
{
    private ?int $idClub;
    private ?string $idGouvernement = null;
    private ?string $idCountry = null;
    private ?string $idCeo = null;
    private ?string $name;
    private ?string $type;
    private ?string $description;


    public function __construct($name ,$type, $description)
    {
        $this->name = $name;
        $this->type = $type;
        $this->description = $description;
    }


    public function getIdClub()
    {
        return $this->getIdClub;
    }
    public function getIdGouvernement()
    {
        return $this->idGouvernement;
    }
    public function getIdCountry()
    {
        return $this->getIdCountry;
    }
    public function getIdCeo()
    {
        return $this->getIdCeo;
    }


    public function getName()
    {
        return $this->name;
    }


    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }


    public function getType()
    {
        return $this->type;
    }


    public function setType($type)
    {
        $this->type = $type;

        return $this;
    }


    public function getDescription()
    {
        return $this->description;
    }


    public function setDescription($description)
    {
        $this->description = $description;

        return $this;
    }



}
