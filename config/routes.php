<?php

// Define app routes

use Slim\App;
use Slim\Routing\RouteCollectorProxy;
use Tuupola\Middleware\HttpBasicAuthentication;
use App\Middleware\UserAuthMiddleware;

return function (App $app) {
    $app->post('/api/login', \App\Action\ApiLoginSubmitAction::class);
    
    $app->get('/api/driving_times', \App\Action\Api\DrivingTimeAction::class);

    $app->get('/api/book_tickets', \App\Action\Api\BookTicketAction::class);
    $app->post('/api/add_book_ticket', \App\Action\Api\BookTicketAddAction::class);

    $app->get('/api/price_rates', \App\Action\Api\PriceRateAction::class);

};
