<?php  //dont finish!!!!

namespace App\Domain\Menu\Service;

use App\Domain\Menu\Repository\MenuRepository;
use App\Factory\ValidationFactory;
use Cake\Validation\Validator;
use Selective\Validation\Exception\ValidationException;

final class MenuValidator
{
    private $repository;
    private $validationFactory;

    public function __construct(MenuRepository $repository, ValidationFactory $validationFactory)
    {
        $this->repository = $repository;
        $this->validationFactory = $validationFactory;
    }

    private function createValidator(): Validator
    {
        $validator = $this->validationFactory->createValidator();

        return $validator
            ->notEmptyString('menu_code', 'Input required')
            ->notEmptyString('food_menu', 'Input required')
            ->notEmptyString('food_type', 'Input required')
            ->notEmptyString('price', 'Input required')
            ->notEmptyString('status', 'Input required');
    }
    public function validateMenu(array $data): void
    {
        $validator = $this->createValidator();

        $validationResult = $this->validationFactory->createResultFromErrors(
            $validator->validate($data)
        );

        if ($validationResult->fails()) {
            throw new ValidationException('Please check your input', $validationResult);
        }
    }

    public function validateMenuUpdate(string $menuNo, array $data): void  //focus that!!!!!!!!!!
    {
        /*
        if (!$this->repository->existsLotNo($lotNo)) {
            throw new ValidationException(sprintf('Store not found: %s', $stolotNoreId));
        }
        */
        $this->validateMenu($data);
    }
    public function validateMenuInsert( array $data): void
    {
        $this->validateMenu($data);
    }
}