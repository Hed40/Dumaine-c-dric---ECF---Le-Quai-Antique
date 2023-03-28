<?php

namespace App\Entity;

use App\Repository\RestaurantScheduleRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: RestaurantScheduleRepository::class)]
class RestaurantSchedule
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $weekDay = null;

    #[ORM\Column(type: Types::TIME_MUTABLE)]
    private ?\DateTimeInterface $lunchOpeningTime = null;

    #[ORM\Column(type: Types::TIME_MUTABLE)]
    private ?\DateTimeInterface $lunchClosureTime = null;

    #[ORM\Column(type: Types::TIME_MUTABLE)]
    private ?\DateTimeInterface $eveningOpeningTime = null;

    #[ORM\Column(type: Types::TIME_MUTABLE)]
    private ?\DateTimeInterface $eveningClosureTime = null;

    #[ORM\ManyToOne(inversedBy: 'restaurantSchedules')]
    private ?Restaurant $restaurant_id = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getWeekDay(): ?string
    {
        return $this->weekDay;
    }

    public function setWeekDay(string $weekDay): self
    {
        $this->weekDay = $weekDay;

        return $this;
    }

    public function getLunchOpeningTime(): ?\DateTimeInterface
    {
        return $this->lunchOpeningTime;
    }

    public function setLunchOpeningTime(\DateTimeInterface $lunchOpeningTime): self
    {
        $this->lunchOpeningTime = $lunchOpeningTime;

        return $this;
    }

    public function getLunchClosureTime(): ?\DateTimeInterface
    {
        return $this->lunchClosureTime;
    }

    public function setLunchClosureTime(\DateTimeInterface $lunchClosureTime): self
    {
        $this->lunchClosureTime = $lunchClosureTime;

        return $this;
    }

    public function getEveningOpeningTime(): ?\DateTimeInterface
    {
        return $this->eveningOpeningTime;
    }

    public function setEveningOpeningTime(\DateTimeInterface $eveningOpeningTime): self
    {
        $this->eveningOpeningTime = $eveningOpeningTime;

        return $this;
    }

    public function getEveningClosureTime(): ?\DateTimeInterface
    {
        return $this->eveningClosureTime;
    }

    public function setEveningClosureTime(\DateTimeInterface $eveningClosureTime): self
    {
        $this->eveningClosureTime = $eveningClosureTime;

        return $this;
    }

    public function getRestaurantId(): ?Restaurant
    {
        return $this->restaurant_id;
    }

    public function setRestaurantId(?Restaurant $restaurant_id): self
    {
        $this->restaurant_id = $restaurant_id;

        return $this;
    }
}
