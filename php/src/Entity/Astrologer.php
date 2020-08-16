<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use App\Repository\AstrologerRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;

/**
 * @ApiResource(normalizationContext={"groups"={"astrologer:read"}})
 * @ORM\Entity(repositoryClass=AstrologerRepository::class)
 */
class Astrologer
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
     * @ORM\Column(type="string", length=255)
     * @Groups({"astrologer:read"})
     */
    private $email;

    /**
     * @ORM\Column(type="string", length=255)
     * @Groups({"astrologer:read"})
     */
    private $personal_info;

    /**
     * @ORM\Column(type="text")
     * @Groups({"astrologer:read"})
     */
    private $bio;

    /**
     * @ORM\Column(type="string", length=255)
     * @Groups({"astrologer:read"})
     */
    private $photo;

    /**
     * @ORM\ManyToMany(targetEntity=Service::class, mappedBy="astrologer")
     * @Groups({"astrologer:read"})
     */
    private $services;

    public function __construct()
    {
        $this->services = new ArrayCollection();
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

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(string $email): self
    {
        $this->email = $email;

        return $this;
    }

    public function getPersonalInfo(): ?string
    {
        return $this->personal_info;
    }

    public function setPersonalInfo(string $personal_info): self
    {
        $this->personal_info = $personal_info;

        return $this;
    }

    public function getBio(): ?string
    {
        return $this->bio;
    }

    public function setBio(string $bio): self
    {
        $this->bio = $bio;

        return $this;
    }

    public function getPhoto(): ?string
    {
        return $this->photo;
    }

    public function setPhoto(string $photo): self
    {
        $this->photo = $photo;

        return $this;
    }

    /**
     * @return Collection|Service[]
     */
    public function getServices(): Collection
    {
        return $this->services;
    }

    public function addService(Service $service): self
    {
        if (!$this->services->contains($service)) {
            $this->services[] = $service;
            $service->addAstrologer($this);
        }

        return $this;
    }

    public function removeService(Service $service): self
    {
        if ($this->services->contains($service)) {
            $this->services->removeElement($service);
            $service->removeAstrologer($this);
        }

        return $this;
    }
}
