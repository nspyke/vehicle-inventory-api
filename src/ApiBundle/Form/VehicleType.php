<?php

namespace ApiBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class VehicleType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('vin')
            ->add('reg')
            ->add('vehicleStatus')
            ->add('doors')
            ->add('seats')
            ->add('drive')
            ->add('odometer')
            ->add('odometerCanonical')
            ->add('odometerUnit')
            ->add('dateRegistered', 'date', ['widget' => 'single_text'])
            ->add('dateAdded', 'datetime', ['widget' => 'single_text'])
            ->add('dateUpdated', 'datetime', ['widget' => 'single_text'])
            ->add('addedBy')
            ->add('updatedBy')
            ->add('isNew')
            ->add('isManufacturerApproved')
            ->add('isFeatured')
            ->add('isVisible')
            ->add('status')
            ->add('manufacturer', null, ['description' => 'ID of this association'])
            ->add('model', null, ['description' => 'ID of this association'])
            ->add('variant', null, ['description' => 'ID of this association'])
            ->add('dealer', null, ['description' => 'ID of this association'])
            ->add('transmission', null, ['description' => 'ID of this association'])
            ->add('engine', null, ['description' => 'ID of this association'])
            ->add('bodystyle', null, ['description' => 'ID of this association'])
            ->add('colourExterior', null, ['description' => 'ID of this association'])
            ->add('trim', null, ['description' => 'ID of this association'])
            ->add('trimMaterial', null, ['description' => 'ID of this association'])
            ->add('trimShade', null, ['description' => 'ID of this association'])
            ->add('wheelbase', null, ['description' => 'ID of this association'])
            ->add('technicalSpecificationData', null, ['description' => 'ID of this association'])
            ->add('package', null, ['description' => 'ID of this association'])
            ->add('equipment', null, ['description' => 'ID of this association'])
        ;
    }

    /**
     * @param OptionsResolver $resolver
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'IMS\CommonBundle\Entity\Vehicle',
            'csrf_protection' => false
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'vehicle';
    }
}
