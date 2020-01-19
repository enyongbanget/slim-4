<?php declare(strict_types=1);

namespace App\Controller\Contacts;

class GetOne extends Base
{
    public function __invoke($request, $response, array $args)
    {
        $contacts = $this->getContactsService()->getContacts((int) $args['id']);

        $payload = json_encode($contacts);
        $response->getBody()->write($payload);
        return $response->withHeader('Content-Type', 'application/json')->withStatus(200);
    }
}
