<?php

namespace App\Entity;

use App\Repository\CategoriesRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: CategoriesRepository::class)]
class Categories
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 50)]
    private ?string $name = null;

    #[ORM\ManyToMany(targetEntity: Starter::class, mappedBy: 'categories')]
    private Collection $starters;

    #[ORM\OneToMany(mappedBy: 'categorie', targetEntity: Starter::class)]
    private Collection $no;

    #[ORM\OneToMany(mappedBy: 'categorie', targetEntity: Dish::class)]
    private Collection $dishes;

    public function __construct()
    {
        $this->starters = new ArrayCollection();
        $this->no = new ArrayCollection();
        $this->dishes = new ArrayCollection();
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

    /**
     * @return Collection<int, Starter>
     */
    public function getStarters(): Collection
    {
        return $this->starters;
    }

    public function addStarter(Starter $starter): self
    {
        if (!$this->starters->contains($starter)) {
            $this->starters->add($starter);
            $starter->addCategory($this);
        }

        return $this;
    }

    public function removeStarter(Starter $starter): self
    {
        if ($this->starters->removeElement($starter)) {
            $starter->removeCategory($this);
        }

        return $this;
    }

    /**
     * @return Collection<int, Starter>
     */
    public function getNo(): Collection
    {
        return $this->no;
    }

    public function addNo(Starter $no): self
    {
        if (!$this->no->contains($no)) {
            $this->no->add($no);
            $no->setCategorie($this);
        }

        return $this;
    }

    public function removeNo(Starter $no): self
    {
        if ($this->no->removeElement($no)) {
            // set the owning side to null (unless already changed)
            if ($no->getCategorie() === $this) {
                $no->setCategorie(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, Dish>
     */
    public function getDishes(): Collection
    {
        return $this->dishes;
    }

    public function addDish(Dish $dish): self
    {
        if (!$this->dishes->contains($dish)) {
            $this->dishes->add($dish);
            $dish->setCategorie($this);
        }

        return $this;
    }

    public function removeDish(Dish $dish): self
    {
        if ($this->dishes->removeElement($dish)) {
            // set the owning side to null (unless already changed)
            if ($dish->getCategorie() === $this) {
                $dish->setCategorie(null);
            }
        }

        return $this;
    }
}
