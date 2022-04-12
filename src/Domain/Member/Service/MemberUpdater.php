<?php

namespace App\Domain\Member\Service;

use App\Domain\Member\Repository\MemberRepository;
use App\Factory\LoggerFactory;
use Psr\Log\LoggerInterface;

/**
 * Service.
 */
final class MemberUpdater
{
    /**
     * @var MemberRepository
     */
    private $repository;

    /**
     * @var MemberValidator
     */
    private $memberValidator;

    /**
     * @var LoggerInterface
     */
    private $logger;

    /**
     * The constructor.
     *
     * @param MemberRepository $repository The repository
     * @param MemberValidator $memberValidator The validator
     * @param LoggerFactory $loggerFactory The logger factory
     */
    public function __construct(
        MemberRepository $repository,
        MemberValidator $memberValidator,
        LoggerFactory $loggerFactory
    ) {
        $this->repository = $repository;
        $this->memberValidator = $memberValidator;
        $this->logger = $loggerFactory
            ->addFileHandler('member_updater.log')
            ->createInstance();
    }

    /**
     * Update member.
     *
     * @param int $memberId The member id
     * @param array<mixed> $data The request data
     *
     * @return void
     */
    public function updateMember(int $memberId, array $data): void
    {
        // Input validation
        $this->memberValidator->validateMemberUpdate($memberId, $data);

        // Map form data to row
        $memberRow = $this->mapToRow($data);

        // Insert member
        $this->repository->updateMember($memberId, $memberRow);

        // Logging
        $this->logger->info(sprintf('Member updated successfully: %s', $memberId));
    }

    public function insertMember( array $data): int
    {
        // Input validation
        $this->memberValidator->validateMemberInsert($data);

        // Map form data to row
        $Row = $this->mapToRow($data);

        // Insert transferStore
        $id=$this->repository->insertMember($Row);

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

        if (isset($data['id_member'])) {
            $result['id_member'] = (string)$data['id_member'];
        }

        if (isset($data['first_name'])) {
            $result['first_name'] = (string)$data['first_name'];
        }

        if (isset($data['last_name'])) {
            $result['last_name'] = (string)$data['last_name'];
        }

        if (isset($data['status'])) {
            $result['status'] = (string)$data['status'];
        }

       
        return $result;
    }
}
