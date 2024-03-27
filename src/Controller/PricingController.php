<?php

namespace App\Controller;

use App\Entity\Article;
use ContainerGtOxGLx\getUserRepositoryService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpClient\HttpClient;

class PricingController extends AbstractController
{

    // #[Route('api/services/{id}/pricing', name: 'selection_pricing', methods: 'GET', stateless: false)]
    // public function index(Article $service, SessionInterface $session): Response
    // {
    //     $user = $this->getUser();


    //     // Calculer le prix total
    //     $price = $service->getPrice();
    //     $sum = $price * $quantity;


    //     return $this->json(['price' => $price, 'quantity' => $quantity ,'priceTotal' => $sum]);
    // }
}
