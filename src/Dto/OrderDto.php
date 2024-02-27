<?php

declare(strict_types=1);

namespace App\Dto;

use Symfony\Component\Serializer\Attribute\Groups;

final class OrderDto
{
    #[Groups(['service:read'])]
    public float $employee;

    public function __construct(
        string $employee,

    ) {
        $this->employee = $employee;
    }
}
