<?php declare(strict_types=1);

$container["team_repository"] = function ($container): App\Repository\TeamRepository {
    return new App\Repository\TeamRepository($container["db"]);
};

$container["contacts_repository"] = function ($container): App\Repository\ContactsRepository {
    return new App\Repository\ContactsRepository($container["db"]);
};
