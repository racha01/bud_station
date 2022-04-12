<?php

namespace App\Domain\DrivingTime\Service;

use App\Domain\DrivingTime\Repository\DrivingTimeRepository;

/**
 * Service.
 */
final class DrivingTimeFinder
{
    /**
     * @var DrivingTimeRepository
     */
    private $repository;

    /**
     * The constructor.
     *
     * @param DrivingTimeRepository $repository The repository
     */
    public function __construct(DrivingTimeRepository $repository)
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
    public function findDrivingTimes(array $params): array
    {
        return $this->repository->findDrivingTimes($params);
    }
}
