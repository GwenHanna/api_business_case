<?php

namespace App\Controller;

use App\Entity\Service;
use App\Entity\ServiceType;
use Doctrine\ORM\PersistentCollection;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ServicesController extends AbstractController
{

    #[Route('api/services/{id}/article', name: 'app_services', methods: 'GET')]
    public function getServicesUri( ServiceType $serviceType): JsonResponse
    {
        $services = $serviceType->getServices();
        $serviceTypeDetails = [
            'id' => $serviceType->getId(),
            'name' => $serviceType->getName(),
        ];

        $servicesWithDetails = [];
        foreach ($services as $service) {
            $serviceArray = [
                'id' => $service->getId(),
                'name' => $service->getName(),
                'price' => $service->getPrice(),
                'picture' => $service->getPicture()
            ];

            $serviceArray['serviceType'] = $serviceTypeDetails;
            $servicesWithDetails[] = $serviceArray;
        }

        // Renvoyer la réponse JSON avec les détails du ServiceType
        return $this->json(['services' => $servicesWithDetails]);
    }
}
