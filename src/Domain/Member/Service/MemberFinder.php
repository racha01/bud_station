<?php

namespace App\Domain\Member\Service;

use App\Domain\Member\Repository\MemberRepository;

/**
 * Service.
 */
final class MemberFinder
{
    /**
     * @var MemberRepository
     */
    private $repository;

    /**
     * The constructor.
     *
     * @param MemberRepository $repository The repository
     */
    public function __construct(MemberRepository $repository)
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
    public function findMembers(array $params): array
    {
        return $this->repository->findMembers($params);
    }
}
