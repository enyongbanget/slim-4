<?php declare(strict_types=1);

namespace App\Controller\Contacts;

class Delete extends Base
{
    public function __invoke($request, $response, array $args)
    {
        $this->getContactsService()->deleteContacts((int) $args['id']);

        return $response->withHeader('Content-Type', 'application/json')->withStatus(204);
    }
}
