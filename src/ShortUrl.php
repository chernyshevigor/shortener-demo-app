<?php

declare(strict_types=1);

namespace Shortener;

use RuntimeException;
use function strlen;

final readonly class ShortUrl
{
    private string $chars;
    private int $charsLength;

    private int $size;

    public function __construct(int $size)
    {
        $this->chars = implode('', array_merge(range('a', 'z'), range('A', 'Z')));
        $this->charsLength = strlen($this->chars);
        $this->size = $size;
    }

    public function generate(int $id): string
    {
        $shortUrl = '';

        while ($id > 0) {
            $shortUrl .= $this->chars[$id % $this->charsLength];

            if (strlen($shortUrl) > $this->size) {
                throw new RuntimeException();
            }
            $id = floor($id / $this->charsLength);
        }

        return strrev(str_pad($shortUrl, $this->size, $this->chars[0]));
    }
}
