<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Gedmo\Mapping\Annotation as Gedmo;
use ApiPlatform\Core\Annotation\ApiResource;
use Symfony\Component\Serializer\Annotation\Groups;

/**
 * @ApiResource(
 *     normalizationContext={"groups"={"commentary:output"}},
 *     attributes={
 *          "formats"={"json"}
 *     }
 * )
 * @ORM\Entity(repositoryClass="App\Repository\CommentaryRepository")
 * @ORM\HasLifecycleCallbacks()
 */
class Commentary
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @Groups({"commentary:output"})
     * @ORM\Column(type="string", length=500)
     */
    private $content;

    /**
     * @Groups({"commentary:output"})
     * @ORM\Column(type="datetime")
     */
    private $createdAt;

    /**
     * @Groups({"commentary:output"})
     * @Gedmo\Timestampable(on="update")
     * @ORM\Column(type="datetime", nullable=true)
     */
    private $modifiedAt;

    /**
     * @Groups({"commentary:output"})
     * @ORM\ManyToOne(targetEntity="App\Entity\Product", inversedBy="commentaries")
     */
    private $product;

    /**
     * @Groups({"commentary:output"})
     * @ORM\ManyToOne(targetEntity="App\Entity\User", inversedBy="commentary")
     */
    private $userCommentary;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getContent(): ?string
    {
        return $this->content;
    }

    public function setContent(string $content): self
    {
        $this->content = $content;

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

    public function getModifiedAt(): ?\DateTimeInterface
    {
        return $this->modifiedAt;
    }

    /**
     * @Orm\PreUpdate()
     */
    public function setModifiedAt()
    {
        $this->modifiedAt = new \DateTime();

    }

    public function getProduct(): ?Product
    {
        return $this->product;
    }

    public function setProduct(?Product $product): self
    {
        $this->product = $product;

        return $this;
    }

    public function getUserCommentary(): ?User
    {
        return $this->userCommentary;
    }

    public function setUserCommentary(?User $userCommentary): self
    {
        $this->userCommentary = $userCommentary;

        return $this;
    }
}
