<?php

namespace App\Domain\DrivingTime\Repository;

use App\Factory\QueryFactory;
use DomainException;
use Cake\Chronos\Chronos;
use Symfony\Component\HttpFoundation\Session\Session;

final class DrivingTimeRepository
{
    private $queryFactory;
    private $session;

    public function __construct(Session $session,QueryFactory $queryFactory)
    {
        $this->queryFactory = $queryFactory;
        $this->session=$session;
    }

    public function insertDrivingTime(array $row): int
    {
        $row['is_delete']="N";
        return (int)$this->queryFactory->newInsert('driving_times', $row)->execute()->lastInsertId();
    }


    public function updateDrivingTime(int $driving_timeID, array $data): void
    {
        $this->queryFactory->newUpdate('driving_times', $data)->andWhere(['id' => $driving_timeID])->execute();
    }

    public function findDrivingTimes(array $params): array
    {
        $query = $this->queryFactory->newSelect('driving_times');
        $query->select(
            [
                'id',
                'time',
                'start_time',
                'destiantion_time',
                'route',
                
            ]
        );
      
        return $query->execute()->fetchAll('assoc') ?: [];
    }
   
}
