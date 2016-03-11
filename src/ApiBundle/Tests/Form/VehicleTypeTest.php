<?php
/**
 * 
 *
 * @author Nik Spijkerman <nikspijkerman@gmail.com>
 * @package 
 * @category 
 * @since 2015.05.20
 */

namespace ApiBundle\Tests\Form;


use ApiBundle\Form\VehicleType;
use IMS\CommonBundle\Entity\Vehicle;
use Symfony\Component\Form\Test\TypeTestCase;
use Symfony\Component\Form\Forms;
use Nelmio\ApiDocBundle\Form\Extension\DescriptionFormTypeExtension;

class VehicleTypeTest extends TypeTestCase
{
    protected function setUp()
    {
        parent::setUp();

        $this->factory = Forms::createFormFactoryBuilder()
            ->addExtensions($this->getExtensions())
            ->addTypeExtension(
                new DescriptionFormTypeExtension()
            )
            ->getFormFactory();

        $this->builder->setFormFactory($this->factory);
    }

    public function testSubmitValidData()
    {
        $formData = [
            'vin' => 'vin1234',
            'doors' => 4
        ];

        $type = new VehicleType();
        $form = $this->factory->create($type);

        $object = new Vehicle();;
        $object->setVin('vin1234');
        $object->setDoors(4);

        // submit the data to the form directly
        $form->submit($formData);

        $this->assertTrue($form->isSynchronized());

        $view = $form->createView();
        $children = $view->children;

        foreach (array_keys($formData) as $key) {
            $this->assertArrayHasKey($key, $children);
        }
    }
}