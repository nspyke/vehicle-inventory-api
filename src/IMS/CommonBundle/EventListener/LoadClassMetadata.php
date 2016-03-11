<?php
/**
 * Doctrine event listener to load class meta data from independent configuration
 *
 * @author Nik Spijkerman <nikspijkerman@gmail.com>
 * @package ims-common
 * @category Event Listener
 * @since 2015.05.08
 */

namespace IMS\CommonBundle\EventListener;

use Doctrine\ORM\Event\LoadClassMetadataEventArgs;
use Doctrine\ORM\Events;

class LoadClassMetadata
{
    /**
     * @var array
     */
    protected $metadata;

    /**
     * @param array $metadata
     */
    public function __construct($metadata = [])
    {
        $this->metadata = $metadata;
    }

    /**
     * @param LoadClassMetadataEventArgs $eventArgs
     */
    public function loadClassMetadata(LoadClassMetadataEventArgs $eventArgs)
    {
        /** @var \Doctrine\ORM\Mapping\ClassMetadata $classMetadata */
        $classMetadata = $eventArgs->getClassMetadata();
        $className = $classMetadata->getName();

        if (isset($this->metadata[$className])) {
            if (isset($this->metadata[$className]['repositoryClass'])) {
                $classMetadata->setCustomRepositoryClass($this->metadata[$className]['repositoryClass']);
            }
        }
    }

    /**
     * @return array
     */
    public function getSubscribedEvents()
    {
        return array(
            Events::loadClassMetadata
        );
    }
}