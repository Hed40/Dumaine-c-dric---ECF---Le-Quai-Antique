<?php

namespace App\Entity;

use App\Repository\DessertsRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: DessertsRepository::class)]
class Desserts
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $name = null;

    #[ORM\ManyToOne(inversedBy: 'desserts')]
    private ?Categories $type = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $description = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $allergene = null;

    #[ORM\Column(type: Types::DECIMAL, precision: 10, scale: 2)]
    private ?string $price = null;

    #[ORM\OneToMany(mappedBy: 'Dessert', targetEntity: SetMenu::class)]
    private Collection $setMenus;

    public function __construct()
    {
        $this->setMenus = new ArrayCollection();
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

    public function getType(): ?Categories
    {
        return $this->type;
    }

    public function setType(?Categories $type): self
    {
        $this->type = $type;

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

    public function getAllergene(): ?string
    {
        return $this->allergene;
    }

    public function setAllergene(?string $allergene): self
    {
        $this->allergene = $allergene;

        return $this;
    }

    public function getPrice(): ?string
    {
        return $this->price;
    }

    public function setPrice(string $price): self
    {
        $this->price = $price;

        return $this;
    }

    /**
     * @return Collection<int, SetMenu>
     */
    public function getSetMenus(): Collection
    {
        return $this->setMenus;
    }

    public function addSetMenu(SetMenu $setMenu): self
    {
        if (!$this->setMenus->contains($setMenu)) {
            $this->setMenus->add($setMenu);
            $setMenu->setDessert($this);
        }

        return $this;
    }

    public function removeSetMenu(SetMenu $setMenu): self
    {
        if ($this->setMenus->removeElement($setMenu)) {
            // set the owning side to null (unless already changed)
            if ($setMenu->getDessert() === $this) {
                $setMenu->setDessert(null);
            }
        }

        return $this;
    }
}
