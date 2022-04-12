<?php  //dont finish!!!!

namespace App\Domain\Visitor\Service;

use App\Domain\Visitor\Repository\VisitorRepository;
use App\Factory\ValidationFactory;
use Cake\Validation\Validator;
use Selective\Validation\Exception\ValidationException;

final class VisitorValidator
{
    private $repository;
    private $validationFactory;

    public function __construct(VisitorRepository $repository, ValidationFactory $validationFactory)
    {
        $this->repository = $repository;
        $this->validationFactory = $validationFactory;
    }

    private function createValidator(): Validator
    {
        $validator = $this->validationFactory->createValidator();
        return $validator
            ->notEmptyString('visitor_no', 'Input required')
            ->notEmptyString('card_id', 'Input required')
            ->notEmptyString('table_id', 'Input required')
            ->notEmptyString('number_of_people', 'Input required')
            ->notEmptyString('status', 'Input required')
            ->notEmptyString('date_ckeck_in', 'Input required')
            ->notEmptyString('date_ckeck_out', 'Input required');
    }
    public function validateVisitor(array $data): void
    {
        $validator = $this->createValidator();

        $validationResult = $this->validationFactory->createResultFromErrors(
            $validator->validate($data)
        );

        if ($validationResult->fails()) {
            throw new ValidationException('Please check your input', $validationResult);
        }
    }

    public function validateVisitorUpdate(string $visitorNo, array $data): void  //focus that!!!!!!!!!!
    {
        /*
        if (!$this->repository->existsLotNo($lotNo)) {
            throw new ValidationException(sprintf('Store not found: %s', $stolotNoreId));
        }
        */
        $this->validateVisitor($data);
    }
    public function validateVisitorInsert( array $data): void
    {
        $this->validateVisitor($data);
    }
}