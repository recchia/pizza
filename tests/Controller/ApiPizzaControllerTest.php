<?php


namespace App\Tests\Controller;


use ApiTestCase\JsonApiTestCase;
use App\Controller\ApiPizzaController;
use App\Entity\Ingredient;
use App\Entity\Pizza;
use App\Repository\PizzaRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Symfony\Component\Serializer\Encoder\JsonEncoder;
use Symfony\Component\Serializer\Normalizer\ObjectNormalizer;
use Symfony\Component\Serializer\Serializer;

class ApiPizzaControllerTest extends JsonApiTestCase
{
    public function testApiPizzaResponse(): void
    {
        $collection = $this->getCollection();

        $repository = $this->createMock(PizzaRepository::class);
        $repository->expects($this->once())
            ->method('getWithIngredients')
            ->willReturn($collection)
        ;

        $encoders = [new JsonEncoder()];
        $normalizers = [new ObjectNormalizer()];
        $serializer = new Serializer($normalizers, $encoders);
        $controller = new ApiPizzaController();

        $response = $controller->getAllPizzas($repository, $serializer);

        $this->assertEquals(200, $response->getStatusCode());
        $this->assertTrue(
            $response->headers->contains(
                'Content-Type',
                'application/json'
            ),
            'the "Content-Type" header is "application/json"'
        );
        $this->assertResponse($response, 'pizzas');
    }

    protected function getCollection(): Collection
    {
        $collection = new ArrayCollection();
        $items = ['Pizza 1', 'Pizza 2'];

        foreach ($items as $item) {
            $pizza = new Pizza();
            $pizza->setName($item);
            $pizza->setPrice(5.25);
            $ingredient1 = new Ingredient();
            $ingredient1->setName('tomato');
            $ingredient2 = new Ingredient();
            $ingredient2->setName('feta cheese');
            $pizza->addIngredient($ingredient1);
            $pizza->addIngredient($ingredient2);
            $collection->add($pizza);

        }

        return $collection;
    }

}