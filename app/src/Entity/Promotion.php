<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Gedmo\Mapping\Annotation as Gedmo;
use ApiPlatform\Core\Annotation\ApiResource;
use Symfony\Component\Serializer\Annotation\Groups;

/**
 * @ApiResource(
 *     normalizationContext={"groups"={"promotion:output"}},
 *     attributes={
 *          "formats"={"json"}
 *     }
 * )
 * @ORM\Entity(repositoryClass="App\Repository\PromotionRepository")
 * @ORM\HasLifecycleCallbacks()
 */
class Promotion
{
    /**
     * @Groups({"promotion:output"})
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @Groups({"promotion:output"})
     * @ORM\Column(type="string", length=255)
     */
    private $code;

    /**
     * @Groups({"promotion:output"})
     * @ORM\Column(type="integer")
     */
    private $percent;

    /**
     * @Groups({"promotion:output"})
     * @Gedmo\Timestampable(on="create")
     * @ORM\Column(type="datetime", nullable=true)
     */
    private $createdAt;

    /**
     * @Groups({"promotion:output"})
     * @ORM\OneToOne(targetEntity="App\Entity\Product", inversedBy="promotion", cascade={"persist", "remove"})
     */
    private $product;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getCode(): ?string
    {
        return $this->code;
    }

    public function setCode(string $code): self
    {
        $this->code = $code;

        return $this;
    }

    public function getPercent(): ?int
    {
        return $this->percent;
    }

    public function setPercent(int $percent): self
    {
        $this->percent = $percent;

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

        return $this;
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
}
