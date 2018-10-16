<?php

namespace AppBundle\Form;

use Doctrine\ORM\EntityRepository;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class CompanyType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('name', null, array(
                'label'=>'Nombre de la empresa'
            ))
            ->add('type', ChoiceType::class, array(
                'label'=>'Tipo de empresa',
                'choices'=>array(
                    'SAS' => 1,
                    'SA' => 2,
                    'LTDA' => 3
                )
            ))
            ->add('partners', IntegerType::class, array(
                'label'=>'Número de Accionistas'
            ))
            ->add('capital', null, array(
                'label'=>'Cantidad de capital'
            ))
            ->add('department', EntityType::class,array(
                'label'=>'Departamento',
                'class'=>'AppBundle\Entity\Georeference',
                'query_builder' => function (EntityRepository $er) {
                    return $er->createQueryBuilder('u')
                        ->where('u.city = 0');
                },
                'mapped'=>false
            ))
            ->add('georeferenceId', EntityType::class,array(
                'label'=>'Ciudad',
                'query_builder' => function (EntityRepository $er) {
                    return $er->createQueryBuilder('u')
                        ->where('u.city = 1');
                },
                'class'=>'AppBundle\Entity\Georeference'
            ));
    }/**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'AppBundle\Entity\Company'
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'appbundle_company';
    }


}
