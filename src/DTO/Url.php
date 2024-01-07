<?php

declare(strict_types=1);

namespace Shortener\DTO;

use Symfony\Component\Validator\Constraints as Assert;

final readonly class Url
{
    #[Assert\Url]
    public string $url;

    public function __construct(string $url)
    {
        $this->url = $url;
    }
}
