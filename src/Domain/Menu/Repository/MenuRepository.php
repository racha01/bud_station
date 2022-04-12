<?php

namespace App\Domain\Menu\Repository;

use App\Factory\QueryFactory;
use DomainException;
use Cake\Chronos\Chronos;
use Symfony\Component\HttpFoundation\Session\Session;

final class MenuRepository
{
    private $queryFactory;
    private $session;

    public function __construct(Session $session,QueryFactory $queryFactory)
    {
        $this->queryFactory = $queryFactory;
        $this->session=$session;
    }

    public function insertMenu(array $row): int
    {
        // $row['created_at'] = Chronos::now()->toDateTimeString();
        // $row['created_user_id'] = $this->session->get('user')["id"];
        // $row['updated_at'] = Chronos::now()->toDateTimeString();
        // $row['updated_user_id'] = $this->session->get('user')["id"];

        $row['is_delete']="N";

        return (int)$this->queryFactory->newInsert('menus', $row)->execute()->lastInsertId();
    }


    public function updateMenu(int $menuID, array $data): void
    {
        // $data['updated_at'] = Chronos::now()->toDateTimeString();
        // $data['updated_user_id'] = $this->session->get('user')["id"];
        $this->queryFactory->newUpdate('menus', $data)->andWhere(['id' => $menuID])->execute();
    }

    public function findMenus(array $params): array
    {
        $query = $this->queryFactory->newSelect('menus');
        $query->select(
            [
                'id',
                'menu_code',
                'food_menu',
                'food_type',
                'price',
                'status',
                'is_delete',
                'menu_image',
               
            ]
        );

         if(isset($params['food_type'])){
            $query->andWhere(['food_type'=>$params["food_type"]]);
        }


        $query->andWhere(['is_delete' => 'N']);
        $query->andWhere(['status' => 'ACTIVE']);
      
        return $query->execute()->fetchAll('assoc') ?: [];
    }
   
}
