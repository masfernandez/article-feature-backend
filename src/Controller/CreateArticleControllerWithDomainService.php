<?php

declare(strict_types=1);

namespace App\Controller;

use JsonException;
use Masfernandez\ArticleFeature\Application\Article\Create\CreateWithDomainService\CreateArticleCommand;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Messenger\MessageBusInterface;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/articles-domain-service', name: 'create_article_with_domain_service', methods: 'POST')]
class CreateArticleControllerWithDomainService extends AbstractController
{
    public function __construct(
        private readonly MessageBusInterface $commandBus,
    ) {
    }

    /**
     * @throws JsonException
     */
    public function __invoke(
        Request $request,
    ): JsonResponse {
        $body = json_decode($request->getContent(), true, 512, JSON_THROW_ON_ERROR);

        $this->commandBus->dispatch(
            new CreateArticleCommand(
                $body['uuid'],
                $body['name'],
            )
        );

        return $this->json([],Response::HTTP_NO_CONTENT);
    }
}
