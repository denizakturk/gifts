<?php


namespace App\Model;


class GiftSentModel
{

    protected $id;
    protected $sender_name;
    protected $gift_name;
    protected $created_at;

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @return mixed
     */
    public function getSenderName()
    {
        return $this->sender_name;
    }

    /**
     * @param mixed $sender_name
     */
    public function setSenderName($sender_name): void
    {
        $this->sender_name = $sender_name;
    }

    /**
     * @return mixed
     */
    public function getGiftName()
    {
        return $this->gift_name;
    }

    /**
     * @param mixed $gift_name
     */
    public function setGiftName($gift_name): void
    {
        $this->gift_name = $gift_name;
    }

    /**
     * @return mixed
     */
    public function getCreatedAt()
    {
        return $this->created_at;
    }

    /**
     * @param mixed $created_at
     */
    public function setCreatedAt($created_at): void
    {
        $this->created_at = $created_at;
    }

}