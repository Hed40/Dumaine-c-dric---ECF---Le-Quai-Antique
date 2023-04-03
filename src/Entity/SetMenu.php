<?php

namespace App\Entity;

use App\Repository\SetMenuRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: SetMenuRepository::class)]
class SetMenu
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $name = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $description = null;

    #[ORM\ManyToOne(inversedBy: 'setMenus')]
    //Lorsque l'entrée est supprimé, l'entrée du menu est mis à null
    #[ORM\JoinColumn(onDelete: "SET NULL")]
    private ?Starter $starter = null;

    #[ORM\ManyToOne(inversedBy: 'setMenus')]
    //Lorsque le plat est supprimé, le plat du menu est mis à null
    #[ORM\JoinColumn(onDelete: "SET NULL")]
    private ?Dish $Dish = null;

    #[ORM\ManyToOne(inversedBy: 'setMenus')]
    //Lorsque le dessert est supprimé, le dessert du menu est mis à null
    #[ORM\JoinColumn(onDelete: "SET NULL")]
    private ?Desserts $Dessert = null;

    #[ORM\Column(type: Types::DECIMAL, precision: 5, scale: 2)]
    private ?string $price = null;

    #[ORM\OneToMany(mappedBy: 'Formule', targetEntity: Menus::class)]
    private Collection $menus;

    #[ORM\OneToMany(mappedBy: 'DinerSetMenu', targetEntity: Menus::class)]
    private Collection $DinerSetMenu;

    public function __construct()
    {
        $this->menus = new ArrayCollection();
        $this->DinerSetMenu = new ArrayCollection();
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

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(?string $description): self
    {
        $this->description = $description;

        return $this;
    }

    public function getStarter(): ?Starter
    {
        return $this->starter;
    }

    public function setStarter(?Starter $starter): self
    {
        $this->starter = $starter;

        return $this;
    }

    public function getDish(): ?Dish
    {
        return $this->Dish;
    }

    public function setDish(?Dish $Dish): self
    {
        $this->Dish = $Dish;

        return $this;
    }

    public function getDessert(): ?Desserts
    {
        return $this->Dessert;
    }

    public function setDessert(?Desserts $Dessert): self
    {
        $this->Dessert = $Dessert;

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
     * @return Collection<int, Menus>
     */
    public function getMenus(): Collection
    {
        return $this->menus;
    }

    public function addMenu(Menus $menu): self
    {
        if (!$this->menus->contains($menu)) {
            $this->menus->add($menu);
            $menu->setFormule($this);
        }

        return $this;
    }

    public function removeMenu(Menus $menu): self
    {
        if ($this->menus->removeElement($menu)) {
            // set the owning side to null (unless already changed)
            if ($menu->getFormule() === $this) {
                $menu->setFormule(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, Menus>
     */
    public function getDinerSetMenu(): Collection
    {
        return $this->DinerSetMenu;
    }

    public function addDinerSetMenu(Menus $dinerSetMenu): self
    {
        if (!$this->DinerSetMenu->contains($dinerSetMenu)) {
            $this->DinerSetMenu->add($dinerSetMenu);
            $dinerSetMenu->setDinerSetMenu($this);
        }

        return $this;
    }

    public function removeDinerSetMenu(Menus $dinerSetMenu): self
    {
        if ($this->DinerSetMenu->removeElement($dinerSetMenu)) {
            // set the owning side to null (unless already changed)
            if ($dinerSetMenu->getDinerSetMenu() === $this) {
                $dinerSetMenu->setDinerSetMenu(null);
            }
        }

        return $this;
    }
}
