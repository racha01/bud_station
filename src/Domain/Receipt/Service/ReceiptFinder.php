<?php

namespace App\Domain\Receipt\Service;

use App\Domain\Receipt\Repository\ReceiptRepository;

/**
 * Service.
 */
final class ReceiptFinder
{
    /**
     * @var ReceiptRepository
     */
    private $repository;

    /**
     * The constructor.
     *
     * @param ReceiptRepository $repository The repository
     */
    public function __construct(ReceiptRepository $repository)
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
    public function findReceipts(array $params): array
    {
        return $this->repository->findReceipts($params);
    }
}
