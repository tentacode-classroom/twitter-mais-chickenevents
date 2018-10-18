<?php

namespace App\Form;

use App\Entity\User;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;

class RegistrationType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $dateBegin = date( 'Y' ) - 100;
        $dateEnd = date( 'Y' ) - 13;
        $builder
            ->add('firstname')
            ->add('lastname')
            ->add('password',PasswordType::class)
            ->add('email', EmailType::class)
            ->add('pseudo', TextType::class)
            ->add('birthDate', DateType::class, array(
                'years'=>range($dateBegin,$dateEnd)
            ))
            ->add("Register", SubmitType::class);

    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => User::class,
        ]);
    }
}
