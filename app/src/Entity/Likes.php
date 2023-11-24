<?php

namespace App\Entity;

use App\Repository\LikesRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: LikesRepository::class)]
class Likes
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 45)]
    private ?string $word = null;

    #[ORM\Column]
    private ?int $number_of_likes = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getWord(): ?string
    {
        return $this->word;
    }

    public function setWord(string $word): static
    {
        $this->word = $word;

        return $this;
    }

    public function getNumberOfLikes(): ?int
    {
        return $this->number_of_likes;
    }

    public function setNumberOfLikes(int $number_of_likes): static
    {
        $this->number_of_likes = $number_of_likes;

        return $this;
    }
}
