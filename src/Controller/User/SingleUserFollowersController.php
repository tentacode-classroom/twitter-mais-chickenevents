<?php

namespace App\Controller\User;

use App\Entity\User;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class SingleUserFollowersController extends AbstractController
{
    /**
     * @Route("/user/{pseudo}/followers", name="user_followers")
     */
    public function index($pseudo = null)
    {
        if (!isset($pseudo)) {
            return $this->render('pages/single-user.html.twig', [
                'user' => false
            ]);
        }

        $user = $this->getDoctrine()->getRepository(User::class)->getUserByUserName($pseudo);

        return $this->render('single-user/single-user-followers.twig', [
            'user'  =>  $user
        ]);
    }
}
