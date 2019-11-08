<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use ApiPlatform\Core\Annotation\ApiResource;
use Symfony\Component\Serializer\Annotation\Groups;

/**
 * @ApiResource(
 *     normalizationContext={"groups"={"history:output"}},
 *     attributes={
 *          "formats"={"json"}
 *     }
 * )
 * @ORM\Entity(repositoryClass="App\Repository\HistoryRepository")
 * @ORM\HasLifecycleCallbacks()
 */
class History
{
    /**
     * @Groups({"history:output"})
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @Groups({"history:output"})
     * @ORM\Column(type="datetime")
     */
    private $createdAt;

    /**
     * @Groups({"history:output"})
     * @ORM\ManyToOne(targetEntity="App\Entity\User", inversedBy="history")
     */
    private $user;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getCreatedAt(): ?\DateTimeInterface
    {
        return $this->createdAt;
    }

    /**
     * @ORM\Prepersist()
     */
    public function setCreatedAt()
    {
        $this->createdAt = new \DateTime();

    }

    public function getUser(): ?User
    {
        return $this->user;
    }

    public function setUser(?User $user): self
    {
        $this->user = $user;

        return $this;
    }
}
