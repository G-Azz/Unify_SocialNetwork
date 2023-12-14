<?php

class Comment {
    private int $comment_id;
    private int $post_id; // The ID of the post this comment is associated with
    private int $created_by_user_id; // The ID of the user who created the comment
    private string $comment_content; // The content of the comment
    private ?int $replied_to_comment_id; // ID of the comment this is a reply to (if any)
    private DateTime $dateTime_Creation;
    private ?string $media; // Associated media (if any)

    public function __construct(int $post_id, int $created_by_user_id, string $comment_content, ?int $replied_to_comment_id, string $createtime, ?string $media = null) {
        $this->post_id = $post_id;
        $this->created_by_user_id = $created_by_user_id;
        $this->comment_content = $comment_content;
        $this->replied_to_comment_id = $replied_to_comment_id;
        $this->dateTime_Creation = new DateTime($createtime);
        $this->media = $media;
    }
    

    // Getters
    public function getCommentId(): int {
        return $this->comment_id;
    }

    public function getPostId(): int {
        return $this->post_id;
    }

    public function getCreatedByUserId(): int {
        return $this->created_by_user_id;
    }

    public function getCommentContent(): string {
        return $this->comment_content;
    }

    public function getRepliedToCommentId(): ?int {
        return $this->replied_to_comment_id;
    }

    public function getDateTimeCreation(): DateTime {
        return $this->dateTime_Creation;
    }

    public function getMedia(): ?string {
        return $this->media;
    }

    // Setters
    public function setCommentId(int $comment_id): void {
        $this->comment_id = $comment_id;
    }

    public function setPostId(int $post_id): void {
        $this->post_id = $post_id;
    }

    public function setCreatedByUserId(int $created_by_user_id): void {
        $this->created_by_user_id = $created_by_user_id;
    }

    public function setCommentContent(string $comment_content): void {
        $this->comment_content = $comment_content;
    }

    public function setRepliedToCommentId(?int $replied_to_comment_id): void {
        $this->replied_to_comment_id = $replied_to_comment_id;
    }

    public function setDateTimeCreation(DateTime $dateTime_Creation): void {
        $this->dateTime_Creation = $dateTime_Creation;
    }

    public function setMedia(?string $media): void {
        $this->media = $media;
    }
}

?>
