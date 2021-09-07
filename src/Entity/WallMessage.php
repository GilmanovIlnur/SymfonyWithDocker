<?php

namespace App\Entity;

use App\Repository\WallMessageRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Security\Core\User\UserInterface;

/**
 * @ORM\Entity(repositoryClass=WallMessageRepository::class)
 */
class WallMessage
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=1000)
     */
    private $text;

    /**
     * @ORM\ManyToOne(targetEntity=User::class, inversedBy="wallMessages")
     */
    private $user;

    /**
     * @ORM\Column(type="datetime")
     */
    private $time;

    /**
     * @ORM\Column(type="datetime", nullable=true)
     */
    private $editTime;

    /**
     * @ORM\OneToMany(targetEntity=MessageLike::class, mappedBy="message", orphanRemoval=true)
     */
    private $messageLikes;

    public function __construct()
    {
        $this->messageLikes = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getText(): ?string
    {
        return $this->text;
    }

    public function setText(string $text): self
    {
        $this->text = $text;

        return $this;
    }

    public function getUser(): ?UserInterface
    {
        return $this->user;
    }

    public function setUser(?UserInterface $user): self
    {
        $this->user = $user;

        return $this;
    }

    public function getTime(): ?\DateTimeInterface
    {
        return $this->time;
    }

    public function setTime(\DateTimeInterface $time): self
    {
        $this->time = $time;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getEditTime()
    {
        return $this->editTime;
    }

    /**
     * @param mixed $editTime
     * @return WallMessage
     */
    public function setEditTime($editTime): self
    {
        $this->editTime = $editTime;

        return $this;
    }

    /**
     * @return Collection|MessageLike[]
     */
    public function getMessageLikes(): Collection
    {
        return $this->messageLikes;
    }

    public function addMessageLike(MessageLike $messageLike): self
    {
        if (!$this->messageLikes->contains($messageLike)) {
            $this->messageLikes[] = $messageLike;
            $messageLike->setMessage($this);
        }

        return $this;
    }

    public function removeMessageLike(MessageLike $messageLike): self
    {
        if ($this->messageLikes->removeElement($messageLike)) {
            // set the owning side to null (unless already changed)
            if ($messageLike->getMessage() === $this) {
                $messageLike->setMessage(null);
            }
        }

        return $this;
    }
}
