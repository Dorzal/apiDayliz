<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiSubresource;
use Gedmo\Mapping\Annotation as Gedmo;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Security\Core\User\UserInterface;
use ApiPlatform\Core\Annotation\ApiResource;
use Symfony\Component\Serializer\Annotation\Groups;

/**
 * @ApiResource(
 *     normalizationContext={"groups"={"user:output"}},
 *     attributes={
 *          "formats"={"json"}
 *     }
 * )
 * @ORM\Entity(repositoryClass="App\Repository\UserRepository")
 * @ORM\Table("`user`")
 * @ORM\HasLifecycleCallbacks()
 */
class User implements UserInterface
{
    /**
     * @Groups({"user:output"})
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @Groups({"user:output", "commentary:output", "product:output", "premia:output"})
     * @ORM\Column(type="string", length=180, unique=true)
     */
    private $email;

    /**
     * @Groups({"user:output"})
     * @ORM\Column(type="json")
     */
    private $roles = [];

    /**
     * @var string The hashed password
     * @ORM\Column(type="string")
     */
    private $password;

    /**
     * @Groups({"user:output"})
     * @ORM\Column(type="string", length=255)
     */
    private $firstName;

    /**
     * @Groups({"user:output"})
     * @ORM\Column(type="string", length=255)
     */
    private $lastName;

    /**
     * @Groups({"user:output"})
     * @Gedmo\Timestampable(on="create")
     * @ORM\Column(type="datetime")
     */
    private $createdAt;

    /**
     * @Groups({"user:output"})
     * @ORM\Column(type="string", length=255)
     */
    private $avatar;

    /**
     * @Groups({"user:output"})
     * @ORM\Column(type="date")
     */
    private $birthday;

    /**
     * @Groups({"user:output"})
     * @ORM\ManyToMany(targetEntity="App\Entity\SubCategory", inversedBy="users")
     */
    private $interest;

    /**
     * @Groups({"user:output"})
     * @ORM\ManyToMany(targetEntity="App\Entity\Product", inversedBy="users")
     */
    private $likeProduct;

    /**
     * @Groups({"user:output"})
     * @ORM\ManyToOne(targetEntity="App\Entity\Premium", inversedBy="users")
     */
    private $Premium;

    /**
     * @Groups({"user:output"})
     * @ORM\OneToMany(targetEntity="App\Entity\History", mappedBy="user")
     */
    private $history;

    /**
     * @Groups({"user:output"})
     * @ORM\OneToMany(targetEntity="App\Entity\Commentary", mappedBy="userCommentary")
     */
    private $commentary;

    public function __construct()
    {
        $this->interest = new ArrayCollection();
        $this->likeProduct = new ArrayCollection();
        $this->history = new ArrayCollection();
        $this->commentary = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(string $email): self
    {
        $this->email = $email;

        return $this;
    }

    /**
     * A visual identifier that represents this user.
     *
     * @see UserInterface
     */
    public function getUsername(): string
    {
        return (string) $this->email;
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
     * @see UserInterface
     */
    public function getSalt()
    {
        // not needed when using the "bcrypt" algorithm in security.yaml
    }

    /**
     * @see UserInterface
     */
    public function eraseCredentials()
    {
        // If you store any temporary, sensitive data on the user, clear it here
        // $this->plainPassword = null;
    }

    public function getFirstName(): ?string
    {
        return $this->firstName;
    }

    public function setFirstName(string $firstName): self
    {
        $this->firstName = $firstName;

        return $this;
    }

    public function getLastName(): ?string
    {
        return $this->lastName;
    }

    public function setLastName(string $lastName): self
    {
        $this->lastName = $lastName;

        return $this;
    }

    public function getCreatedAt(): ?\DateTimeInterface
    {
        return $this->createdAt;
    }

    /**
     * @ORM\PrePersist()
     */
    public function setCreatedAt()
    {
        $this->createdAt = new \DateTime();

    }

    public function getAvatar(): ?string
    {
        return $this->avatar;
    }

    public function setAvatar(string $avatar): self
    {
        $this->avatar = $avatar;

        return $this;
    }

    public function getBirthday(): ?\DateTimeInterface
    {
        return $this->birthday;
    }

    public function setBirthday(\DateTimeInterface $birthday): self
    {
        $this->birthday = $birthday;

        return $this;
    }

    /**
     * @return Collection|SubCategory[]
     */
    public function getInterest(): Collection
    {
        return $this->interest;
    }

    public function addInterest(SubCategory $interest): self
    {
        if (!$this->interest->contains($interest)) {
            $this->interest[] = $interest;
        }

        return $this;
    }

    public function removeInterest(SubCategory $interest): self
    {
        if ($this->interest->contains($interest)) {
            $this->interest->removeElement($interest);
        }

        return $this;
    }

    /**
     * @return Collection|Product[]
     */
    public function getLikeProduct(): Collection
    {
        return $this->likeProduct;
    }

    public function addLikeProduct(Product $likeProduct): self
    {
        if (!$this->likeProduct->contains($likeProduct)) {
            $this->likeProduct[] = $likeProduct;
        }

        return $this;
    }

    public function removeLikeProduct(Product $likeProduct): self
    {
        if ($this->likeProduct->contains($likeProduct)) {
            $this->likeProduct->removeElement($likeProduct);
        }

        return $this;
    }

    public function getPremium(): ?Premium
    {
        return $this->Premium;
    }

    public function setPremium(?Premium $Premium): self
    {
        $this->Premium = $Premium;

        return $this;
    }

    /**
     * @return Collection|History[]
     */
    public function getHistory(): Collection
    {
        return $this->history;
    }

    public function addHistory(History $history): self
    {
        if (!$this->history->contains($history)) {
            $this->history[] = $history;
            $history->setUser($this);
        }

        return $this;
    }

    public function removeHistory(History $history): self
    {
        if ($this->history->contains($history)) {
            $this->history->removeElement($history);
            // set the owning side to null (unless already changed)
            if ($history->getUser() === $this) {
                $history->setUser(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|Commentary[]
     */
    public function getCommentary(): Collection
    {
        return $this->commentary;
    }

    public function addCommentary(Commentary $commentary): self
    {
        if (!$this->commentary->contains($commentary)) {
            $this->commentary[] = $commentary;
            $commentary->setUserCommentary($this);
        }

        return $this;
    }

    public function removeCommentary(Commentary $commentary): self
    {
        if ($this->commentary->contains($commentary)) {
            $this->commentary->removeElement($commentary);
            // set the owning side to null (unless already changed)
            if ($commentary->getUserCommentary() === $this) {
                $commentary->setUserCommentary(null);
            }
        }

        return $this;
    }
}
