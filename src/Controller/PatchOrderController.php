<?php

namespace App\Controller;

use App\Dto\OrderDto;
use App\Entity\Order;
use App\Entity\User;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Component\Routing\Annotation\Route;

class PatchOrderController extends AbstractController
{
    private $entityManager;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    #[Route('/api/orders/{id}', name: 'app_patch_order')]
    public function patchAction(Request $request, Order $order): Response
    {
        $data = $request->get('data');

        // Find the employee using the repository
        $employee = $this->entityManager->getRepository(User::class)->find($data['employee_id']);

        if (!$employee) {
            throw new NotFoundHttpException('Employé non trouvé');
        }

        // Update the order's employee
        $order->setEmployee($employee);

        // Persist and flush changes
        $this->entityManager->persist($order);
        $this->entityManager->flush();

        return $this->json($order, Response::HTTP_OK, [], ['groups' => ['order:read']]);
    }
}
