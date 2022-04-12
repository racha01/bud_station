<?php

namespace App\Domain\User\Repository;

use App\Factory\QueryFactory;
use DomainException;
use Cake\Chronos\Chronos;
use Symfony\Component\HttpFoundation\Session\Session;

final class UserRepository
{
    private $queryFactory;
    private $session;

    public function __construct(Session $session, QueryFactory $queryFactory)
    {
        $this->queryFactory = $queryFactory;
        $this->session = $session;
    }

    public function checkLogin(string $username, string $password)
    {
        $query = $this->queryFactory->newSelect('users');
        $query->select(
            [
                'users.id',
                'username',
                'password',
                'name',
            ]
        );
        $query->andWhere(['username' => $username]);
        function utf8_strrev($str)
        {
            preg_match_all('/./us', $str, $ar);
            return join('', array_reverse($ar[0]));
        }
        function pass_encrypt($pass, $show = false)
        {
            //you secret word
            $key1    = 'asdfasf';
            $key2    = 'asdfasdf';
            $loop    = 1;
            $reverse = utf8_strrev($pass);
            if ($show == true) {
                echo '<br> กลับตัวอักษร &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;: ', $reverse;
            }
            for ($i = 0; $i < $loop; $i++) {
                $md5 = md5($reverse);
                if ($show == true) {
                    echo '<br> เข้ารหัสเป็น 32 หลัก : ', $md5;
                }
                $reverse_md5 = utf8_strrev($md5);
                if ($show == true) {
                    echo '<br> กลับตัวอักษร &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; : ', $reverse_md5;
                }
                $salt = substr($reverse_md5, -13) . md5($key1) . substr($reverse_md5, 0, 19) . md5($key2);
                if ($show == true) {
                    echo '<br> สร้างข้อความใหม่ &nbsp;&nbsp;&nbsp; : ', $salt;
                }
                $new_md5 = md5($salt);
                if ($show == true) {
                    echo '<br> เข้ารหัสเป็น 32 หลัก : ', $new_md5;
                }
                $reverse = utf8_strrev($new_md5);
                if ($show == true) {
                    echo '<br> กลับตัวอักษรอีกครั้ง &nbsp;: ', $reverse;
                }
            }
            return md5($reverse);
        }
        $row = $query->execute()->fetch('assoc');
        if (!$row) {
            return null;
        }
        if (password_verify(pass_encrypt($password), $row["password"])) {
            return $row;
        }
        return false;
    }

    public function getUserById(int $userId): array
    {
        $query = $this->queryFactory->newSelect('users');
        $query->select(
            [
                'users.id',
                'username',
                'first_name',
                'last_name',
                'user_role_id',
                'locale',
                'enabled',
            ]
        );
        $query->andWhere(['id' => $userId]);

        $row = $query->execute()->fetch('assoc');

        if (!$row) {
            throw new DomainException(sprintf('User not found: %s', $userId));
        }

        return $row;
    }

    public function findUsers(array $params): array
    {
        $query = $this->queryFactory->newSelect('menus');
        $query->select(
            [
                'menus.id',
                'menu_code',
                'food_menu',
                'food_type',
                'price',
                'status',

            ]
        );

        return $query->execute()->fetchAll('assoc') ?: [];
    }

    public function deleteUserById(int $userId): void
    {
        $statement = $this->queryFactory->newDelete('users')->andWhere(['id' => $userId])->execute();

        if (!$statement->count()) {
            throw new DomainException(sprintf('Cannot delete user: %s', $userId));
        }
    }

    public function insertUser(array $row): int
    {
        $row['created_at'] = Chronos::now()->toDateTimeString();
        $data['created_user_id'] = $this->session->get('user')["id"];
        $row['updated_at'] = Chronos::now()->toDateTimeString();
        $data['updated_user_id'] = $this->session->get('user')["id"];

        return (int)$this->queryFactory->newInsert('users', $row)->execute()->lastInsertId();
    }

    public function updateUser(int $userId, array $data): void
    {
        $data['updated_at'] = Chronos::now()->toDateTimeString();
        $data['updated_user_id'] = $this->session->get('user')["id"];

        $this->queryFactory->newUpdate('users', $data)->andWhere(['id' => $userId])->execute();
    }

    public function existsUserId(int $userId): bool
    {
        $query = $this->queryFactory->newSelect('users');
        $query->select('id')->andWhere(['id' => $userId]);

        return (bool)$query->execute()->fetch('assoc');
    }
}
