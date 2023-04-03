<?php

namespace App\Entity;

use App\Repository\MenusRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: MenusRepository::class)]
class Menus
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $name = null;

    #[ORM\ManyToOne(inversedBy: 'menus')]
    private ?SetMenu $LunchSetMenu = null;

    #[ORM\ManyToOne(inversedBy: 'DinerSetMenu')]
    private ?SetMenu $DinerSetMenu = null;

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

    public function getLunchSetMenu(): ?SetMenu
    {
        return $this->LunchSetMenu;
    }

    public function setLunchSetMenu(?SetMenu $LunchSetMenu): self
    {
        $this->LunchSetMenu = $LunchSetMenu;

        return $this;
    }

    public function getDinerSetMenu(): ?SetMenu
    {
        return $this->DinerSetMenu;
    }

    public function setDinerSetMenu(?SetMenu $DinerSetMenu): self
    {
        $this->DinerSetMenu = $DinerSetMenu;

        return $this;
    }
}
