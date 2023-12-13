<?php
class Like {
    private int $like_id;
    private int $user_id;
    private int $liked_id; // ID of the liked item (post or comment)
    private string $liked_type; // Type of the liked item ('post' or 'comment')
    private DateTime $createtime;

    public function __construct(int $user_id, int $liked_id, string $liked_type, string $createtime) {
        $this->user_id = $user_id;
        $this->liked_id = $liked_id;
        $this->liked_type = $liked_type;
        $this->createtime = new DateTime($createtime);
    }

    // Getters
    public function getLikeId(): ?int {
        return $this->like_id;
    }

    public function getUserId(): int {
        return $this->user_id;
    }

    public function getLikedId(): int {
        return $this->liked_id;
    }

    public function getLikedType(): string {
        return $this->liked_type;
    }

    public function getCreateTime(): DateTime {
        return $this->createtime;
    }

    // Setters
    public function setLikeId(int $like_id): void {
        $this->like_id = $like_id;
    }

    public function setUserId(int $user_id): void {
        $this->user_id = $user_id;
    }

    public function setLikedId(int $liked_id): void {
        $this->liked_id = $liked_id;
    }

    public function setLikedType(string $liked_type): void {
        $this->liked_type = $liked_type;
    }

    public function setCreateTime(DateTime $createtime): void {
        $this->createtime = $createtime;
    }
}
?>