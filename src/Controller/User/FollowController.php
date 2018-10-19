<?php

namespace App\Controller\User;

use App\Entity\Follow;
use App\Entity\User;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\User\UserInterface;

class FollowController extends AbstractController
{
    /**
     * @Route("/follows/{followingId}", name="follow")
     */
    public function index($followingId, UserInterface $user, Request $request)
    {
        $action = $request->get( 'action' );
        $manager = $this->getDoctrine()->getManager();
        $follow = $this->getDoctrine()->getRepository(Follow::class)
            ->findOneFollow($user->getId(), $followingId);


        if ($action === 'follow' && !isset($follow)) {
            $follower = $user;
            $following = $this->getDoctrine()->getRepository(User::class)
                ->find($followingId);

            $newFollow = new Follow();
            $newFollow->setFollower($follower);
            $newFollow->setFollowing($following);

            $manager->persist($newFollow);
            $manager->flush();
            return new Response('Follow', 200);
        } else if ( $action === 'unfollow' && isset($follow) ) {
            $manager->remove($follow);
            $manager->flush();
            return new Response('Unfollow', 200);
        } else {
            return new Response('error', 400);
        }

    }
}
