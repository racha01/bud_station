<?php  //dont finish!!!!

namespace App\Domain\DrivingTime\Service;

use App\Domain\DrivingTime\Repository\DrivingTimeRepository;
use App\Factory\ValidationFactory;
use Cake\Validation\Validator;
use Selective\Validation\Exception\ValidationException;

final class DrivingTimeValidator
{
    private $repository;
    private $validationFactory;

    public function __construct(DrivingTimeRepository $repository, ValidationFactory $validationFactory)
    {
        $this->repository = $repository;
        $this->validationFactory = $validationFactory;
    }

    private function createValidator(): Validator
    {
        $validator = $this->validationFactory->createValidator();

        return $validator
            ->notEmptyString('time', 'Input required')
            ->notEmptyString('start_time', 'Input required')
            ->notEmptyString('destination_time', 'Input required')
            ->notEmptyString('route', 'Input required');
    }
    public function validateDrivingTime(array $data): void
    {
        $validator = $this->createValidator();

        $validationResult = $this->validationFactory->createResultFromErrors(
            $validator->validate($data)
        );

        if ($validationResult->fails()) {
            throw new ValidationException('Please check your input', $validationResult);
        }
    }

    public function validateDrivingTimeUpdate(string $driving_timeNo, array $data): void  //focus that!!!!!!!!!!
    {
        $this->validateDrivingTime($data);
    }
    public function validateDrivingTimeInsert( array $data): void
    {
        $this->validateDrivingTime($data);
    }
}