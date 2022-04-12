<?php

namespace App\Domain\BookTicket\Repository;

use App\Factory\QueryFactory;
use DomainException;
use Cake\Chronos\Chronos;
use Symfony\Component\HttpFoundation\Session\Session;

final class BookTicketRepository
{
    private $queryFactory;
    private $session;

    public function __construct(Session $session,QueryFactory $queryFactory)
    {
        $this->queryFactory = $queryFactory;
        $this->session=$session;
    }

    public function insertBookTicket(array $row): int
    {
        $row['is_delete']="N";
        return (int)$this->queryFactory->newInsert('book_tickets', $row)->execute()->lastInsertId();
    }


    public function updateBookTicket(int $book_ticketID, array $data): void
    {
        $this->queryFactory->newUpdate('book_tickets', $data)->andWhere(['id' => $book_ticketID])->execute();
    }

    public function findBookTickets(array $params): array
    {
        $query = $this->queryFactory->newSelect('book_tickets');
        $query->select(
            [
                'id',
                'user_id',
                'seat',
                'driving_time_id',
                'price_rate_id',
                'date',
                
            ]
        );
      
        return $query->execute()->fetchAll('assoc') ?: [];
    }
   
}
