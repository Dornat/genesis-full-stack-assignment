<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use App\Repository\ServiceRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;

/**
 * @ApiResource()
 * @ORM\Entity(repositoryClass=ServiceRepository::class)
 */
class Service
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     * @Groups({"astrologer:read"})
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     * @Groups({"astrologer:read"})
     */
    private $name;

    /**
     * @ORM\Column(type="text", nullable=true)
     * @Groups({"astrologer:read"})
     */
    private $description;

    /**
     * @ORM\Column(type="integer")
     * @Groups({"astrologer:read"})
     */
    private $price;

    /**
     * @ORM\ManyToMany(targetEntity=Astrologer::class, inversedBy="services")
     */
    private $astrologer;

    public function __construct()
    {
        $this->astrologer = new ArrayCollection();
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

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(?string $description): self
    {
        $this->description = $description;

        return $this;
    }

    public function getPrice(): ?int
    {
        return $this->price;
    }

    public function setPrice(int $price): self
    {
        $this->price = $price;

        return $this;
    }

    /**
     * @return Collection|Astrologer[]
     */
    public function getAstrologer(): Collection
    {
        return $this->astrologer;
    }

    public function addAstrologer(Astrologer $astrologer): self
    {
        if (!$this->astrologer->contains($astrologer)) {
            $this->astrologer[] = $astrologer;
        }

        return $this;
    }

    public function removeAstrologer(Astrologer $astrologer): self
    {
        if ($this->astrologer->contains($astrologer)) {
            $this->astrologer->removeElement($astrologer);
        }

        return $this;
    }
}
