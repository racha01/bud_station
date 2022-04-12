<?php

namespace App\Action\Api;

use App\Domain\BookTicket\Service\BookTicketFinder;
use App\Domain\BookTicket\Service\BookTicketUpdater;
use App\Responder\Responder;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;

/**
 * Action.
 */
final class BookTicketAddAction
{
    /**
     * @var Responder
     */
    private $responder;
    private $finder;
    private $updater;

    public function __construct(
        BookTicketFinder $finder,
        BookTicketUpdater $updater,
        Responder $responder,
    ) {
        $this->finder = $finder;
        $this->updater = $updater;
    }

    public function __invoke(ServerRequestInterface $request, ResponseInterface $response): ResponseInterface
    {
        $data = (array)$request->getParsedBody();

        $this->updater->insertBookTicket($data);

        return $this->responder->withJson($response, $data);
    }
}
