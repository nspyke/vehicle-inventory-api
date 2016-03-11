<?php

namespace IMS\CommonBundle\EventListener;

use Gedmo\Translatable\TranslatableListener;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\HttpKernel\Event\GetResponseEvent;
use Symfony\Component\HttpKernel\KernelEvents;

/**
 * This listeners sets the current locale for the TranslatableListener
 *
 */
class LocaleListener implements EventSubscriberInterface
{
    private $translatableListener;

    public function __construct(TranslatableListener $translatableListener)
    {
        $this->translatableListener = $translatableListener;
    }

    /**
     * Set the translation listener locale from the request.
     *
     * This method should be attached to the kernel.request event.
     *
     * @param \Symfony\Component\HttpKernel\Event\GetResponseEvent $event
     */
    public function onKernelRequest(GetResponseEvent $event)
    {
        $request = $event->getRequest();

        $locale = is_null($request->getPreferredLanguage()) ?
            $request->getLocale() :
            $request->getPreferredLanguage();

        $this->translatableListener->setTranslatableLocale($locale);
    }

    public static function getSubscribedEvents()
    {
        return array(
            KernelEvents::REQUEST => 'onKernelRequest',
        );
    }
}
