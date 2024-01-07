<?php

declare(strict_types=1);

namespace Shortener\Controller;

use RuntimeException;
use Shortener\DTO\Url;
use Shortener\Repository\ShortUrlRepository;
use Shortener\ShortUrl;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Validator\Validator\ValidatorInterface;
use function count;

final class ShortenerController extends AbstractController
{
    public function __construct(
        private readonly ValidatorInterface $validator,
        private readonly ShortUrlRepository $shortUrlRepository,
        private readonly ShortUrl $generator,
    ) {
    }

    public function generateAction(Request $request): Response
    {
        $url = new Url($request->request->getString('url'));

        if (count($this->validator->validate($url)) > 0) {
            throw new RuntimeException('Url is invalid');
        }

        $entity = new \Shortener\Entity\ShortUrl();
        $entity->setOrigin($url->url);
        $this->shortUrlRepository->save($entity, true);
        $entity->setShort($this->generator->generate($entity->getId()));
        $this->shortUrlRepository->save($entity, true);

        return new JsonResponse(
            ['short_url' => $entity->getShort()]
        );
    }

    public function redirectAction(string $shortUrl): RedirectResponse
    {
        $entity = $this->shortUrlRepository->findOneBy(['short' => $shortUrl]);

        if (null === $entity) {
            throw new RuntimeException('Url is invalid');
        }

        return $this->redirect($entity->getOrigin());
    }
}
