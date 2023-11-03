<?php

namespace App\EventSubscriber;

use ApiPlatform\Symfony\EventListener\EventPriorities;
use App\Entity\User;
use DateTime;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\HttpKernel\Event\ViewEvent;
use Symfony\Component\HttpKernel\KernelEvents;


class DateCreatedSubscriber implements EventSubscriberInterface
{
    public function onView(ViewEvent $event): void
    {
        $req = $event->getRequest();

        if( $event->getControllerResult() instanceof User ){
            $user = $event->getControllerResult();
            $user->setDateCreated(new DateTime());
        }
    }

    public static function getSubscribedEvents(): array
    {
        return [
            KernelEvents::VIEW => ['onView', EventPriorities::PRE_WRITE],
        ];
    }
}
