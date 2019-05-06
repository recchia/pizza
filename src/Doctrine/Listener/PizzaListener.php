<?php


namespace App\Doctrine\Listener;


use App\Entity\Ingredient;
use App\Entity\Pizza;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Event\LifecycleEventArgs;
use Doctrine\ORM\Event\PreUpdateEventArgs;
use Doctrine\ORM\Mapping as ORM;

class PizzaListener
{
    /**
     * @var float
     */
    private $subtotal;

    /**
     * PizzaListener constructor.
     */
    public function __construct()
    {
        $this->subtotal = 0;
    }

    /**
     * @param Pizza $pizza
     * @param LifecycleEventArgs $eventArgs
     *
     * @ORM\PrePersist()
     */
    public function prePersistHandler(Pizza $pizza, LifecycleEventArgs $eventArgs): void
    {
        $ingredients = $pizza->getIngredients();

        $pizza->setPrice($this->calculatePrice($ingredients));
    }

    /**
     * @param Pizza $pizza
     * @param PreUpdateEventArgs $eventArgs
     *
     * @ORM\PreUpdate()
     */
    public function preUpdateHandler(Pizza $pizza, PreUpdateEventArgs $eventArgs): void
    {
        $ingredients = $pizza->getIngredients();

        $pizza->setPrice($this->calculatePrice($ingredients));
    }

    /**
     * @param Collection|Ingredient[] $collection
     * @return float|int|null
     */
    protected function calculatePrice(Collection $collection) : float
    {
        foreach ($collection as $item) {
            $this->subtotal += $item->getPrice();
        }

        return $this->subtotal + ($this->subtotal * 0.5);
    }

}