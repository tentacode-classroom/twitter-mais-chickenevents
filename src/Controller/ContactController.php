<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\HttpFoundation\Request;
use App\Entity\Contact;

class ContactController extends AbstractController
{
    /**
     * @Route("/contact", name="contact")
     */
    public function index(Request $request, \Swift_Mailer $mailer)
    {
        $contact = new Contact;
        $form = $this->createFormBuilder($contact)
            ->add('email', TextType::class, array('label' => 'email', 'attr' => array('class' => 'form-control', 'style' => 'margin-bottom:15px')))
            ->add('subject', TextType::class, array('label' => 'subject', 'attr' => array('class' => 'form-control', 'style' => 'margin-bottom:15px')))
            ->add('body', TextareaType::class, array('label' => 'message', 'attr' => array('class' => 'form-control')))
            ->add('submit', SubmitType::class, array('label' => 'submit', 'attr' => array('class' => 'btn btn-primary', 'style' => 'margin-top:15px')))
            ->getForm();

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $email = $form['email']->getData();
            $subject = $form['subject']->getData();
            $body = $form['body']->getData();

            $contact->setEmail($email);
            $contact->setSubject($subject);
            $contact->setBody($body);

            $sn = $this->getDoctrine()->getManager();
            $sn->persist($contact);
            $sn->flush();
        }

        if (isset($subject)) {
            $message = (new \Swift_Message($subject))
                ->setFrom('chickenevent@gmail.com')
                ->setTo($email)
                ->setContentType('text/html')
                ->setBody(
                    $this->renderView(
                        'contact/email.html.twig',
                        array('body' => $body)
                    )
                );
            $mailer->send($message);
        }

        return $this->render("contact/index.html.twig", array(
            'form' => $form->createView(),
        ));
    }
}
