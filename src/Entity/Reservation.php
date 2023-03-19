<?php

namespace App\Entity;

use App\Repository\ReservationRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ReservationRepository::class)]
class Reservation
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(nullable: true)]
    private ?int $nombreCouverts = null;

    #[ORM\Column(type: Types::TEXT, nullable: true)]
    private ?string $allergie = null;

    #[ORM\Column(type: Types::TEXT, nullable: true)]
    private ?string $heure = null;

    #[ORM\Column(type: Types::DATE_MUTABLE)]
    private ?\DateTimeInterface $date = null;

    #[ORM\OneToMany(mappedBy: 'Reservation', targetEntity: User::class)]
    private Collection $Reserved_by;

    #[ORM\ManyToOne(inversedBy: 'Reservations')]
    private ?User $user = null;

    #[ORM\Column(length: 255)]
    private ?string $Firstname = null;

    #[ORM\Column(length: 255)]
    private ?string $Lastname = null;

    #[ORM\Column(length: 255)]
    private ?string $Phone_number = null;

    public function __construct()
    {
        $this->Reserved_by = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNombreCouverts(): ?int
    {
        return $this->nombreCouverts;
    }

    public function setNombreCouverts(?int $nombreCouverts): self
    {
        $this->nombreCouverts = $nombreCouverts;

        return $this;
    }

    public function getAllergie(): ?string
    {
        return $this->allergie;
    }

    public function setAllergie(?string $allergie): self
    {
        $this->allergie = $allergie;

        return $this;
    }

    public function getHeure(): ?string
    {
        return $this->heure;
    }

    public function setHeure(?string $heure): self
    {
        $this->heure = $heure;

        return $this;
    }

    public function getDate(): ?\DateTimeInterface
    {
        return $this->date;
    }

    public function setDate(\DateTimeInterface $date): self
    {
        $this->date = $date;

        return $this;
    }

    /**
     * @return Collection<int, User>
     */
    public function getReservedBy(): Collection
    {
        return $this->Reserved_by;
    }

    public function addReservedBy(User $reservedBy): self
    {
        if (!$this->Reserved_by->contains($reservedBy)) {
            $this->Reserved_by->add($reservedBy);
            $reservedBy->setReservation($this);
        }

        return $this;
    }

    public function removeReservedBy(User $reservedBy): self
    {
        if ($this->Reserved_by->removeElement($reservedBy)) {
            // set the owning side to null (unless already changed)
            if ($reservedBy->getReservation() === $this) {
                $reservedBy->setReservation(null);
            }
        }

        return $this;
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

    public function getFirstname(): ?string
    {
        return $this->Firstname;
    }

    public function setFirstname(string $Firstname): self
    {
        $this->Firstname = $Firstname;

        return $this;
    }

    public function getLastname(): ?string
    {
        return $this->Lastname;
    }

    public function setLastname(string $Lastname): self
    {
        $this->Lastname = $Lastname;

        return $this;
    }

    public function getPhoneNumber(): ?string
    {
        return $this->Phone_number;
    }

    public function setPhoneNumber(string $Phone_number): self
    {
        $this->Phone_number = $Phone_number;

        return $this;
    }
}
