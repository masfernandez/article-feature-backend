<?php

declare(strict_types=1);

namespace App\Repository;

use Doctrine\Persistence\ManagerRegistry;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Masfernandez\ArticleFeature\Domain\Article\Article;
use Masfernandez\ArticleFeature\Domain\Article\ArticleRepositoryInterface;

class DoctrineArticleRepository extends ServiceEntityRepository implements ArticleRepositoryInterface
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Article::class);
    }

    public function add(Article $article, bool $flush = false): void
    {
        $this->getEntityManager()->persist($article);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function remove(Article $article, bool $flush = false): void
    {
        $this->getEntityManager()->remove($article);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function search(string $uuid, $lockMode = null, $lockVersion = null): ?Article
    {
        return $this->find($uuid);
    }

    public function searchOneBy(array $criteria, array $orderBy = null): ?Article
    {
        return $this->findOneBy($criteria, $orderBy);
    }

    public function searchAll(): array
    {
        return $this->findAll();
    }

    public function matchBy(array $criteria, array $orderBy = null, $limit = null, $offset = null): array
    {
        return $this->findBy($criteria, $orderBy, $limit, $offset);
    }

    public function countBy(array $criteria): int
    {
        return $this->count($criteria);
    }
}
