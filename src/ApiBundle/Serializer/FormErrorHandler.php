<?php

namespace ApiBundle\Serializer;

use JMS\Serializer\YamlSerializationVisitor;
use JMS\Serializer\JsonSerializationVisitor;
use JMS\Serializer\GraphNavigator;
use JMS\Serializer\GenericSerializationVisitor;
use Symfony\Component\Form\Form;
use Symfony\Component\Form\FormError;
use Symfony\Component\Translation\TranslatorInterface;
use JMS\Serializer\XmlSerializationVisitor;


class FormErrorHandler extends \JMS\Serializer\Handler\FormErrorHandler
{
    private $translator;

    public function __construct(TranslatorInterface $translator)
    {
        $this->translator = $translator;
    }

    public function serializeFormToJson(JsonSerializationVisitor $visitor, Form $form, array $type)
    {
        return $this->convertFormToArray($visitor, $form);
    }

    private function getErrorMessage(FormError $error)
    {
        if (null !== $error->getMessagePluralization()) {
            return $this->translator->transChoice($error->getMessageTemplate(), $error->getMessagePluralization(), $error->getMessageParameters(), 'validators');
        }

        return $this->translator->trans($error->getMessageTemplate(), $error->getMessageParameters(), 'validators');
    }

    private function convertFormToArray(GenericSerializationVisitor $visitor, Form $data)
    {
        $isRoot = null === $visitor->getRoot();

        $form = $errors = array();
        foreach ($data->getErrors() as $error) {
            $errors[] = $this->getErrorMessage($error);
        }

        if ($errors) {
            $form['errors'] = $errors;
        }

        $children = array();
        foreach ($data->all() as $child) {
            if ($child instanceof Form) {
                $childArray = $this->convertFormToArray($visitor, $child);
                if (!empty($childArray)) {
                    $children[$child->getName()] = $childArray;
                }
            }
        }

        if ($children) {
            $form[$data->getName() ?: 'children'] = $children;
        }

        if ($isRoot) {
            $visitor->setRoot($form);
        }

        return $form;
    }
}