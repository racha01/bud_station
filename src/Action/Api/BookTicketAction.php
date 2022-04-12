<?php

namespace App\Action\Api;

use App\Domain\BookTicket\Service\BookTicketFinder;
use App\Responder\Responder;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;

use function DI\string;

/**
 * Action.
 */
final class BookTicketAction
{
    /**
     * @var Responder
     */
    private $responder;
    private $finder;

    public function __construct(
        BookTicketFinder $finder,
        Responder $responder
    ) {
        $this->finder = $finder;
        $this->responder = $responder;
    }

    public function __invoke(ServerRequestInterface $request, ResponseInterface $response): ResponseInterface
    {
        $params = (array)$request->getQueryParams();

        $arr = $this->finder->findBookTickets($params);

        $rtdata['message'] = "Get BookTicket Successful";
        $rtdata['error'] = false;
        $rtdata['book_tickets'] = $arr;

        return $this->responder->withJson($response, $rtdata);
    }
}
