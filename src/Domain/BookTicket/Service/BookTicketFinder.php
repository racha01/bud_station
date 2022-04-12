<?php

namespace App\Domain\BookTicket\Service;

use App\Domain\BookTicket\Repository\BookTicketRepository;

/**
 * Service.
 */
final class BookTicketFinder
{
    /**
     * @var BookTicketRepository
     */
    private $repository;

    /**
     * The constructor.
     *
     * @param BookTicketRepository $repository The repository
     */
    public function __construct(BookTicketRepository $repository)
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
    public function findBookTickets(array $params): array
    {
        return $this->repository->findBookTickets($params);
    }
}
