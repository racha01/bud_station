<?php  //dont finish!!!!

namespace App\Domain\BookTicket\Service;

use App\Domain\BookTicket\Repository\BookTicketRepository;
use App\Factory\ValidationFactory;
use Cake\Validation\Validator;
use Selective\Validation\Exception\ValidationException;

final class BookTicketValidator
{
    private $repository;
    private $validationFactory;

    public function __construct(BookTicketRepository $repository, ValidationFactory $validationFactory)
    {
        $this->repository = $repository;
        $this->validationFactory = $validationFactory;
    }

    private function createValidator(): Validator
    {
        $validator = $this->validationFactory->createValidator();

        return $validator
            ->notEmptyString('user_id', 'Input required')
            ->notEmptyString('seat', 'Input required')
            ->notEmptyString('driving_time_id', 'Input required')
            ->notEmptyString('price_rate_id', 'Input required')
            ->notEmptyString('date', 'Input required');
    }
    public function validateBookTicket(array $data): void
    {
        $validator = $this->createValidator();

        $validationResult = $this->validationFactory->createResultFromErrors(
            $validator->validate($data)
        );

        if ($validationResult->fails()) {
            throw new ValidationException('Please check your input', $validationResult);
        }
    }

    public function validateBookTicketUpdate(string $book_ticketNo, array $data): void  //focus that!!!!!!!!!!
    {
        $this->validateBookTicket($data);
    }
    public function validateBookTicketInsert( array $data): void
    {
        $this->validateBookTicket($data);
    }
}