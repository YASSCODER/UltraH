<?php

namespace App\Entity;

use App\Repository\PlatRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: PlatRepository::class)]
class Plat
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 30)]
    private ?string $titre = null;

    #[ORM\Column]
    private ?int $caloris = null;

    #[ORM\ManyToMany(targetEntity: Ingrediant::class, inversedBy: 'plats')]
    private Collection $ingrediants;

    #[ORM\ManyToMany(targetEntity: Menu::class, inversedBy: 'plats')]
    private Collection $menus;

    public function __construct()
    {
        $this->ingrediants = new ArrayCollection();
        $this->menus = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTitre(): ?string
    {
        return $this->titre;
    }

    public function setTitre(string $titre): self
    {
        $this->titre = $titre;

        return $this;
    }

    public function getCaloris(): ?int
    {
        return $this->caloris;
    }

    public function setCaloris(int $caloris): self
    {
        $this->caloris = $caloris;

        return $this;
    }

    /**
     * @return Collection<int, Ingrediant>
     */
    public function getIngrediants(): Collection
    {
        return $this->ingrediants;
    }

    public function addIngrediant(Ingrediant $ingrediant): self
    {
        if (!$this->ingrediants->contains($ingrediant)) {
            $this->ingrediants->add($ingrediant);
        }

        return $this;
    }

    public function removeIngrediant(Ingrediant $ingrediant): self
    {
        $this->ingrediants->removeElement($ingrediant);

        return $this;
    }

    /**
     * @return Collection<int, Menu>
     */
    public function getMenus(): Collection
    {
        return $this->menus;
    }

    public function addMenu(Menu $menu): self
    {
        if (!$this->menus->contains($menu)) {
            $this->menus->add($menu);
        }

        return $this;
    }

    public function removeMenu(Menu $menu): self
    {
        $this->menus->removeElement($menu);

        return $this;
    }
    public function __toString()
    {
        return $this->titre;
    }
}
