<?php

namespace App\Entity;

use App\Repository\StarterRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: StarterRepository::class)]
class Starter
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 36)]
    private ?string $title = null;

    #[ORM\Column(length: 255)]
    private ?string $description = null;

    #[ORM\ManyToOne(inversedBy: 'starter')]
    private ?Categories $categorie = null;

    #[ORM\Column(type: Types::DECIMAL, precision: 10, scale: 2)]
    private ?string $price = null;

    #[ORM\OneToMany(mappedBy: 'starter', targetEntity: SetMenu::class, orphanRemoval: true)] // orphanRemoval: true = supprime les SetMenu qui n'ont plus de Dish
    private Collection $setMenus;

    public function __construct()
    {
        $this->setMenus = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTitle(): ?string
    {
        return $this->title;
    }

    public function setTitle(string $title): self
    {
        $this->title = $title;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(string $description): self
    {
        $this->description = $description;

        return $this;
    }

    public function getCategorie(): ?Categories
    {
        return $this->categorie;
    }

    public function setCategorie(?Categories $categorie): self
    {
        $this->categorie = $categorie;

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
            $setMenu->setStarter($this);
        }

        return $this;
    }

    public function removeSetMenu(SetMenu $setMenu): self
    {
        if ($this->setMenus->removeElement($setMenu)) {
            // set the owning side to null (unless already changed)
            if ($setMenu->getStarter() === $this) {
                $setMenu->setStarter(null);
            }
        }

        return $this;
    }
}
