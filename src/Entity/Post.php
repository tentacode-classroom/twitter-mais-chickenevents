<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\PostRepository")
 */
class Post
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="datetime")
     */
    private $dateCreated;

    /**
     * @ORM\Column(type="text")
     */
    private $message;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\User", inversedBy="posts")
     * @ORM\JoinColumn(nullable=false)
     */
    private $user;

    /**
     * @ORM\ManyToMany(targetEntity="App\Entity\User", inversedBy="postsTimeline")
     */
    private $userTimeline;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Like", mappedBy="post")
     */
    private $likes;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Like", mappedBy="liker")
     */
    private $liker;

    public function __construct()
    {
        $this->dateCreated = new \DateTime();
        $this->userTimeline = new ArrayCollection();
        $this->likes = new ArrayCollection();
        $this->liker = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getDateCreated(): ?\DateTimeInterface
    {
        return $this->dateCreated;
    }

    public function setDateCreated(\DateTimeInterface $dateCreated): self
    {
        $this->dateCreated = $dateCreated;

        return $this;
    }

    public function getMessage(): ?string
    {
        return $this->message;
    }

    public function setMessage(string $message): self
    {
        $this->message = $message;

        return $this;
    }

    public function getUser(): ?User
    {
        return $this->user;
    }

    public function setUser(?User $user): self
    {
        $this->user = $user;

        return $this;
    }

    /**
     * @return Collection|User[]
     */
    public function getUserTimeline(): Collection
    {
        return $this->userTimeline;
    }

    public function addUserTimeline(User $userTimeline): self
    {
        if (!$this->userTimeline->contains($userTimeline)) {
            $this->userTimeline[] = $userTimeline;
        }

        return $this;
    }

    public function removeUserTimeline(User $userTimeline): self
    {
        if ($this->userTimeline->contains($userTimeline)) {
            $this->userTimeline->removeElement($userTimeline);
        }

        return $this;
    }

    /**
     * @return Collection|Like[]
     */
    public function getLikes(): Collection
    {
        return $this->likes;
    }

    public function addLike(Like $like): self
    {
        if (!$this->likes->contains($like)) {
            $this->likes[] = $like;
            $like->setPost($this);
        }

        return $this;
    }

    public function removeLike(Like $like): self
    {
        if ($this->likes->contains($like)) {
            $this->likes->removeElement($like);
            // set the owning side to null (unless already changed)
            if ($like->getPost() === $this) {
                $like->setPost(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|Like[]
     */
    public function getLiker(): Collection
    {
        return $this->liker;
    }

    public function addLiker(Like $liker): self
    {
        if (!$this->liker->contains($liker)) {
            $this->liker[] = $liker;
            $liker->setLiker($this);
        }

        return $this;
    }

    public function removeLiker(Like $liker): self
    {
        if ($this->liker->contains($liker)) {
            $this->liker->removeElement($liker);
            // set the owning side to null (unless already changed)
            if ($liker->getLiker() === $this) {
                $liker->setLiker(null);
            }
        }

        return $this;
    }
}
