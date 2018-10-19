<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Symfony\Component\HttpFoundation\File\UploadedFile;
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
     * @ORM\JoinTable(name="user_timeline")
     */
    private $userTimeline;

    /**
     * @ORM\ManyToMany(targetEntity="App\Entity\User", inversedBy="postsLike")
     * @ORM\JoinTable(name="user_likes")
     */
    private $likes;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $pictureFileName;

    private $picture;

    public function __construct()
    {
        $this->dateCreated = new \DateTime();
        $this->userTimeline = new ArrayCollection();
        $this->likes = new ArrayCollection();
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
     * @return Collection|User[]
     */
    public function getLikes(): Collection
    {
        return $this->likes;
    }

    public function addLike(User $like): self
    {
        if (!$this->likes->contains($like)) {
            $this->likes[] = $like;
        }

        return $this;
    }

    public function removeLike(User $like): self
    {
        if ($this->likes->contains($like)) {
            $this->likes->removeElement($like);
        }

        return $this;
    }

    public function getPictureFileName(): ?string
    {
        return $this->pictureFileName;
    }

    public function setPictureFileName(?string $pictureFileName): self
    {
        $this->pictureFileName = $pictureFileName;

        return $this;
    }

    public function getPicture(): ?UploadedFile
    {
        return $this->picture;
    }

    public function setPicture(UploadedFile $picture): self
    {
        $this->picture = $picture;

        return $this;
    }
}
