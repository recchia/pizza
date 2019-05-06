<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;

/**
 * @ORM\Entity(repositoryClass="App\Repository\PizzaRepository")
 * @ORM\EntityListeners({"App\Doctrine\Listener\PizzaListener"})
 */
class Pizza
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     * @Groups({"pizza"})
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     * @Groups({"pizza"})
     */
    private $name;

    /**
     * @ORM\Column(type="decimal", precision=5, scale=2)
     * @Groups({"pizza"})
     */
    private $price;

    /**
     * @ORM\ManyToMany(targetEntity="App\Entity\Ingredient", inversedBy="pizzas")
     * @Groups({"pizza"})
     */
    private $ingredients;

    public function __construct()
    {
        $this->ingredients = new ArrayCollection();
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

    public function getPrice(): ?float
    {
        return $this->price;
    }

    public function setPrice(float $price): self
    {
        $this->price = $price;

        return $this;
    }

    /**
     * @return Collection|Ingredient[]
     */
    public function getIngredients(): Collection
    {
        return $this->ingredients;
    }

    public function addIngredient(Ingredient $ingredient): self
    {
        if (!$this->ingredients->contains($ingredient)) {
            $this->ingredients[] = $ingredient;
        }

        return $this;
    }

    public function removeIngredient(Ingredient $ingredient): self
    {
        if ($this->ingredients->contains($ingredient)) {
            $this->ingredients->removeElement($ingredient);
        }

        return $this;
    }

    public function __toString()
    {
        return (string)$this->getName();
    }
}
