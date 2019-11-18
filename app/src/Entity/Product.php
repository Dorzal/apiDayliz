<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiFilter;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Gedmo\Mapping\Annotation as Gedmo;
use Doctrine\ORM\Mapping as ORM;
use ApiPlatform\Core\Annotation\ApiResource;
use Symfony\Component\Serializer\Annotation\Groups;
use ApiPlatform\Core\Bridge\Doctrine\Orm\Filter\SearchFilter;

/**
 * @ApiResource(
 *     normalizationContext={"groups"={"product:output"}},
 *     denormalizationContext={"groups"={"product:input"}},
 *     attributes={
 *          "formats"={"json"}
 *     }
 * )
 * @ApiFilter(SearchFilter::class, properties={"showAt": "exact"})
 * @ORM\Entity(repositoryClass="App\Repository\ProductRepository")
 * @ORM\HasLifecycleCallbacks()
 */
class Product
{
    /**
     * @Groups({"product:output"})
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @Groups({"sub:output", "product:output", "commentary:output", "user:output", "mark:output", "product:input"})
     * @ORM\Column(type="string", length=255)
     */
    private $name;

    /**
     * @Groups({"product:output", "product:input"})
     * @ORM\Column(type="string", length=255)
     */
    private $price;

    /**
     * @Groups({"sub:output", "product:output", "product:input"})
     * @ORM\Column(type="date", nullable=true)
     */
    private $showAt;

    /**
     * @Groups({"product:output"})
     * @Gedmo\Timestampable(on="create")
     * @ORM\Column(type="datetime")
     */
    private $createdAt;

    /**
     * @Groups({"product:output", "product:input"})
     * @ORM\Column(type="string", length=500)
     */
    private $description;

    /**
     * @Groups({"product:output", "product:input"})
     * @ORM\Column(type="string", length=255)
     */
    private $picture;

    /**
     * @Groups({"sub:output", "product:output", "product:input"})
     * @ORM\Column(type="string", length=255)
     */
    private $url;

    /**
     * @Groups({"product:output", "product:input"})
     * @ORM\ManyToOne(targetEntity="App\Entity\SubCategory", inversedBy="products")
     */
    private $subCategory;

    /**
     * @Groups({"product:output", "product:input"})
     * @ORM\ManyToOne(targetEntity="App\Entity\Mark", inversedBy="products")
     */
    private $mark;

    /**
     * @Groups({"product:output"})
     * @ORM\OneToOne(targetEntity="App\Entity\Promotion", mappedBy="product", cascade={"persist", "remove"})
     */
    private $promotion;

    /**
     * @Groups({"product:output"})
     * @ORM\ManyToMany(targetEntity="App\Entity\User", mappedBy="likeProduct")
     */
    private $users;

    /**
     * @Groups({"product:output"})
     * @ORM\OneToMany(targetEntity="App\Entity\Commentary", mappedBy="product")
     */
    private $commentaries;

    public function __construct()
    {
        $this->users = new ArrayCollection();
        $this->commentaries = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    public function getPrice(): ?string
    {
        return $this->price;
    }

    public function setPrice(string $price): self
    {
        $this->price = $price;

        return $this;
    }

    public function getShowAt(): ?\DateTimeInterface
    {
        return $this->showAt;
    }

    public function setShowAt(?\DateTimeInterface $showAt): self
    {
        $this->showAt = $showAt;

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

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(string $description): self
    {
        $this->description = $description;

        return $this;
    }

    public function getPicture(): ?string
    {
        return $this->picture;
    }

    public function setPicture(string $picture): self
    {
        $this->picture = $picture;

        return $this;
    }

    public function getUrl(): ?string
    {
        return $this->url;
    }

    public function setUrl(string $url): self
    {
        $this->url = $url;

        return $this;
    }

    public function getSubCategory(): ?SubCategory
    {
        return $this->subCategory;
    }

    public function setSubCategory(?SubCategory $subCategory): self
    {
        $this->subCategory = $subCategory;

        return $this;
    }

    public function getMark(): ?Mark
    {
        return $this->mark;
    }

    public function setMark(?Mark $mark): self
    {
        $this->mark = $mark;

        return $this;
    }

    public function getPromotion(): ?Promotion
    {
        return $this->promotion;
    }

    public function setPromotion(?Promotion $promotion): self
    {
        $this->promotion = $promotion;

        // set (or unset) the owning side of the relation if necessary
        $newProduct = $promotion === null ? null : $this;
        if ($newProduct !== $promotion->getProduct()) {
            $promotion->setProduct($newProduct);
        }

        return $this;
    }

    /**
     * @return Collection|User[]
     */
    public function getUsers(): Collection
    {
        return $this->users;
    }

    public function addUser(User $user): self
    {
        if (!$this->users->contains($user)) {
            $this->users[] = $user;
            $user->addLikeProduct($this);
        }

        return $this;
    }

    public function removeUser(User $user): self
    {
        if ($this->users->contains($user)) {
            $this->users->removeElement($user);
            $user->removeLikeProduct($this);
        }

        return $this;
    }

    /**
     * @return Collection|Commentary[]
     */
    public function getCommentaries(): Collection
    {
        return $this->commentaries;
    }

    public function addCommentary(Commentary $commentary): self
    {
        if (!$this->commentaries->contains($commentary)) {
            $this->commentaries[] = $commentary;
            $commentary->setProduct($this);
        }

        return $this;
    }

    public function removeCommentary(Commentary $commentary): self
    {
        if ($this->commentaries->contains($commentary)) {
            $this->commentaries->removeElement($commentary);
            // set the owning side to null (unless already changed)
            if ($commentary->getProduct() === $this) {
                $commentary->setProduct(null);
            }
        }

        return $this;
    }
}
