<?php

namespace App\Controller\User;

use App\Entity\User;
use App\Form\RegistrationType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class RegistrationController extends AbstractController
{
    /**
     * @Route("/inscription", name="registration")
     */
    public function index(Request $request, UserPasswordEncoderInterface $encoder, \Swift_Mailer $mailer)
    {
        $user = new User();
        $form = $this->createForm(RegistrationType::class, $user);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $user = $form->getData();

            $plainPassword = $user->getPassword();
            $encryptedPassword = $encoder->encodePassword($user, $plainPassword);
            $user->setPassword($encryptedPassword);

            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($user);
            $entityManager->flush();


            $message = (new \Swift_Message("Bienvenue sur ChickenEvents"))
                ->setFrom('chickenevent@gmail.com')
                ->setTo( $user->getEmail() )
                ->setContentType('text/html')
                ->setBody(
                    $this->renderView(
                        'user/email.html.twig',
                        array('email' => $user->getEmail())
                    )
                );
            $mailer->send($message);


            return $this->redirectToRoute('home');
        }
        return $this->render('user/registration.html.twig', array(
            'form' => $form->createView(),
        ));
    }
}
