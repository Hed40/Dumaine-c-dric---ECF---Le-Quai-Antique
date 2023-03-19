<?php

namespace App\Entity;

use App\Repository\CutleryMaxRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: CutleryMaxRepository::class)]
class CutleryMax
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(nullable: true)]
    private ?int $threshold = null;

    #[ORM\ManyToOne(inversedBy: 'Cutlery_max')]
    private ?Restaurant $Restaurant = null;

    #[ORM\OneToMany(mappedBy: 'cutlery_max', targetEntity: Restaurant::class)]
    private Collection $Cutlery_max;

    public function __construct()
    {
        $this->Cutlery_max = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getThreshold(): ?int
    {
        return $this->threshold;
    }

    public function setThreshold(?int $threshold): self
    {
        $this->threshold = $threshold;

        return $this;
    }

    public function getRestaurant(): ?Restaurant
    {
        return $this->Restaurant;
    }

    public function setRestaurant(?Restaurant $Restaurant): self
    {
        $this->Restaurant = $Restaurant;

        return $this;
    }

    /**
     * @return Collection<int, Restaurant>
     */
    public function getCutleryMax(): Collection
    {
        return $this->Cutlery_max;
    }

    public function addCutleryMax(Restaurant $cutleryMax): self
    {
        if (!$this->Cutlery_max->contains($cutleryMax)) {
            $this->Cutlery_max->add($cutleryMax);
            $cutleryMax->setCutleryMax($this);
        }

        return $this;
    }

    public function removeCutleryMax(Restaurant $cutleryMax): self
    {
        if ($this->Cutlery_max->removeElement($cutleryMax)) {
            // set the owning side to null (unless already changed)
            if ($cutleryMax->getCutleryMax() === $this) {
                $cutleryMax->setCutleryMax(null);
            }
        }

        return $this;
    }
}
