<?php

namespace App\Domain\Receipt\Service;

use App\Domain\Receipt\Repository\ReceiptRepository;
use App\Factory\LoggerFactory;
use Psr\Log\LoggerInterface;

/**
 * Service.
 */
final class ReceiptUpdater
{
    /**
     * @var ReceiptRepository
     */
    private $repository;

    /**
     * @var ReceiptValidator
     */
    private $receiptValidator;

    /**
     * @var LoggerInterface
     */
    private $logger;

    /**
     * The constructor.
     *
     * @param ReceiptRepository $repository The repository
     * @param ReceiptValidator $receiptValidator The validator
     * @param LoggerFactory $loggerFactory The logger factory
     */
    public function __construct(
        ReceiptRepository $repository,
        ReceiptValidator $receiptValidator,
        LoggerFactory $loggerFactory
    ) {
        $this->repository = $repository;
        $this->receiptValidator = $receiptValidator;
        $this->logger = $loggerFactory
            ->addFileHandler('receipt_updater.log')
            ->createInstance();
    }

    /**
     * Update receipt.
     *
     * @param int $receiptId The receipt id
     * @param array<mixed> $data The request data
     *
     * @return void
     */
    public function updateReceipt(int $receiptId, array $data): void
    {
        // Input validation
        $this->receiptValidator->validateReceiptUpdate($receiptId, $data);

        // Map form data to row
        $receiptRow = $this->mapToRow($data);

        // Insert receipt
        $this->repository->updateReceipt($receiptId, $receiptRow);

        // Logging
        $this->logger->info(sprintf('Receipt updated successfully: %s', $receiptId));
    }

    public function insertReceipt( array $data): int
    {
        // Input validation
        $this->receiptValidator->validateReceiptInsert($data);

        // Map form data to row
        $Row = $this->mapToRow($data);

        // Insert transferStore
        $id=$this->repository->insertReceipt($Row);

        // Logging
        //$this->logger->info(sprintf('TransferStore updated successfully: %s', $id));
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

        if (isset($data['receipt_code'])) {
            $result['receipt_code'] = (string)$data['receipt_code'];
        }

        if (isset($data['food_receipt'])) {
            $result['food_receipt'] = (string)$data['food_receipt'];
        }

        if (isset($data['food_type'])) {
            $result['food_type'] = (string)$data['food_type'];
        }

        if (isset($data['price'])) {
            $result['price'] = (string)$data['price'];
        }

        if (isset($data['status'])) {
            $result['status'] = (int)$data['status'];
        }

        return $result;
    }
}
