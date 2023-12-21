<?php

namespace App\State;

use ApiPlatform\Doctrine\Orm\State\ItemProvider;
use App\Dto\PricingDto;
use ApiPlatform\Metadata\Operation;
use ApiPlatform\State\ProviderInterface;

class PricingProvider implements ProviderInterface
{
    public function __construct(
        private readonly ItemProvider $itemProvider,
    ) {
    }
    public function provide(Operation $operation, array $uriVariables = [], array $context = []): object|array|null
    {
        $service = $this->itemProvider->provide($operation, $uriVariables, $context);

        $quantity = $service->getQuantity();
        $quantity++;
        $price = $service->getPrice();
        $totalPrice = $price * $quantity;
        
        return new PricingDto(
            $price,
            $quantity,
            $totalPrice,
        );
    }
}