<?php
class Ticket
{
    private int $ticket_id;
    private int $user_sender_id;
    private int $admin_id;
    private string $descriptions;
    private string $media;
    private DateTime $created_datetime;
    private int $ticket_typeid;
    private string $opened;
    private string $email;

    
    public function __construct( int $user_sender_id,
     int $admin_id, string $descriptions, string $media, string $created_datetime, int $ticket_typeid,string $opened,string $email)
        {   
            $this->user_sender_id = $user_sender_id;
            $this->admin_id = $admin_id;
            $this->descriptions = $descriptions;
            $this->media = $media;
            $this->created_datetime = new DateTime($created_datetime);
            $this->ticket_typeid = $ticket_typeid;
            $this->opened = $opened;
            $this->email = $email;
            

        }
public function setTicketId(int $ticket_id)
{
    $this->ticket_id = $ticket_id;
}
public function getTicketId()
{
    return $this->ticket_id;
}
public function setTicketTypeID(int $ticket_typeid)
{

    $this->ticket_type_id = $ticket_typeid;
}
public function getTicketTypeID()
{
    return $this->ticket_typeid;
}
public function setUserSenderId(int $user_sender_id)
{
    $this->user_sender_id = $user_sender_id;
}
public function getUserSenderId()
    {
        return $this->user_sender_id; 
    }
public function setAdminId(int $admin_id)
{
    $this->admin_id = $admin_id;
}
public function getAdminId()
{
    return $this->admin_id;
}
public function setdescriptions(string $descriptions)
{
$this->descriptions = $descriptions;
}
public function getdescriptions()
{
    return $this->descriptions;
}
public function setMedia(string $media)
{
    $this->media = $media;
}
public function getMedia()
{
    return $this->media;
}
public function setCreatedDatetime(DateTime $created_datetime)
{
    $this->created_datetime = $created_datetime;
}
public function getCreatedDatetime()
{
    return $this->created_datetime;
}

public function setopened(string $opened)
{
    $this->opened = $opened;
}
public function getopened()
{
    return $this->opened;
}
public function setemail(string $email)
{
    $this->email = $email;
}
public function getemail()
{
    return $this->email;
}


}

?>