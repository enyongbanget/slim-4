<?php declare(strict_types=1);

$container["team_service"] = function ($container): App\Service\TeamService {
    return new App\Service\TeamService($container["team_repository"]);
};

$container["contacts_service"] = function ($container): App\Service\ContactsService {
    return new App\Service\ContactsService($container["contacts_repository"]);
};
