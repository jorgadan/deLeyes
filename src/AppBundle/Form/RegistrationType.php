<?php
/**
 * Created by PhpStorm.
 * User: Jorge
 * Date: 15/10/18
 * Time: 17:09
 */

namespace AppBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\HiddenType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;

class RegistrationType extends AbstractType
{

    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $types = array(
           'Cédula de Ciudadanía' => '1',
           'Tarjeta de identidad' => '2',
           'Cédula de Extranjería' => '3',
           'Pasaporte' => '4',
        );
        $builder
            ->add('name',TextType::class,array('translation_domain' => 'FOSUserBundle','label' => 'form.name'))
            ->add('docType', ChoiceType::class, array(
                'translation_domain' => 'FOSUserBundle',
                'label'=>'form.docType',
                'choices' => $types,
                'invalid_message' => 'invalido'))
            ->add('idNumber',IntegerType::class,array('translation_domain' => 'FOSUserBundle','label' => 'form.identity'))
            ->add('email',TextType::class,array('translation_domain' => 'FOSUserBundle','label' => 'form.email'))
            ->add('telephone', TextType::class,array('translation_domain' => 'FOSUserBundle','label'=>'form.telephone'))
            ->add('username', HiddenType::class, array(
                'data' => 'user'
            ))
            ->add('plainPassword', HiddenType::class, array(
                'data' => 'password'
            ));
    }

    public function getParent()
    {
        return 'FOS\UserBundle\Form\Type\RegistrationFormType';
    }

    public function getBlockPrefix()
    {
        return 'app_user_registration';
    }

    public function getName()
    {
        return $this->getBlockPrefix();
    }
}