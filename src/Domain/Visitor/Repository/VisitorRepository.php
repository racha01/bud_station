<?php

namespace App\Domain\Visitor\Repository;

use App\Factory\QueryFactory;
use DomainException;
use Cake\Chronos\Chronos;
use Symfony\Component\HttpFoundation\Session\Session;

final class VisitorRepository
{
    private $queryFactory;
    private $session;

    public function __construct(Session $session,QueryFactory $queryFactory)
    {
        $this->queryFactory = $queryFactory;
        $this->session=$session;
    }

    public function insertVisitor(array $row): int
    {
        // $row['created_at'] = Chronos::now()->toDateTimeString();
        // $row['created_user_id'] = $this->session->get('user')["id"];
        // $row['updated_at'] = Chronos::now()->toDateTimeString();
        // $row['updated_user_id'] = $this->session->get('user')["id"];

        $row['status']="CHECKIN";
        $row['date_check_in'] = Chronos::now()->toDateTimeString();
        $row['date_check_out'] = "0000-00-00 00:00:00";

        return (int)$this->queryFactory->newInsert('visitors', $row)->execute()->lastInsertId();
    }


    public function updateVisitor(int $visitorID, array $data): void
    {
        // $data['updated_at'] = Chronos::now()->toDateTimeString();
        // $data['updated_user_id'] = $this->session->get('user')["id"];
        $this->queryFactory->newUpdate('visitors', $data)->andWhere(['id' => $visitorID])->execute();
    }

    public function findVisitors(array $params): array
    {
        $query = $this->queryFactory->newSelect('visitors');
        $query->select(
            [
                'id',
                'visitor_no',
                'card_id',
                'table_id',
                'number_of_people',
                'status',
                'date_check_in',
                'date_check_out',
               
            ]
        );

        //  if(isset($params['food_type'])){
        //     $query->andWhere(['food_type'=>$params["food_type"]]);
        // }


        // $query->andWhere(['is_delete' => 'N']);
        // $query->andWhere(['status' => 'ACTIVE']);
      
        return $query->execute()->fetchAll('assoc') ?: [];
    }

    public function checkVisitor(int $id)
    {
        $query = $this->queryFactory->newSelect('visitors');
        $query->select(
            [
                'visitors.id',
                'visitor_no',
                'card_id',
                'table_id',
                'number_of_people',
                'visitors.status',
                'date_check_in',
                'date_check_out',
                'table_no',
            ]
        );

        $query->join([
            't' => [
                'table' => 'tables',
                'type' => 'INNER',
                'conditions' => 't.id = visitors.table_id',
            ]]);
        $query->andWhere(['visitors.id' => $id]);

        $row = $query->execute()->fetch('assoc');
        if (!$row) {
            return null;
        }
        else{
            return $row;
        }
        return false;
    }
   
}
