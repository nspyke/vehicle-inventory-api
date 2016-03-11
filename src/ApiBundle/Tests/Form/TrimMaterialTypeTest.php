<?php
/**
 * TrimMaterialType Test
 *
 * @author Nik Spijkerman <nikspijkerman@gmail.com>
* @package api
* @category test
* @since 2015.05.29
*/

namespace ApiBundle\Tests\Form;

use ApiBundle\Form\TrimMaterialType;
use IMS\CommonBundle\Entity\TrimMaterial;
use Symfony\Component\Form\Test\TypeTestCase;
use Symfony\Component\Form\Forms;
use Nelmio\ApiDocBundle\Form\Extension\DescriptionFormTypeExtension;

class TrimMaterialTypeTest extends TypeTestCase
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
            'status' => 1,
        ];

        $type = new TrimMaterialType();
        $form = $this->factory->create($type);

        $object = new TrimMaterial();
        $object->setName("acbdedsgsdaasdffasdfasdf");
        $object->setStatus(1);

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