<?php

namespace AppBundle\Form;

use Doctrine\ORM\EntityRepository;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class CreditInfoType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('date', DateType::class,array(
                'label'=>'Fecha Suceso',
                'html5'=>false,
                'widget'=>'single_text',
                'attr' => ['class' => 'js-datepicker']
            ))
            ->add('description', null, array('label'=>'Descripción'))
            ->add('department', EntityType::class,array(
                'label'=>'Departamento',
                'placeholder'=>'Seleccione',
                'class'=>'AppBundle\Entity\Georeference',
                'query_builder' => function (EntityRepository $er) {
                    return $er->createQueryBuilder('u')
                        ->where('u.city = 0');
                },
                'mapped'=>false
            ))
            ->add('georeferenceId', EntityType::class,array(
                'label'=>'Ciudad',
                'placeholder'=>'Seleccione',
                'query_builder' => function (EntityRepository $er) {
                    return $er->createQueryBuilder('u')
                        ->where('u.city = 1');
                },
                'class'=>'AppBundle\Entity\Georeference'
            ))
            ->add('docs', FileType::class,array(
                'multiple'=>true,
                'label'=>'Pruebas',
                'mapped'=>false
            ));
    }/**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'AppBundle\Entity\CreditInfo'
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'appbundle_creditinfo';
    }


}
