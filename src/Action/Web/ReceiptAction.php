<?php

namespace App\Action\Web;

use App\Domain\Receipt\Service\ReceiptFinder;
use App\Responder\Responder;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Slim\Views\Twig;
use Symfony\Component\HttpFoundation\Session\Session;

/**
 * Action.
 */
final class ReceiptAction
{
    /**
     * @var Responder
     */
    private $responder;
    private $twig;
    private $userFinder;
    private $session;

    /**
     * The constructor.
     *
     * @param Responder $responder The responder
     */
    public function __construct(Twig $twig,ReceiptFinder $userFinder,Session $session,Responder $responder)
    {
        $this->twig = $twig;
        $this->userFinder=$userFinder;
        $this->session=$session;
        $this->responder = $responder;
    }

    /**
     * Action.
     *
     * @param ServerRequestInterface $request The request
     * @param ResponseInterface $response The response
     *
     * @return ResponseInterface The response
     */
    public function __invoke(ServerRequestInterface $request, ResponseInterface $response): ResponseInterface
    {
        $params = (array)$request->getQueryParams();
        
        $viewData = [
            'receipts' => $this->userFinder->findReceipts($params),
            'user_login' => $this->session->get('user'),
        ];
        
        return $this->twig->render($response, 'web/receipts.twig',$viewData);
    }
}
