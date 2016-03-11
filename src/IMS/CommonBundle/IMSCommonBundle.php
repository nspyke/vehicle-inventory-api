<?php
/**
 * IMS CommonBundle
 *
 * @author Nik Spijkerman <nikspijkerman@gmail.com>
 * @package IMS\CommonBundle
 * @category ims
 * @since 2015.05.08
 */
namespace IMS\CommonBundle;

use Doctrine\ORM\Events;
use IMS\CommonBundle\EventListener\LoadClassMetadata;
use Symfony\Component\HttpKernel\Bundle\Bundle;

class IMSCommonBundle extends Bundle
{
    public function boot()
    {
        /** @var \Doctrine\ORM\EntityManager $em */
        // Get the Entity Manager
        $em = $this->container->get('doctrine.orm.default_entity_manager');

        // Get the defined event listener
        $listener = $this->container->get('ims_common.event_listener.load_class_metadata');

        // Get the event manager and add the event listener
        $em ->getEventManager()
            ->addEventListener(Events::loadClassMetadata, $listener)
        ;
    }

}