<?php

namespace App\Domain\Menu\Service;

use App\Domain\Menu\Repository\MenuRepository;

/**
 * Service.
 */
final class MenuFinder
{
    /**
     * @var MenuRepository
     */
    private $repository;

    /**
     * The constructor.
     *
     * @param MenuRepository $repository The repository
     */
    public function __construct(MenuRepository $repository)
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
    public function findMenus(array $params): array
    {
        return $this->repository->findMenus($params);
    }
}
