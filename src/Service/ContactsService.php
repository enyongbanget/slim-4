<?php declare(strict_types=1);

namespace App\Service;

use App\Exception\ContactsException;
use App\Repository\ContactsRepository;

class ContactsService extends BaseService
{
    protected $contactsRepository;

    public function __construct(ContactsRepository $contactsRepository)
    {
        $this->contactsRepository = $contactsRepository;
    }

    protected function checkAndGetContacts(int $contactsId)
    {
        return $this->contactsRepository->checkAndGetContacts($contactsId);
    }

    public function getAllContacts(): array
    {
        return $this->contactsRepository->getAllContacts();
    }

    public function getContacts(int $contactsId)
    {
        return $this->checkAndGetContacts($contactsId);
    }

    public function createContacts($input)
    {
        $contacts = json_decode(json_encode($input), false);

        return $this->contactsRepository->createContacts($contacts);
    }

    public function updateContacts(array $input, int $contactsId)
    {
        $contacts = $this->checkAndGetContacts($contactsId);
        $data = json_decode(json_encode($input), false);

        return $this->contactsRepository->updateContacts($contacts, $data);
    }

    public function deleteContacts(int $contactsId)
    {
        $this->checkAndGetContacts($contactsId);
        $this->contactsRepository->deleteContacts($contactsId);
    }
}
