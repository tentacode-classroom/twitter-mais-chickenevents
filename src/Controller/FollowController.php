<?php

namespace App\Controller;

use App\Entity\Follow;
use App\Entity\User;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;

class FollowController extends AbstractController
{
    /**
     * @Route("/follow/{follower}/{following}", name="follow")
     */
    public function index($followerId, $followingId, Request $request)
    {
        $follow = $this->getDoctrine()->getRepository(Follow::class)
            ->findOneFollow($followerId, $followingId);

        $follower = $this->getDoctrine()->getRepository( User::class )
                ->find( $followerId );

        $following = $this->getDoctrine()->getRepository( User::class )
                ->find( $followingId );

        if (count($follow) < 1) {
            $manager = $this->getDoctrine()->getManager();

            $newFollow = new Follow();
            $newFollow->setFollower( $follower );
            $newFollow->setFollowing( $following );

            $manager->persist($follow);
            $manager->flush();
        } else {

        }

        return new Response('Action done', 200 );
    }
}
