<?php

namespace App\Domain\BookTicket\Service;

use App\Domain\BookTicket\Repository\BookTicketRepository;
use App\Factory\LoggerFactory;
use Psr\Log\LoggerInterface;

/**
 * Service.
 */
final class BookTicketUpdater
{
    /**
     * @var BookTicketRepository
     */
    private $repository;

    /**
     * @var BookTicketValidator
     */
    private $book_ticketValidator;

    /**
     * @var LoggerInterface
     */
    private $logger;

    /**
     * The constructor.
     *
     * @param BookTicketRepository $repository The repository
     * @param BookTicketValidator $book_ticketValidator The validator
     * @param LoggerFactory $loggerFactory The logger factory
     */
    public function __construct(
        BookTicketRepository $repository,
        BookTicketValidator $book_ticketValidator,
        LoggerFactory $loggerFactory
    ) {
        $this->repository = $repository;
        $this->book_ticketValidator = $book_ticketValidator;
        $this->logger = $loggerFactory
            ->addFileHandler('book_ticket_updater.log')
            ->createInstance();
    }

    /**
     * Update book_ticket.
     *
     * @param int $book_ticketId The book_ticket id
     * @param array<mixed> $data The request data
     *
     * @return void
     */
    public function updateBookTicket(int $book_ticketId, array $data): void
    {
        $this->book_ticketValidator->validateBookTicketUpdate($book_ticketId, $data);

        $book_ticketRow = $this->mapToRow($data);

        $this->repository->updateBookTicket($book_ticketId, $book_ticketRow);

        $this->logger->info(sprintf('BookTicket updated successfully: %s', $book_ticketId));
    }

    public function insertBookTicket( array $data): int
    {
        $this->book_ticketValidator->validateBookTicketInsert($data);

        $Row = $this->mapToRow($data);

        $id=$this->repository->insertBookTicket($Row);

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

        if (isset($data['user_id'])) {
            $result['user_id'] = $data['user_id'];
        }

        if (isset($data['seat'])) {
            $result['seat'] = $data['seat'];
        }

        if (isset($data['driving_time_id'])) {
            $result['driving_time_id'] = $data['driving_time_id'];
        }

        if (isset($data['price_rate_id'])) {
            $result['price_rate_id'] = $data['price_rate_id'];
        }
        if (isset($data['date'])) {
            $result['date'] = $data['date'];
        }

        return $result;
    }
}
