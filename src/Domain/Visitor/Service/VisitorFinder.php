<?php

namespace App\Domain\Visitor\Service;

use App\Domain\Visitor\Repository\VisitorRepository;

/**
 * Service.
 */
final class VisitorFinder
{
    /**
     * @var VisitorRepository
     */
    private $repository;

    /**
     * The constructor.
     *
     * @param VisitorRepository $repository The repository
     */
    public function __construct(VisitorRepository $repository)
    {
        $this->repository = $repository;
    }

    /**
     * Find users.
     *
     * @param array<mixed> $params The parameters
     *
     * @return array<mixed> The result
     */
    public function findVisitors(array $params): array
    {
        return $this->repository->findVisitors($params);
    }

    public function checkVisitor(int $id)
    {
        $visitorRow = $this->repository->checkVisitor($id);
        
        return $visitorRow;
    }
}
