<?php
// Auto-generated by the console command generate:doctrine:fixtures
// WARNING: Manual editing will be lost when command is run again

namespace AppBundle\DataFixtures\ORM;

use IMS\CommonBundle\Entity\Location;
use AppBundle\DataFixtures\BaseFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;

class LoadLocationData extends BaseFixture implements OrderedFixtureInterface
{
    /**
     * Load data fixtures with the passed EntityManager
     *
     * @param ObjectManager $manager
     */
    public function load(ObjectManager $manager)
    {
        
        for ($i = 0; $i < 30; $i++) {
            $entity = new Location();

            $entity->setName($this->randomPronounceableWord(1, 10));
            $entity->setCity($this->randomPronounceableWord(1, 10));
            $entity->setState($this->randomPronounceableWord(1, 10));
            $entity->setPostalCode($this->randomPronounceableWord(1, 2));
            $entity->setLongitude(mt_rand(1,100));
            $entity->setLatitude(mt_rand(1,100));
            $entity->setIsVerified(rand(0, 1) ? false : true);
            $entity->setDateAdded(new \DateTime());
            $entity->setDateUpdated(new \DateTime());
            $entity->setStatus(1);
            $entity->setCountry($this->getReference('IMS_CommonBundle_Entity_Country'.$i));
            
            $manager->persist($entity);
            $this->addReference('IMS_CommonBundle_Entity_Location'.$i, $entity);
        }

        $manager->flush();
    }

    /**
     * Get the order of this fixture
     *
     * @return integer
     */
    public function getOrder()
    {
        return 13;
    }

}