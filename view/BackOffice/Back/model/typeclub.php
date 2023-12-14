<?php
class typeclub
{
    private ?int $idType;
    private ?string $type;
    private ?string $description;
    private ?string $image;


    public function __construct($type, $description,$image)
    {
        $this->image = $image;
        $this->type = $type;
        $this->description = $description;
    }


    public function getIdType()
    {
        return $this->getIdType;
    }
   


    public function getType()
    {
        return $this->type;
    }
    public function getImage()
    {
        return $this->image;
    }
    public function setImage($image)
    {
        $this->image = $image;

        return $this;
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
