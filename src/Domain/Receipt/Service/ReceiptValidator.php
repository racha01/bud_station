<?php  //dont finish!!!!

namespace App\Domain\Receipt\Service;

use App\Domain\Receipt\Repository\ReceiptRepository;
use App\Factory\ValidationFactory;
use Cake\Validation\Validator;
use Selective\Validation\Exception\ValidationException;

final class ReceiptValidator
{
    private $repository;
    private $validationFactory;

    public function __construct(ReceiptRepository $repository, ValidationFactory $validationFactory)
    {
        $this->repository = $repository;
        $this->validationFactory = $validationFactory;
    }

    private function createValidator(): Validator
    {
        $validator = $this->validationFactory->createValidator();

        return $validator
            ->notEmptyString('receipt_code', 'Input required')
            ->notEmptyString('food_receipt', 'Input required')
            ->notEmptyString('food_type', 'Input required')
            ->notEmptyString('price', 'Input required')
            ->notEmptyString('status', 'Input required');
    }
    public function validateReceipt(array $data): void
    {
        $validator = $this->createValidator();

        $validationResult = $this->validationFactory->createResultFromErrors(
            $validator->validate($data)
        );

        if ($validationResult->fails()) {
            throw new ValidationException('Please check your input', $validationResult);
        }
    }

    public function validateReceiptUpdate(string $receiptNo, array $data): void  //focus that!!!!!!!!!!
    {
        /*
        if (!$this->repository->existsLotNo($lotNo)) {
            throw new ValidationException(sprintf('Store not found: %s', $stolotNoreId));
        }
        */
        $this->validateReceipt($data);
    }
    public function validateReceiptInsert( array $data): void
    {
        $this->validateReceipt($data);
    }
}