<?php


namespace App\Controller;


use App\Repository\PizzaRepository;
use FOS\RestBundle\Controller\Annotations as Rest;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Serializer\SerializerInterface;

final class ApiPizzaController
{
    /**
     * @Rest\Get("api/pizzas", name="get_pizzas")
     *
     * @param PizzaRepository $pizzaRepository
     * @param SerializerInterface $serializer
     * @return JsonResponse
     */
    public function getAllPizzas(PizzaRepository $pizzaRepository, SerializerInterface $serializer): JsonResponse
    {
        $pizzas = $pizzaRepository->getWithIngredients();
        $data = $serializer->serialize($pizzas, 'json', ['groups' => ['pizza']]);

        return new JsonResponse($data, Response::HTTP_OK, [], true);
    }

}