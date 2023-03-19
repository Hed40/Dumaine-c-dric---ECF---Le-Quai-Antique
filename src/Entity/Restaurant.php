<?php

namespace App\Entity;

use App\Repository\RestaurantRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: RestaurantRepository::class)]
class Restaurant
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $Name = null;

    #[ORM\Column(type: Types::TIME_MUTABLE)]
    private ?\DateTimeInterface $opening_time = null;

    #[ORM\Column(type: Types::TIME_MUTABLE)]
    private ?\DateTimeInterface $closed_time = null;

    #[ORM\OneToMany(mappedBy: 'Restaurant', targetEntity: CutleryMax::class)]
    private Collection $Cutlery_max;

    public function __construct()
    {
        $this->Cutlery_max = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->Name;
    }

    public function setName(string $Name): self
    {
        $this->Name = $Name;

        return $this;
    }

    public function getOpeningTime(): ?\DateTimeInterface
    {
        return $this->opening_time;
    }

    public function setOpeningTime(\DateTimeInterface $opening_time): self
    {
        $this->opening_time = $opening_time;

        return $this;
    }

    public function getClosedTime(): ?\DateTimeInterface
    {
        return $this->closed_time;
    }

    public function setClosedTime(\DateTimeInterface $closed_time): self
    {
        $this->closed_time = $closed_time;

        return $this;
    }

    /**
     * @return Collection<int, CutleryMax>
     */
    public function getCutleryMax(): Collection
    {
        return $this->Cutlery_max;
    }

    public function addCutleryMax(CutleryMax $cutleryMax): self
    {
        if (!$this->Cutlery_max->contains($cutleryMax)) {
            $this->Cutlery_max->add($cutleryMax);
            $cutleryMax->setRestaurant($this);
        }

        return $this;
    }

    public function removeCutleryMax(CutleryMax $cutleryMax): self
    {
        if ($this->Cutlery_max->removeElement($cutleryMax)) {
            // set the owning side to null (unless already changed)
            if ($cutleryMax->getRestaurant() === $this) {
                $cutleryMax->setRestaurant(null);
            }
        }

        return $this;
    }

    public function setCutleryMax(?Cutlerymax $cutlery_max): self
    {
        $this->cutlery_max = $cutlery_max;

        return $this;
    }
}
