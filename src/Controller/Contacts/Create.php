<?php declare(strict_types=1);

namespace App\Controller\Contacts;

class Create extends Base
{
    public function __invoke($request, $response)
    {
        $input = $request->getParsedBody();
        $contacts = $this->getContactsService()->createContacts($input);

        $payload = json_encode($contacts);
        $response->getBody()->write($payload);
        return $response->withHeader('Content-Type', 'application/json')->withStatus(201);
    }
}
