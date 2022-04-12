<?php

namespace App\Domain\Member\Repository;

use App\Factory\QueryFactory;
use DomainException;
use Cake\Chronos\Chronos;
use Symfony\Component\HttpFoundation\Session\Session;

final class MemberRepository
{
    private $queryFactory;
    private $session;

    public function __construct(Session $session,QueryFactory $queryFactory)
    {
        $this->queryFactory = $queryFactory;
        $this->session=$session;
    }

    public function insertMember(array $row): int
    {
        // $row['created_at'] = Chronos::now()->toDateTimeString();
        // $row['created_user_id'] = $this->session->get('user')["id"];
        // $row['updated_at'] = Chronos::now()->toDateTimeString();
        // $row['updated_user_id'] = $this->session->get('user')["id"];

        return (int)$this->queryFactory->newInsert('members', $row)->execute()->lastInsertId();
    }

    public function updateMember(int $menuID, array $data): void
    {
        // $data['updated_at'] = Chronos::now()->toDateTimeString();
        // $data['updated_user_id'] = $this->session->get('user')["id"];
        $this->queryFactory->newUpdate('members', $data)->andWhere(['id' => $menuID])->execute();
    }

    public function findMembers(array $params): array
    {
        $query = $this->queryFactory->newSelect('members');
        $query->select(
            [
                'members.id',
                'id_member',
                'first_name',
                'last_name',
                'status'
               
            ]
        );

        return $query->execute()->fetchAll('assoc') ?: [];
    }

   
}
