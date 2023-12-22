<?php

namespace App\State;

use ApiPlatform\Doctrine\Orm\State\ItemProvider;
use App\Dto\PricingDto;
use ApiPlatform\Metadata\Operation;
use ApiPlatform\State\ProviderInterface;
use Symfony\Component\HttpFoundation\RequestStack;

use function Symfony\Component\DependencyInjection\Loader\Configurator\service;

class PricingProvider implements ProviderInterface
{

    public function __construct(
        private readonly ItemProvider $itemProvider,
    ) {
    }
   
    public function provide(Operation $operation,  array $uriVariables = [], array $context = []): object|array|null
    {
        $idService = $uriVariables['id'];
        $quantity = $context['filters']['quantity'];
        $service = $this->itemProvider->provide($operation,['id' => $idService], $context);
        $serviceId = $service->getId();
      
        $price = $service->getPrice();
        $totalPrice = $price * $quantity;

        return new PricingDto(
            $price,
            $totalPrice,
            $quantity,
            $serviceId
        );
    }
}
