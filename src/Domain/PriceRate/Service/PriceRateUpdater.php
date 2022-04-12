<?php

namespace App\Domain\PriceRate\Service;

use App\Domain\PriceRate\Repository\PriceRateRepository;
use App\Factory\LoggerFactory;
use Psr\Log\LoggerInterface;

/**
 * Service.
 */
final class PriceRateUpdater
{
    /**
     * @var PriceRateRepository
     */
    private $repository;

    /**
     * @var PriceRateValidator
     */
    private $price_rateValidator;

    /**
     * @var LoggerInterface
     */
    private $logger;

    /**
     * The constructor.
     *
     * @param PriceRateRepository $repository The repository
     * @param PriceRateValidator $price_rateValidator The validator
     * @param LoggerFactory $loggerFactory The logger factory
     */
    public function __construct(
        PriceRateRepository $repository,
        PriceRateValidator $price_rateValidator,
        LoggerFactory $loggerFactory
    ) {
        $this->repository = $repository;
        $this->price_rateValidator = $price_rateValidator;
        $this->logger = $loggerFactory
            ->addFileHandler('price_rate_updater.log')
            ->createInstance();
    }

    /**
     * Update price_rate.
     *
     * @param int $price_rateId The price_rate id
     * @param array<mixed> $data The request data
     *
     * @return void
     */
    public function updatePriceRate(int $price_rateId, array $data): void
    {
        $this->price_rateValidator->validatePriceRateUpdate($price_rateId, $data);

        $price_rateRow = $this->mapToRow($data);

        $this->repository->updatePriceRate($price_rateId, $price_rateRow);

        $this->logger->info(sprintf('PriceRate updated successfully: %s', $price_rateId));
    }

    public function insertPriceRate(array $data): int
    {
        $this->price_rateValidator->validatePriceRateInsert($data);

        $Row = $this->mapToRow($data);

        $id = $this->repository->insertPriceRate($Row);

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

        if (isset($data['start'])) {
            $result['start'] = $data['start'];
        }

        if (isset($data['destiantion'])) {
            $result['destiantion'] = $data['destiantion'];
        }

        if (isset($data['price'])) {
            $result['price'] = $data['price'];
        }

        return $result;
    }
}
