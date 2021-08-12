<?php


namespace App\Service;


use App\Dto\Request\MessageRequest;
use App\Entity\WallMessage;
use DateTime;;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Security\Core\User\UserInterface;

class WallMessageService
{
    private $entityManager;

    public function __construct( EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    /**
     * @param MessageRequest $request
     * @param UserInterface|null $user
     */
    public function create(MessageRequest $request, ?UserInterface $user): void
    {
        $wallMessage = new WallMessage();
        $wallMessage
            ->setText($request->getText())
            ->setUser($user)
            ->setTime((new DateTime()));

        $this->entityManager->persist($wallMessage);
        $this->entityManager->flush();
    }

    /**
     * @param WallMessage $message
     */
    public function delete(WallMessage $message): void
    {
        $this->entityManager->remove($message);
        $this->entityManager->flush();
    }

    /**
     * @param WallMessage $message
     * @param MessageRequest $request
     */
    public function update(WallMessage $message, MessageRequest $request): void
    {
        $message->setText($request->getText());
        $message->setEditTime(new DateTime());
        $this->entityManager->flush();
    }
}