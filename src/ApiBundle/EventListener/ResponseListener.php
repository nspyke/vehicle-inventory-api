<?php
/**
 * 
 *
 * @author Nik Spijkerman <nikspijkerman@gmail.com>
 * @package ims-api
 * @category event-listener
 * @since 2015.05.29
 */

namespace ApiBundle\EventListener;


use Gedmo\Translatable\TranslatableListener;
use Symfony\Component\HttpKernel\Event\FilterResponseEvent;
use Symfony\Component\HttpKernel\KernelEvents;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;

class ResponseListener implements EventSubscriberInterface
{
    private $language;

    public function __construct(TranslatableListener $listener)
    {
        $this->language = $listener->getListenerLocale();
    }

    public function onKernelResponse(FilterResponseEvent $event)
    {
        $event->getResponse()->headers->set('Content-Language', $this->language);
    }

    public static function getSubscribedEvents()
    {
        return array(
            KernelEvents::RESPONSE => 'onKernelResponse',
        );
    }

}