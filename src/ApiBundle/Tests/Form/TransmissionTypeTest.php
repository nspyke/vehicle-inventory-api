<?php
/**
 * TransmissionType Test
 *
 * @author Nik Spijkerman <nikspijkerman@gmail.com>
* @package api
* @category test
* @since 2015.05.29
*/

namespace ApiBundle\Tests\Form;

use ApiBundle\Form\TransmissionType;
use IMS\CommonBundle\Entity\Transmission;
use Symfony\Component\Form\Test\TypeTestCase;
use Symfony\Component\Form\Forms;
use Nelmio\ApiDocBundle\Form\Extension\DescriptionFormTypeExtension;

class TransmissionTypeTest extends TypeTestCase
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
            'dateAdded' => "2015-05-29T16:01:18+01:00",
            'dateUpdated' => "2015-05-29T16:01:18+01:00",
        ];

        $type = new TransmissionType();
        $form = $this->factory->create($type);

        $object = new Transmission();
        $object->setName("acbdedsgsdaasdffasdfasdf");
        $object->setDateAdded("2015-05-29T16:01:18+01:00");
        $object->setDateUpdated("2015-05-29T16:01:18+01:00");

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