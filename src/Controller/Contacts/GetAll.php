<?php declare(strict_types=1);

namespace App\Controller\Contacts;

class GetAll extends Base
{
    public function __invoke($request, $response)
    {
        $contactss = $this->getContactsService()->getAllContacts();

        $payload = json_encode($contactss);
        $response->getBody()->write($payload);
        return $response->withHeader('Content-Type', 'application/json')->withStatus(200);
    }
}
