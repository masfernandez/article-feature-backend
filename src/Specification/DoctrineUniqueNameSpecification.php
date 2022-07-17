<?php

declare(strict_types=1);

namespace App\Specification;

use Masfernandez\ArticleFeature\Domain\Article\ArticleRepositoryInterface;

use Masfernandez\ArticleFeature\Domain\Article\Exception\ArticleNameAlreadyExist;
use Masfernandez\ArticleFeature\Domain\Article\UniqueNameSpecificationInterface;
use Masfernandez\ArticleFeature\Shared\Domain\Specification\AbstractSpecification;

class DoctrineUniqueNameSpecification extends AbstractSpecification implements UniqueNameSpecificationInterface
{
    public function __construct(
        private readonly ArticleRepositoryInterface $articleRepository,
    ) {
    }

    public function isSatisfiedBy($value): bool
    {
        if ($this->articleRepository->countBy(['name' => $value]) !== 0) {
            throw new ArticleNameAlreadyExist('Name already used');
        }

        return true;
    }

    public function isUnique(string $name): bool
    {
        return $this->isSatisfiedBy($name);
    }
}
