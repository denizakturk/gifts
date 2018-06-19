<?php


namespace App\Repository;


use App\Entity\Gift;
use App\Entity\GiftSent;
use App\Model\GiftSentModel;
use Gifts\Database\EntityManager;
use Gifts\Database\RepositoryTrait;
use Gifts\Security\User;

class GiftSentRepository
{

    use RepositoryTrait;

    /**
     * @var GiftSent
     */
    protected $entity;

    /**
     * @var EntityManager
     */
    protected $entityManager;

    public function __construct(EntityManager $entityManager)
    {
        $this->entity = GiftSent::class;
        $this->entityManager = $entityManager;
    }

    public function isSendable(User $sender, User $recipient)
    {
        $now = new \DateTime();

        $sql = "SELECT COUNT(gs.id) FROM gift_sent gs
                INNER JOIN user sender ON sender.id = gs.sender_id
                INNER JOIN user recipient ON recipient.id = gs.recipient_id
                WHERE gs.sender_id = :senderId 
                  AND gs.recipient_id = :recipientId 
                  AND gs.created_at >= :startDate 
                  AND gs.created_at <= :endDate";

        /** @var \PDOStatement $pdoStatement */
        $pdoStatement = $this->entityManager->connection->prepare($sql);

        $pdoStatement->bindParam(':senderId', $sender->getId());
        $pdoStatement->bindParam(':recipientId', $recipient->getId());
        $pdoStatement->bindParam(':endDate', $now->format('Y-m-d H:i:s'));
        $now->modify('-1 Day');
        $pdoStatement->bindParam(':startDate', $now->format('Y-m-d H:i:s'));
        $pdoStatement->execute();

        return !$pdoStatement->fetchColumn();
    }

    public function send(User $sender, User $recipient, Gift $gift)
    {
        $now = new \DateTime();
        $sql = "INSERT INTO gift_sent SET sender_id =:senderId, gift_id =:giftId, recipient_id =:recipientId, created_at =:now";

        /** @var \PDOStatement $pdoStatement */
        $pdoStatement = $this->entityManager->connection->prepare($sql);

        $pdoStatement->bindParam(':senderId', $sender->getId());
        $pdoStatement->bindParam(':recipientId', $recipient->getId());
        $pdoStatement->bindParam(':giftId', $gift->getId());
        $pdoStatement->bindParam(':now', $now->format('Y-m-d H:i:s'));
        $pdoStatement->execute();

        return $this->entityManager->connection->lastInsertId();
    }

    public function getSentByApproved(\DateTime $startDate, \DateTime $endDate)
    {
        $sql = "SELECT recipient.username as recipientName FROM gift_sent gs
                INNER JOIN user sender ON sender.id = gs.sender_id
                INNER JOIN user recipient ON recipient.id = gs.recipient_id
                WHERE gs.approved = 1
                  AND gs.created_at >= :startDate 
                  AND gs.created_at <= :endDate";

        /** @var \PDOStatement $pdoStatement */
        $pdoStatement = $this->entityManager->connection->prepare($sql);

        $pdoStatement->bindParam(':startDate', $startDate->format('Y-m-d 00:00:00'));
        $pdoStatement->bindParam(':endDate', $endDate->format('Y-m-d 00:00:00'));

        $pdoStatement->execute();

        return $pdoStatement->fetchAll(\PDO::FETCH_ASSOC);
    }

    public function getUnapprovedGifts(User $recipient)
    {
        $sql = "SELECT gs.id AS id, u.name AS sender_name, g.name AS gift_name, gs.created_at AS created_at
                FROM gift_sent gs
                INNER JOIN gift g ON g.id = gs.gift_id
                INNER JOIN user u ON u.id = gs.sender_id
                WHERE gs.recipient_id =:recipientId AND gs.approved = 0 AND gs.deleted IS NULL";
        /** @var \PDOStatement $pdoStatement */
        $pdoStatement = $this->entityManager->connection->prepare($sql);
        $pdoStatement->bindParam(':recipientId', $recipient->getId());
        $pdoStatement->execute();

        return $pdoStatement->fetchAll(\PDO::FETCH_CLASS, GiftSentModel::class);

    }

    public function giftApprove(User $recipient, $giftSentId)
    {
        $sql = "UPDATE gift_sent SET approved = 1 
                WHERE gift_sent.recipient_id =:recipientId 
                  AND gift_sent.deleted IS NULL
                  AND gift_sent.approved = 0
                  AND gift_sent.id =:giftSentId";

        $pdoStatement = $this->entityManager->connection->prepare($sql);
        $pdoStatement->bindParam(':recipientId', $recipient->getId());
        $pdoStatement->bindParam(':giftSentId', $giftSentId);

        return $pdoStatement->execute();
    }

    public function giftUnapprove(User $recipient, $giftSentId)
    {
        $sql = "UPDATE gift_sent SET deleted = 1
                WHERE gift_sent.recipient_id =:recipientId 
                  AND gift_sent.deleted IS NULL
                  AND gift_sent.approved = 0
                  AND gift_sent.id =:giftSentId";

        $pdoStatement = $this->entityManager->connection->prepare($sql);
        $pdoStatement->bindParam(':recipientId', $recipient->getId());
        $pdoStatement->bindParam(':giftSentId', $giftSentId);

        return $pdoStatement->execute();
    }

    public function expiredGifts(\DateTime $expireDate)
    {
        $sql = "UPDATE gift_sent SET deleted = 1 WHERE gift_sent.created_at < :expireDate AND gift_sent.approved = 0";

        $pdoStatement = $this->entityManager->connection->prepare($sql);
        $pdoStatement->bindParam(':expireDate', $expireDate->format('Y-m-d H:i:s'));

        return $pdoStatement->execute();
    }

}