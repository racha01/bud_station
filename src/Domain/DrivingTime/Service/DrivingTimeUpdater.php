<?php

namespace App\Domain\DrivingTime\Service;

use App\Domain\DrivingTime\Repository\DrivingTimeRepository;
use App\Factory\LoggerFactory;
use Psr\Log\LoggerInterface;

/**
 * Service.
 */
final class DrivingTimeUpdater
{
    /**
     * @var DrivingTimeRepository
     */
    private $repository;

    /**
     * @var DrivingTimeValidator
     */
    private $driving_timeValidator;

    /**
     * @var LoggerInterface
     */
    private $logger;

    /**
     * The constructor.
     *
     * @param DrivingTimeRepository $repository The repository
     * @param DrivingTimeValidator $driving_timeValidator The validator
     * @param LoggerFactory $loggerFactory The logger factory
     */
    public function __construct(
        DrivingTimeRepository $repository,
        DrivingTimeValidator $driving_timeValidator,
        LoggerFactory $loggerFactory
    ) {
        $this->repository = $repository;
        $this->driving_timeValidator = $driving_timeValidator;
        $this->logger = $loggerFactory
            ->addFileHandler('driving_time_updater.log')
            ->createInstance();
    }

    /**
     * Update driving_time.
     *
     * @param int $driving_timeId The driving_time id
     * @param array<mixed> $data The request data
     *
     * @return void
     */
    public function updateDrivingTime(int $driving_timeId, array $data): void
    {
        $this->driving_timeValidator->validateDrivingTimeUpdate($driving_timeId, $data);

        $driving_timeRow = $this->mapToRow($data);

        $this->repository->updateDrivingTime($driving_timeId, $driving_timeRow);

        $this->logger->info(sprintf('DrivingTime updated successfully: %s', $driving_timeId));
    }

    public function insertDrivingTime( array $data): int
    {
        $this->driving_timeValidator->validateDrivingTimeInsert($data);

        $Row = $this->mapToRow($data);

        $id=$this->repository->insertDrivingTime($Row);

        return $id;
    }

    /**
     * Map data to row.
     *
     * @param array<mixed> $data The data
     *
     * @return array<mixed> The row
     */
    private function mapToRow(array $data): array
    {
        $result = [];

        if (isset($data['time'])) {
            $result['time'] = (string)$data['time'];
        }

        if (isset($data['start_time'])) {
            $result['start_time'] = (string)$data['start_time'];
        }

        if (isset($data['destination_time'])) {
            $result['destination_time'] = (string)$data['destination_time'];
        }

        if (isset($data['route'])) {
            $result['route'] = (string)$data['route'];
        }

        return $result;
    }
}
