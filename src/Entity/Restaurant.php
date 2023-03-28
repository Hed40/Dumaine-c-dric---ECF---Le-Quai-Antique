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

    #[ORM\OneToMany(mappedBy: 'Restaurant', targetEntity: CutleryMax::class)]
    private Collection $Cutlery_max;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $adresse = null;

    #[ORM\Column(length: 255)]
    private ?string $phoneNumber = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $email = null;

    #[ORM\OneToMany(mappedBy: 'restaurant_id', targetEntity: RestaurantSchedule::class)]
    private Collection $restaurantSchedules;

    public function __construct()
    {
        $this->Cutlery_max = new ArrayCollection();
        $this->restaurantSchedules = new ArrayCollection();
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

    public function getAdresse(): ?string
    {
        return $this->adresse;
    }

    public function setAdresse(?string $adresse): self
    {
        $this->adresse = $adresse;

        return $this;
    }

    public function getPhoneNumber(): ?string
    {
        return $this->phoneNumber;
    }

    public function setPhoneNumber(string $phoneNumber): self
    {
        $this->phoneNumber = $phoneNumber;

        return $this;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(?string $email): self
    {
        $this->email = $email;

        return $this;
    }

    /**
     * @return Collection<int, RestaurantSchedule>
     */
    public function getRestaurantSchedules(): Collection
    {
        return $this->restaurantSchedules;
    }

    public function addRestaurantSchedule(RestaurantSchedule $restaurantSchedule): self
    {
        if (!$this->restaurantSchedules->contains($restaurantSchedule)) {
            $this->restaurantSchedules->add($restaurantSchedule);
            $restaurantSchedule->setRestaurantId($this);
        }

        return $this;
    }

    public function removeRestaurantSchedule(RestaurantSchedule $restaurantSchedule): self
    {
        if ($this->restaurantSchedules->removeElement($restaurantSchedule)) {
            // set the owning side to null (unless already changed)
            if ($restaurantSchedule->getRestaurantId() === $this) {
                $restaurantSchedule->setRestaurantId(null);
            }
        }

        return $this;
    }
}
