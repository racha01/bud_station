<?php

namespace App\Domain\Receipt\Repository;

use App\Factory\QueryFactory;
use DomainException;
use Cake\Chronos\Chronos;
use Symfony\Component\HttpFoundation\Session\Session;

final class ReceiptRepository
{
    private $queryFactory;
    private $session;

    public function __construct(Session $session,QueryFactory $queryFactory)
    {
        $this->queryFactory = $queryFactory;
        $this->session=$session;
    }

    public function insertReceipt(array $row): int
    {
        // $row['created_at'] = Chronos::now()->toDateTimeString();
        // $row['created_user_id'] = $this->session->get('user')["id"];
        // $row['updated_at'] = Chronos::now()->toDateTimeString();
        // $row['updated_user_id'] = $this->session->get('user')["id"];

        $row['is_delete']="N";

        return (int)$this->queryFactory->newInsert('receipts', $row)->execute()->lastInsertId();
    }


    public function updateReceipt(int $receiptID, array $data): void
    {
        // $data['updated_at'] = Chronos::now()->toDateTimeString();
        // $data['updated_user_id'] = $this->session->get('user')["id"];
        $this->queryFactory->newUpdate('receipts', $data)->andWhere(['id' => $receiptID])->execute();
    }

    public function findReceipts(array $params): array
    {
        $query = $this->queryFactory->newSelect('receipts');
        $query->select(
            [
                'id',
                'receipt_no',
                'visitor_id',
                'total_price',
                'create_at',
                'status',
               
            ]
        );
        // if(isset($params['lot_id'])){
        //     $query->andWhere(['lots.id'=>$params["lot_id"]]);
        // }

        return $query->execute()->fetchAll('assoc') ?: [];
    }
   
}
