<?php

namespace App\Controller;

use App\Entity\Service;
use App\Entity\ServiceType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ServicesController extends AbstractController
{
    #[Route('api/services/{id}/article', name: 'app_services', methods: 'GET')]
    public function getServicesUri( ServiceType $serviceType): JsonResponse
    {
        $id = $serviceType->getServices();
        
        return $this->json(['services' => $id]);
    }
}
