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
            ->add('firstname', TextType::class, [
                'label'  => 'Prénom'
            ])
            ->add('lastname', TextType::class, [
                'label'  => 'Nom'
            ])
            ->add('password',PasswordType::class, [
                'label'  => 'Mot de passe'
            ])
            ->add('email', EmailType::class, [
                'label'  => 'Adresse mail'
            ])
            ->add('pseudo', TextType::class, [
                'label'  => 'Nom d\'utilisateur'
            ])
            ->add('birthDate', DateType::class, array(
                'years'=>range($dateBegin,$dateEnd),
                'label'  => 'Date de naissance'
            ))
            ->add("S'inscrire", SubmitType::class);

    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => User::class,
        ]);
    }
}
