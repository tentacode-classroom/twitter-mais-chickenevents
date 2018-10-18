<?php

namespace App\Controller\User;

use App\Entity\User;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class UserFollowingsController extends AbstractController
{
    /**
     * @Route("/user/{pseudo}/followings", name="user_followings")
     */
    public function index($pseudo = null)
    {
        if (!isset($pseudo)) {
            return $this->render('pages/single-user.html.twig', [
                'user' => false
            ]);
        }

        $user = $this->getDoctrine()->getRepository(User::class)->getUserByUserName($pseudo);

        return $this->render('user/user-followings.twig', [
            'user' => $user
        ]);
    }
}
