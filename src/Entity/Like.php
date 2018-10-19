<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\LikeRepository")
 * @ORM\Table(name="post_like")
 */
class Like
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\post", inversedBy="likes")
     * @ORM\JoinColumn(nullable=false)
     */
    private $post;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\post", inversedBy="liker")
     * @ORM\JoinColumn(nullable=false)
     */
    private $liker;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getPost(): ?post
    {
        return $this->post;
    }

    public function setPost(?post $post): self
    {
        $this->post = $post;

        return $this;
    }

    public function getLiker(): ?post
    {
        return $this->liker;
    }

    public function setLiker(?post $liker): self
    {
        $this->liker = $liker;

        return $this;
    }
}
