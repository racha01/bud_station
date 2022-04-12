<?php  //dont finish!!!!

namespace App\Domain\PriceRate\Service;

use App\Domain\PriceRate\Repository\PriceRateRepository;
use App\Factory\ValidationFactory;
use Cake\Validation\Validator;
use Selective\Validation\Exception\ValidationException;

final class PriceRateValidator
{
    private $repository;
    private $validationFactory;

    public function __construct(PriceRateRepository $repository, ValidationFactory $validationFactory)
    {
        $this->repository = $repository;
        $this->validationFactory = $validationFactory;
    }

    private function createValidator(): Validator
    {
        $validator = $this->validationFactory->createValidator();

        return $validator
            ->notEmptyString('start', 'Input required')
            ->notEmptyString('destiantion', 'Input required')
            ->notEmptyString('price', 'Input required');
    }
    public function validatePriceRate(array $data): void
    {
        $validator = $this->createValidator();

        $validationResult = $this->validationFactory->createResultFromErrors(
            $validator->validate($data)
        );

        if ($validationResult->fails()) {
            throw new ValidationException('Please check your input', $validationResult);
        }
    }

    public function validatePriceRateUpdate(string $price_rateNo, array $data): void  //focus that!!!!!!!!!!
    {
        $this->validatePriceRate($data);
    }
    public function validatePriceRateInsert(array $data): void
    {
        $this->validatePriceRate($data);
    }
}
