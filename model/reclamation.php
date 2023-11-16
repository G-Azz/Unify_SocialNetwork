<?php

class Ticket
{
    private ?int $Ticket_id = null;
    private ?string $description = null;
    private ?string $reclamationMessage = null;

    public function __construct(int $Ticket_id = null, string $description, string $reclamationMessage)
    {
        $this->Ticket_id = $Ticket_id;
        $this->description = $description;
        $this->reclamationMessage = $reclamationMessage;
    }

    public function setdescription(string $description)
    {
        $this->description = $description;
        return $this;
    }

    public function setReclamationMessage(string $reclamationMessage)
    {
        $this->reclamationMessage = $reclamationMessage;
        return $this;
    }

    public function getdescription()
    {
        return $this->description;
    }

    public function getReclamationMessage()
    {
        return $this->reclamationMessage;
    }
}
?>