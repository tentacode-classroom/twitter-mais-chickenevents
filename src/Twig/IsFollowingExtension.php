<?php

namespace App\Twig;

use App\Entity\User;
use Doctrine\Common\Collections\ArrayCollection;
use Twig\Extension\AbstractExtension;
use Twig\TwigFilter;
use Twig\TwigFunction;

class IsFollowingExtension extends AbstractExtension
{
    public function getFilters(): array
    {
        return [
            // If your filter generates SAFE HTML, you should add a third
            // parameter: ['is_safe' => ['html']]
            // Reference: https://twig.symfony.com/doc/2.x/advanced.html#automatic-escaping
            new TwigFilter('is_following', [$this, 'isFollowing']),
        ];
    }

    public function isFollowing($user, $searchUser )
    {

        foreach ($user->getFollowings() as $follow ) {
            if ( $follow->getFollowing() == $searchUser ) {
                return true;
            }
        }

        return false;
    }
}
