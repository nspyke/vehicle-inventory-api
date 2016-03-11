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


use ApiBundle\Form\ModelType;
use IMS\CommonBundle\Entity\Engine;
use IMS\CommonBundle\Entity\Equipment;
use IMS\CommonBundle\Entity\Model;
use IMS\CommonBundle\Entity\Variant;
use Symfony\Component\Form\Test\TypeTestCase;
use Symfony\Component\Form\Forms;
use Nelmio\ApiDocBundle\Form\Extension\DescriptionFormTypeExtension;

class ModelTypeTest extends TypeTestCase
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
            'isVerified' => 1,
        ];

        $type = new ModelType();
        $form = $this->factory->create($type);

        $object = new Model();;
        $object->setName('test2');
        $object->setIsVerified(1);

        // submit the data to the form directly
        $form->submit($formData, false);

        $this->assertTrue($form->isSynchronized());

        $view = $form->createView();
        $children = $view->children;

        foreach (array_keys($formData) as $key) {
            $this->assertArrayHasKey($key, $children);
        }
    }
}