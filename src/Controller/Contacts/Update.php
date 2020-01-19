<?php declare(strict_types=1);

namespace App\Controller\Contacts;

class Update extends Base
{
    public function __invoke($request, $response, array $args)
    {
        $input = $request->getParsedBody();
        $contacts = $this->getContactsService()->updateContacts($input, (int) $args['id']);

        $payload = json_encode($contacts);
        $response->getBody()->write($payload);
        return $response->withHeader('Content-Type', 'application/json')->withStatus(200);
    }
}
