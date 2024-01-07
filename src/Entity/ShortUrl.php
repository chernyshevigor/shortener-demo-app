<?php

declare(strict_types=1);

namespace Shortener\Entity;

use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use Shortener\Repository\ShortUrlRepository;

#[ORM\Entity(repositoryClass: ShortUrlRepository::class)]
class ShortUrl
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(type: Types::STRING, length: 255, nullable: false)]
    private string $origin = '';

    #[ORM\Column(type: Types::STRING, length: 255, nullable: false)]
    private string $short = '';

    public function getId(): int
    {
        return (int) $this->id;
    }

    public function getOrigin(): string
    {
        return $this->origin;
    }

    public function setOrigin(string $origin): static
    {
        $this->origin = $origin;

        return $this;
    }

    public function getShort(): string
    {
        return $this->short;
    }

    public function setShort(string $short): static
    {
        $this->short = $short;

        return $this;
    }
}
