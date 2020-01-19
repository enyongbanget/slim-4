<?php declare(strict_types=1);

namespace App\Controller\Contacts;

use App\Service\ContactsService;

abstract class Base
{
    protected $container;

    protected $contactsService;

    public function __construct($container)
    {
        $this->container = $container;
    }

    protected function getContactsService(): ContactsService
    {
        return $this->container->get('contacts_service');
    }
}
