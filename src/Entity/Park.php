<?php

namespace App\Entity;

use App\Repository\ParkRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ParkRepository::class)]
class Park
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 80)]
    private ?string $name = null;

    #[ORM\Column(length: 2)]
    private ?string $country = null;

    #[ORM\Column(nullable: true)]
    private ?int $openingYear = null;

    #[ORM\ManyToOne(targetEntity: self::class, inversedBy: 'parks')]
    private ?self $Park = null;

    /**
     * @var Collection<int, self>
     */
    #[ORM\OneToMany(targetEntity: self::class, mappedBy: 'Park')]
    private Collection $parks;

    public function __construct()
    {
        $this->parks = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): static
    {
        $this->name = $name;

        return $this;
    }

    public function getCountry(): ?string
    {
        return $this->country;
    }

    public function setCountry(string $country): static
    {
        $this->country = $country;

        return $this;
    }

    public function getOpeningYear(): ?int
    {
        return $this->openingYear;
    }

    public function setOpeningYear(?int $openingYear): static
    {
        $this->openingYear = $openingYear;

        return $this;
    }

    public function getPark(): ?self
    {
        return $this->Park;
    }

    public function setPark(?self $Park): static
    {
        $this->Park = $Park;

        return $this;
    }

    /**
     * @return Collection<int, self>
     */
    public function getParks(): Collection
    {
        return $this->parks;
    }

    public function addPark(self $park): static
    {
        if (!$this->parks->contains($park)) {
            $this->parks->add($park);
            $park->setPark($this);
        }

        return $this;
    }

    public function removePark(self $park): static
    {
        if ($this->parks->removeElement($park)) {
            // set the owning side to null (unless already changed)
            if ($park->getPark() === $this) {
                $park->setPark(null);
            }
        }

        return $this;
    }
}
