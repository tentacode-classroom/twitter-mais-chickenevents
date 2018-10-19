<?php

namespace App\Controller\User;

use App\Form\ProfileEditType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\User;
use Symfony\Component\Security\Core\User\UserInterface;


class ProfileEditController extends AbstractController
{
    /**
     * @Route("/edit/me", name="profileEdit")
     */
    public function update(UserInterface $user, Request $request)
    {

        $form = $this->createForm( ProfileEditType::class, $user);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $user = $form->getData();


            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($user);
            $entityManager->flush();
        }

            return $this->render('user/profile-edit.html.twig', [
            'form' => $form->createView(),
        ]);
    }

}
