<?php
/**
 * 
 *
 * @author Nik Spijkerman <nikspijkerman@gmail.com>
 * @package 
 * @category 
 * @since 2015.05.21
 */

namespace ApiBundle\Tests\Serializer;

use FOS\RestBundle\Serializer\ExceptionWrapperSerializeHandler;
use FOS\RestBundle\Util\ExceptionWrapper;
use FOS\RestBundle\View\ExceptionWrapperHandler;
use FOS\RestBundle\View\View;
use FOS\RestBundle\View\ViewHandler;
use ApiBundle\Serializer\FormErrorHandler;
use JMS\Serializer\Handler\HandlerRegistry;
use JMS\Serializer\SerializerBuilder;
use FOS\RestBundle\Util\Codes;
use Symfony\Component\DependencyInjection\Container;
use Symfony\Component\Form\Form;
use Symfony\Component\Form\FormError;
use Symfony\Component\Form\Forms;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Form\FormView;

class FormErrorHandlerTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @dataProvider exceptionWrapperSerializeResponseContentProvider
     * @param string $format
     */
    public function testCreateResponseWithFormErrorsAndSerializationGroups($format)
    {
        $form = Forms::createFormFactory()->createBuilder()
            ->add('name', 'text')
            ->add('description', 'text')
            ->getForm();

        $form->get('name')->addError(new FormError('Invalid name'));

        $exceptionWrapper = new ExceptionWrapper(
            array(
                'status_code' => 400,
                'message' => 'Validation Failed',
                'errors' => $form,
            )
        );

        $view = new View($exceptionWrapper);
        $view->getSerializationContext()->setGroups(array('Custom'));

        $wrapperHandler = new ExceptionWrapperSerializeHandler();
        $translatorMock = $this->getMock(
            'Symfony\\Component\\Translation\\TranslatorInterface',
            array('trans', 'transChoice', 'setLocale', 'getLocale')
        );
        $translatorMock
            ->expects($this->any())
            ->method('trans')
            ->will($this->returnArgument(0));

        $formErrorHandler = new FormErrorHandler($translatorMock);

        $serializer = SerializerBuilder::create()
            ->configureHandlers(function (HandlerRegistry $handlerRegistry) use ($wrapperHandler, $formErrorHandler) {
                $handlerRegistry->registerSubscribingHandler($wrapperHandler);
                $handlerRegistry->registerSubscribingHandler($formErrorHandler);
            })
            ->build();

        $container = $this->getMock('Symfony\Component\DependencyInjection\Container', array('get'));
        $container
            ->expects($this->once())
            ->method('get')
            ->with('fos_rest.serializer')
            ->will($this->returnValue($serializer));

        $viewHandler = new ViewHandler(array());
        $viewHandler->setContainer($container);

        $response = $viewHandler->createResponse($view, new Request(), $format);

        $serializer2 = SerializerBuilder::create()
            ->configureHandlers(function (HandlerRegistry $handlerRegistry) use ($wrapperHandler, $formErrorHandler) {
                $handlerRegistry->registerSubscribingHandler($formErrorHandler);
            })
            ->build();

        $container2 = $this->getMock('Symfony\Component\DependencyInjection\Container', array('get'));
        $container2
            ->expects($this->once())
            ->method('get')
            ->with('fos_rest.serializer')
            ->will($this->returnValue($serializer2));

        $viewHandler = new ViewHandler(array());
        $viewHandler->setContainer($container2);

        $view2 = new View($exceptionWrapper);
        $response2 = $viewHandler->createResponse($view2, new Request(), $format);

        $this->assertEquals($response->getContent(), $response2->getContent());
    }

    /**
     * @return array
     */
    public function exceptionWrapperSerializeResponseContentProvider()
    {
        return array(
            'json' => array('json'),
        );
    }
}
