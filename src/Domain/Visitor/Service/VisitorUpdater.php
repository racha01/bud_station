<?php

namespace App\Domain\Visitor\Service;

use App\Domain\Visitor\Repository\VisitorRepository;
use App\Factory\LoggerFactory;
use Psr\Log\LoggerInterface;

/**
 * Service.
 */
final class VisitorUpdater
{
    /**
     * @var VisitorRepository
     */
    private $repository;

    /**
     * @var VisitorValidator
     */
    private $visitorValidator;

    /**
     * @var LoggerInterface
     */
    private $logger;

    /**
     * The constructor.
     *
     * @param VisitorRepository $repository The repository
     * @param VisitorValidator $visitorValidator The validator
     * @param LoggerFactory $loggerFactory The logger factory
     */
    public function __construct(
        VisitorRepository $repository,
        VisitorValidator $visitorValidator,
        LoggerFactory $loggerFactory
    ) {
        $this->repository = $repository;
        $this->visitorValidator = $visitorValidator;
        $this->logger = $loggerFactory
            ->addFileHandler('visitor_updater.log')
            ->createInstance();
    }

    /**
     * Update visitor.
     *
     * @param int $visitorId The visitor id
     * @param array<mixed> $data The request data
     *
     * @return void
     */
    public function updateVisitor(int $visitorId, array $data): void
    {
        $this->visitorValidator->validateVisitorUpdate($visitorId, $data);

        $visitorRow = $this->mapToRow($data);

        $visitorRow['visitor_no']="V".str_pad( $visitorId, 11, "0", STR_PAD_LEFT);

        $this->repository->updateVisitor($visitorId, $visitorRow);

        $this->logger->info(sprintf('Visitor updated successfully: %s', $visitorId));

        
    }

    public function insertVisitor( array $data): int
    {
        $this->visitorValidator->validateVisitorInsert($data);

        $Row = $this->mapToRow($data);

        $Row['visitor_no']="V00000000000";
        $Row['card_id']=0;

        $id=$this->repository->insertVisitor($Row);
       
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

        if (isset($data['visitor_no'])) {
            $result['visitor_no'] = (string)$data['visitor_no'];
        }
        if (isset($data['card_id'])) {
            $result['card_id'] = (int)$data['card_id'];
        }
        if (isset($data['table_id'])) {
            $result['table_id'] = (int)$data['table_id'];
        }
        if (isset($data['number_of_people'])) {
            $result['number_of_people'] = (int)$data['number_of_people'];
        }
        if (isset($data['status'])) {
            $result['status'] = (string)$data['status'];
        }
        if (isset($data['date_ckeck_in'])) {
            $result['date_ckeck_in'] = (string)$data['date_ckeck_in'];
        }
        if (isset($data['date_ckeck_in'])) {
            $result['date_ckeck_in'] = (string)$data['date_ckeck_in'];
        }

        return $result;
    }
}
