<?php  //dont finish!!!!

namespace App\Domain\Member\Service;

use App\Domain\Member\Repository\MemberRepository;
use App\Factory\ValidationFactory;
use Cake\Validation\Validator;
use Selective\Validation\Exception\ValidationException;

final class MemberValidator
{
    private $repository;
    private $validationFactory;

    public function __construct(MemberRepository $repository, ValidationFactory $validationFactory)
    {
        $this->repository = $repository;
        $this->validationFactory = $validationFactory;
    }

    private function createValidator(): Validator
    {
        $validator = $this->validationFactory->createValidator();

        return $validator
            ->notEmptyString('id_member', 'Input required')
            ->notEmptyString('first_name', 'Input required')
            ->notEmptyString('last_name', 'Input required')
            ->notEmptyString('status', 'Input required');
            
    }
    public function validateMember(array $data): void
    {
        $validator = $this->createValidator();

        $validationResult = $this->validationFactory->createResultFromErrors(
            $validator->validate($data)
        );

        if ($validationResult->fails()) {
            throw new ValidationException('Please check your input', $validationResult);
        }
    }

    public function validateMemberUpdate(string $memberNo, array $data): void  //focus that!!!!!!!!!!
    {
        /*
        if (!$this->repository->existsLotNo($lotNo)) {
            throw new ValidationException(sprintf('Store not found: %s', $stolotNoreId));
        }
        */
        $this->validateMember($data);
    }
    public function validateMemberInsert(array $data): void
    {
        $this->validateMember($data);
    }
}