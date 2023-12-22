<?php

declare(strict_types=1);

namespace App\Dto;

use Symfony\Component\Serializer\Attribute\Groups;

final class PricingDto
{
    #[Groups(['service:read'])]
    public float $price;

    #[Groups(['service:read'])]
    public float $priceTotal;
    #[Groups(['service:read'])]
    public int $quantity;
    #[Groups(['service:read'])]
    public int $serviceId;

    public function __construct(
         float $price,
         float $priceTotal,
         int $quantity,
         int $serviceId
    ) {
        $this->price = $price;
        $this->priceTotal = $priceTotal;
        $this->quantity = $quantity;
        $this->serviceId = $serviceId;
    }
}