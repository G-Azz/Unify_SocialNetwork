<?php
class TicketReply
{
    private int $ticket_reply_id;
    private int $ticket_id;
    private int $user_sender_id;
    private string $media;
    private DateTime $created_datetime;

    private string $description_reply;
    public function __construct( int $ticket_id,
     int $user_sender_id, string $media, string $created_datetime, string $description_reply)
     {
         
            
            $this->ticket_id = $ticket_id;
            $this->user_sender_id = $user_sender_id;
            $this->media = $media;
            $this->created_datetime =new DateTime ($created_datetime);
            $this->description_reply = $description_reply;
     }
     
     public function setTicketReplyId(int $ticket_id)
     {
         $this->ticket_id = $ticket_id;
     }
     public function setTicketId(int $ticket_id)
     {
        $this->ticket_id = $ticket_id;
     }
     public function setUserSenderId(int $user_sender_id)
     {
        $this->user_sender_id = $user_sender_id;
     }
     public function setMedia(string $media)
     {
        $this->media = $media;
     }
     public function setCreatedDatetime(DateTime $created_datetime)
     {
        $this->created_datetime = $created_datetime;
     }
     public function setDescriptionReply(string $description_reply)
     {
        $this->description_reply = $description_reply;
     }
     public function getTicketReplyId()
     {
        return $this->ticket_reply_id;
     }
     public function getTicketId()
     {
            return $this->ticket_id;
     }
     public function getUserSenderId()
     {
        return $this->user_sender_id;
     }
     public function getMedia()
     {  
        return $this->media;
     }
     public function getCreatedDatetime()
     {
        return $this->created_datetime;
     }
     public function getDescriptionReply()
     {
            return $this->description_reply;
     }

    }
?>