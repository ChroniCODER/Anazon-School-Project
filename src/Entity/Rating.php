<?php

namespace App\Entity;

use App\Repository\RatingRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: RatingRepository::class)]
class Rating
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(nullable: true)]
    private ?int $noteNumber = null;

    #[ORM\ManyToOne(inversedBy: 'ratings')]
    #[ORM\JoinColumn(name:'product_id',nullable: false)]
    private ?product $product_id = null;

    #[ORM\ManyToOne(inversedBy: 'ratings')]
    #[ORM\JoinColumn(name:'user_id',nullable: false)]
    private ?User $user_id = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNoteNumber(): ?int
    {
        return $this->noteNumber;
    }

    public function setNoteNumber(?int $noteNumber): self
    {
        $this->noteNumber = $noteNumber;

        return $this;
    }

    public function getProductId(): ?product
    {
        return $this->product_id;
    }

    public function setProductId(?product $product_id): self
    {
        $this->product_id = $product_id;

        return $this;
    }

    public function getUserId(): ?User
    {
        return $this->user_id;
    }

    public function setUserId(?User $user_id): self
    {
        $this->user_id = $user_id;

        return $this;
    }
}
