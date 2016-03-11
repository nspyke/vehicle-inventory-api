<?php
/**
 * EngineType Test
 *
 * @author Nik Spijkerman <nikolas.spijkerman@gmail.com>
* @package api
* @category test
* @since 2015.05.29
*/

namespace ApiBundle\Tests\Form;

use ApiBundle\Form\EngineType;
use IMS\CommonBundle\Entity\Engine;
use Symfony\Component\Form\Test\TypeTestCase;
use Symfony\Component\Form\Forms;
use Nelmio\ApiDocBundle\Form\Extension\DescriptionFormTypeExtension;

class EngineTypeTest extends TypeTestCase
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
            'name' => "acbdedsgsdaasdffasdfasdf",
            'cylinders' => 20,
            'valves' => 93,
        ];

        $type = new EngineType();
        $form = $this->factory->create($type);

        $object = new Engine();
        $object->setName("acbdedsgsdaasdffasdfasdf");
        $object->setCylinders(20);
        $object->setValves(93);

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