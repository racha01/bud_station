<?php

namespace App\Action\Web;

use App\Domain\Member\Service\MemberUpdater;
use App\Responder\Responder;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;

/**
 * Action.
 */
final class MemberEditAction
{
    private $responder;
    private $updater;
    public function __construct(Responder $responder, MemberUpdater $updater)
    {
        $this->responder = $responder;
        $this->updater = $updater;
    }


    public function __invoke(
        ServerRequestInterface $request,
        ResponseInterface $response,
        array $args
    ): ResponseInterface {
        // Extract the form data from the request body
        $data = (array)$request->getParsedBody();
        $memberId = $data["id"];

        // Invoke the Domain with inputs and retain the result
        $this->updater->updateMember($memberId, $data);

        // Build the HTTP response
        return $this->responder->withRedirect($response,"members");
    }
}
