<?php

class Post {
    private int $post_id;
    private int $user_id;
    private DateTime $createtime;
    private string $channel_id;
    private string $posttype;
    private string $content;
    private string $media;

    public function __construct(int $user_id, string $createtime, string $channel_id, string $posttype, string $content, string $media) {
        $this->user_id = $user_id;
        $this->createtime = new DateTime($createtime);
        $this->channel_id = $channel_id;
        $this->posttype = $posttype;
        $this->content = $content;
        $this->media = $media;
        $this->likes=0;
    }

    // Getters
    public function getUserId(): int {
        return $this->user_id;
    }

    public function getCreateTime(): DateTime {
        return $this->createtime;
    }

    public function getChannelId(): string {
        return $this->channel_id;
    }

    public function getPostType(): string {
        return $this->posttype;
    }

    public function getContent(): string {
        return $this->content;
    }

    public function getMedia(): string {
        return $this->media;
    }

    public function getPostId(): ?int { // Nullable return type
        return $this->post_id;
    }
   

    // Setters
    public function setUserId(int $user_id): void {
        $this->user_id = $user_id;
    }

    public function setCreateTime(DateTime $createtime): void {
        $this->createtime = $createtime;
    }

    public function setChannelId(string $channel_id): void {
        $this->channel_id = $channel_id;
    }

    public function setPostType(string $posttype): void {
        $this->posttype = $posttype;
    }

    public function setContent(string $content): void {
        $this->content = $content;
    }

    public function setMedia(string $media): void {
        $this->media = $media;
    }

    public function setPostId(int $post_id): void {
        $this->post_id = $post_id;
    }
   
}

?>
