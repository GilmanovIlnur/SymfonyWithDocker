<?php

namespace App\Entity;

use App\Repository\UserRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Security\Core\User\UserInterface;

/**
 * @ORM\Entity(repositoryClass=UserRepository::class)
 * @ORM\Table(name="`usr`")
 */
class User implements UserInterface
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=180, unique=true)
     */
    private $username;

    /**
     * @ORM\Column(type="json")
     */
    private $roles = [];

    /**
     * @var string The hashed password
     * @ORM\Column(type="string")
     */
    private $password;


    /**
     * Many Users have Many Users.
     * @ORM\ManyToMany(targetEntity=User::class, mappedBy="myFriends")
     */
    private $friendsWithMe;

    /**
     * Many Users have many Users.
     * @ORM\ManyToMany(targetEntity=User::class, inversedBy="friendsWithMe")
     * @ORM\JoinTable(name="friends",
     *      joinColumns={@ORM\JoinColumn(name="user_id", referencedColumnName="id")},
     *      inverseJoinColumns={@ORM\JoinColumn(name="friend_user_id", referencedColumnName="id")}
     *      )
     */
    private $myFriends;

    /**
     * @ORM\OneToOne(targetEntity=UserInfo::class, mappedBy="user", cascade={"persist", "remove"})
     */
    private $userInfo;

    public function __construct()
    {
        $this->friendsWithMe = new ArrayCollection();
        $this->myFriends = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * A visual identifier that represents this user.
     *
     * @see UserInterface
     */
    public function getUsername(): string
    {
        return (string) $this->username;
    }

    /**
     * @see UserInterface
     */
    public function getRoles(): array
    {
        $roles = $this->roles;
        // guarantee every user at least has ROLE_USER
        $roles[] = 'ROLE_USER';

        return array_unique($roles);
    }

    public function setRoles(array $roles): self
    {
        $this->roles = $roles;

        return $this;
    }

    /**
     * @see UserInterface
     */
    public function getPassword(): string
    {
        return (string) $this->password;
    }

    public function setPassword(string $password): self
    {
        $this->password = $password;

        return $this;
    }

    /**
     * Returning a salt is only needed, if you are not using a modern
     * hashing algorithm (e.g. bcrypt or sodium) in your security.yaml.
     *
     * @see UserInterface
     */
    public function getSalt(): ?string
    {
        return null;
    }

    /**
     * @see UserInterface
     */
    public function eraseCredentials()
    {
        // If you store any temporary, sensitive data on the user, clear it here
        // $this->plainPassword = null;
    }

    /**
     * @param mixed $username
     * @return User
     */
    public function setUsername($username): self
    {
        $this->username = $username;

        return $this;
    }

    /**
     * @return Collection
     */
    public function getMyFriends(): Collection
    {
        return $this->myFriends;
    }

    /**
     * @param User $myFriend
     * @return User
     */
    public function addMyFriends(User $myFriend): self
    {
        if (!$this->myFriends->contains($myFriend)) {
            $this->myFriends[] = $myFriend;
        }

        return $this;
    }

    /**
     * @param User $myFriend
     */
    public function removeMyFriend(User $myFriend)
    {
        $this->myFriends->removeElement($myFriend);
    }

    /**
     * @return Collection
     */
    public function getFriendsWithMe(): Collection
    {
        return $this->friendsWithMe;
    }

    /**
     * @param User $friendsWithMe
     * @return User
     */
    public function addFriendsWithMe(User $friendsWithMe): self
    {
        if (!$this->friendsWithMe->contains($friendsWithMe)) {
            $this->friendsWithMe[] = $friendsWithMe;
        }

        return $this;
    }

    public function removeFriendWithMe(User $friendWithMe)
    {
        $this->friendsWithMe->removeElement($friendWithMe);
    }

    public function getUserInfo(): ?UserInfo
    {
        return $this->userInfo;
    }

    public function setUserInfo(?UserInfo $userInfo): self
    {
        // unset the owning side of the relation if necessary
        if ($userInfo === null && $this->userInfo !== null) {
            $this->userInfo->setUser(null);
        }

        // set the owning side of the relation if necessary
        if ($userInfo !== null && $userInfo->getUser() !== $this) {
            $userInfo->setUser($this);
        }

        $this->userInfo = $userInfo;

        return $this;
    }
}
