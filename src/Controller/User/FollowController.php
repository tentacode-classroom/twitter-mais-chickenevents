<?php

namespace App\Controller\User;

use App\Entity\Follow;
use App\Entity\User;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\User\UserInterface;

class FollowController extends AbstractController
{
    /**
     * @Route("/follow/{followingId}", name="follow")
     */
    public function index($followingId, UserInterface $user)
    {
        $manager = $this->getDoctrine()->getManager();

        $follow = $this->getDoctrine()->getRepository(Follow::class)
            ->findOneFollow($user->getId(), $followingId);

        $follower = $user;

        $following = $this->getDoctrine()->getRepository( User::class )
                ->find( $followingId );

        if (count($follow) < 1) {
            $newFollow = new Follow();
            $newFollow->setFollower( $follower );
            $newFollow->setFollowing( $following );

            $manager->persist($newFollow);
            $manager->flush();
            return new Response('Follow', 200 );
        } else {
            $manager->remove( $follow[0] );
            $manager->flush();
            return new Response('Unfollow', 200 );
        }

    }
}
