<?php

namespace App\Action\Api;

use App\Domain\DrivingTime\Service\DrivingTimeFinder;
use App\Responder\Responder;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;

use function DI\string;

/**
 * Action.
 */
final class DrivingTimeAction
{
    /**
     * @var Responder
     */
    private $responder;
    private $finder;

    public function __construct(
        DrivingTimeFinder $finder,
        Responder $responder
    ) {
        $this->finder = $finder;
        $this->responder = $responder;
    }

    public function __invoke(ServerRequestInterface $request, ResponseInterface $response): ResponseInterface
    {
        $params = (array)$request->getQueryParams();

        $arr = $this->finder->findDrivingTimes($params);

        for ($i = 0; $i < count($arr); $i++) {
            $staryTime = $btArray = explode(':', $arr[$i]['start_time']);
            $destiantionTime = $btArray = explode(':', $arr[$i]['destiantion_time']);

            $splitTeimeS = date("$staryTime[0]:$staryTime[1]");
            $splitTeimeD = date("$destiantionTime[0]:$destiantionTime[1]");

            $arr[$i]['start_time'] = $splitTeimeS;
            $arr[$i]['destiantion_time'] = $splitTeimeD;
        }



        $rtdata['message'] = "Get DrivingTime Successful";
        $rtdata['error'] = false;
        $rtdata['driving_times'] = $arr;

        return $this->responder->withJson($response, $rtdata);
    }
}
