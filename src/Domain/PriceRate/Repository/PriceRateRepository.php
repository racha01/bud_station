<?php

namespace App\Domain\PriceRate\Repository;

use App\Factory\QueryFactory;
use DomainException;
use Cake\Chronos\Chronos;
use Symfony\Component\HttpFoundation\Session\Session;

final class PriceRateRepository
{
    private $queryFactory;
    private $session;

    public function __construct(Session $session,QueryFactory $queryFactory)
    {
        $this->queryFactory = $queryFactory;
        $this->session=$session;
    }

    public function insertPriceRate(array $row): int
    {
        $row['is_delete']="N";
        return (int)$this->queryFactory->newInsert('price_rates', $row)->execute()->lastInsertId();
    }


    public function updatePriceRate(int $price_rateID, array $data): void
    {
        $this->queryFactory->newUpdate('price_rates', $data)->andWhere(['id' => $price_rateID])->execute();
    }

    public function findPriceRates(array $params): array
    {
        $query = $this->queryFactory->newSelect('price_rates');
        $query->select(
            [
                'id',
                'start',
                'destiantion',
                'price',
                
            ]
        );
      
        return $query->execute()->fetchAll('assoc') ?: [];
    }
   
}
