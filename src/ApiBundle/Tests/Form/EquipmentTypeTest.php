<?php
/**
 * 
 *
 * @author Nik Spijkerman <nikspijkerman@gmail.com>
 * @package api
 * @category unit tests
 * @since 2015.05.20
 */

namespace ApiBundle\Tests\Form;


use ApiBundle\Form\EquipmentType;
use IMS\CommonBundle\Entity\Equipment;
use Symfony\Component\Form\Test\TypeTestCase;
use Symfony\Component\Form\Forms;
use Nelmio\ApiDocBundle\Form\Extension\DescriptionFormTypeExtension;

class EquipmentTypeTest extends TypeTestCase
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
            'name' => 'test2',
            'isVerified' => 1
        ];

        $type = new EquipmentType();
        $form = $this->factory->create($type);

        $object = new Equipment();;
        $object->setName('test2');
        $object->setIsVerified(1);

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