<?php

namespace App\Controller\User;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class RegistrationController extends AbstractController
{
    /**
     * @Route("/inscription", name="registration")
     */
    public function index()
    {
        return $this->render('user/login.html.twig', [
            'controller_name' => 'RegistrationController',
        ]);
    }
}
