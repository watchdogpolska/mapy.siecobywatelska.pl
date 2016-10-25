<?php

namespace AppBundle\Form;

use AppBundle\Entity\Icon;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Tetranz\Select2EntityBundle\Form\Type\Select2EntityType;

class PointType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('title')
            ->add('description')
            ->add('icon', Select2EntityType::class, [
                'remote_route' => 'icon_select2_query',
                'class' => Icon::class,
                'placeholder' => 'Select a icon',
                'autostart' => false,
                'transformer' => EntityToPropertyWithImageTransformer::class
            ])
            ->add('latlng', LatLngType::class, array(
                'label' => 'Location'
            ))
        ;
    }

    /**
     * @param OptionsResolver $resolver
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'AppBundle\Entity\Point'
        ));
    }
}
