<?php
/**
 * Manufacturer Form 
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

class ManufacturerType extends AbstractType
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
            ->add('code')
            ->add('bodystyles')
            ->add('colours')
            ->add('dealers')
            ->add('engines')
            ->add('equipment')
            ->add('models')
            ->add('transmissions')
            ->add('trims')
            ->add('trimMaterials')
            ->add('variants')
            ->add('wheelbases')
        ;
    }

    /**
     * @param OptionsResolver $resolver
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'IMS\CommonBundle\Entity\Manufacturer',
            'csrf_protection' => false
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'manufacturer';
    }
}
