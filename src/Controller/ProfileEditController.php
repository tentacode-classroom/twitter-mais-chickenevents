<?php

namespace App\Controller;

use App\Form\RegistrationType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\User;
use Symfony\Component\Security\Core\User\UserInterface;

class ProfileEditController extends AbstractController
{
    /**
     * @Route("/edit/me", name="editer")
     */
    public function update(UserInterface $user)
    {

//        $entityManager = $this->getDoctrine()->getManager();
//
//        $user->setFirstname('Prénom');
//        $entityManager->flush();
//        $user->setLastname('Nom');
//        $entityManager->flush();
//        $user->setPassword('Mot de Passe');
//        $entityManager->flush();
//        $user->setEmail('email');
//        $entityManager->flush();
//        $user->setPseudo('Pseudo');
//        $entityManager->flush();
//        $user->setPicture('Image');
//        $entityManager->flush();

        $form = $this->createForm( RegistrationType::class, $user);

        return $this->redirectToRoute('user/profileEdit.html.twig', [
            'form' => $form->createView(),
        ]);
    }

}
