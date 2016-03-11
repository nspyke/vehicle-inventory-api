<?php
/**
 * Bodystyle Form 
 *
 * @author Nik Spijkerman <nikspijkerman@gmail.com>
 * @package app
 * @category form
 * @since 2015.05.07
 */
namespace ApiBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class BodystyleType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('name')
            ->add('isVerified')
            ->add('dateAdded', 'datetime', ['widget' => 'single_text'])
            ->add('dateUpdated', 'datetime', ['widget' => 'single_text'])
            ->add('status')
            ->add('manufacturers')
        ;
    }
    
    /**
     * @param OptionsResolver $resolver
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'IMS\CommonBundle\Entity\Bodystyle',
            'csrf_protection' => false
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'bodystyle';
    }
}
