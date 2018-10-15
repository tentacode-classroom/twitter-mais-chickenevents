<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Validator\Constraints as Assert;



/**
 * @ORM\Entity(repositoryClass="App\Repository\UserRepository")
 */
class User implements UserInterface, \Serializable
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     * @assert\NotBlank()
     */
    private $firstname;

    /**
     * @ORM\Column(type="string", length=255)
     * @assert\NotBlank()
     */
    private $lastname;

    /**
     * @ORM\Column(type="string", length=255)
     * @assert\NotBlank()
     * @Assert\Length(min=8,
     *     minMessage = "Attention ton mot de passe fait moins de 8 caractères !!!")
     */
    private $password;

    /**
     * @ORM\Column(type="string", length=255)
     * @assert\NotBlank()
     * @Assert\Email(
     *     message = "L'email '{{ value }}' n'est pas une adresse mail valide.",
     *     checkMX = true
     * )
     */
    private $email;

    /**
     * @ORM\Column(type="date")
     * @assert\NotBlank()
     */
    private $birthDate;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Post", mappedBy="user", orphanRemoval=true)
     */
    private $posts;

    /**
     * @ORM\ManyToMany(targetEntity="App\Entity\Post", mappedBy="userTimeline")
     */
    private $postsTimeline;

    /**
     * @ORM\Column(type="simple_array")
     */
    private $roles = [];

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $pseudo;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $picture;

    /**
     * @ORM\OneToOne(targetEntity="App\Entity\Follow", mappedBy="follower", cascade={"persist", "remove"})
     */
    private $followers;

    /**
     * @ORM\OneToOne(targetEntity="App\Entity\Follow", mappedBy="following", cascade={"persist", "remove"})
     */
    private $followings;

    public function __construct()
    {
        $this->posts = new ArrayCollection();
        $this->postsTimeline = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getFirstname(): ?string
    {
        return $this->firstname;
    }

    public function setFirstname(string $firstname): self
    {
        $this->firstname = $firstname;

        return $this;
    }

    public function getLastname(): ?string
    {
        return $this->lastname;
    }

    public function setLastname(string $lastname): self
    {
        $this->lastname = $lastname;

        return $this;
    }

    public function getPassword(): ?string
    {
        return $this->password;
    }

    public function setPassword(string $password): self
    {
        $this->password = $password;

        return $this;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(string $email): self
    {
        $this->email = $email;

        return $this;
    }

    public function getBirthDate(): ?\DateTimeInterface
    {
        return $this->birthDate;
    }

    public function setBirthDate(\DateTimeInterface $birthDate): self
    {
        $this->birthDate = $birthDate;

        return $this;
    }

    public function __toString(): ?string
    {
        return $this->firstname;
    }

    /**
     * @return Collection|Post[]
     */
    public function getPosts(): Collection
    {
        return $this->posts;
    }

    public function addPost(Post $post): self
    {
        if (!$this->posts->contains($post)) {
            $this->posts[] = $post;
            $post->setUser($this);
        }

        return $this;
    }

    public function removePost(Post $post): self
    {
        if ($this->posts->contains($post)) {
            $this->posts->removeElement($post);
            // set the owning side to null (unless already changed)
            if ($post->getUser() === $this) {
                $post->setUser(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|Post[]
     */
    public function getPostsTimeline(): Collection
    {
        return $this->postsTimeline;
    }

    public function addPostsTimeline(Post $postsTimeline): self
    {
        if (!$this->postsTimeline->contains($postsTimeline)) {
            $this->postsTimeline[] = $postsTimeline;
            $postsTimeline->addUserTimeline($this);
        }

        return $this;
    }

    public function removePostsTimeline(Post $postsTimeline): self
    {
        if ($this->postsTimeline->contains($postsTimeline)) {
            $this->postsTimeline->removeElement($postsTimeline);
            $postsTimeline->removeUserTimeline($this);
        }

        return $this;
    }

    public function getRoles(): ?array
    {
        return $this->roles;
    }

    public function setRoles(array $roles): self
    {
        $this->roles = $roles;

        return $this;
    }


    public function getUsername()
    {
        return $this->email;
    }

    public function getSalt()
    {
        return null;
    }

    public function eraseCredentials(){}


    public function serialize()
    {
        return serialize(array(
            $this->id,
            $this->email,
            $this->password
        ));
    }

    public function unserialize($serialized)
    {
        list (
            $this->id,
            $this->email,
            $this->password,
            ) = unserialize($serialized, array('allowed_classes' => false));
    }

    public function setPseudo(string $pseudo): self
    {
        $this->pseudo = $pseudo;

        return $this;
    }

    public function getPseudo(): ?string
    {
        return $this->pseudo;
    }

    public function getPicture(): ?string
    {
        return $this->picture;
    }

    public function setPicture(?string $picture): self
    {
        $this->picture = $picture;

        return $this;
    }

    public function getFollowers(): ?Follow
    {
        return $this->followers;
    }

    public function setFollowers(Follow $followers): self
    {
        $this->followers = $followers;

        // set the owning side of the relation if necessary
        if ($this !== $followers->getFollower()) {
            $followers->setFollower($this);
        }

        return $this;
    }

    public function getFollowings(): ?Follow
    {
        return $this->followings;
    }

    public function setFollowings(Follow $followings): self
    {
        $this->followings = $followings;

        // set the owning side of the relation if necessary
        if ($this !== $followings->getFollowing()) {
            $followings->setFollowing($this);
        }

        return $this;
    }
}
