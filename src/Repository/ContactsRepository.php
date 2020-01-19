<?php declare(strict_types=1);

namespace App\Repository;

use App\Exception\ContactsException;

class ContactsRepository extends BaseRepository
{
    public function __construct(\PDO $database)
    {
        $this->database = $database;
    }

    public function checkAndGetContacts(int $contactsId)
    {
        $query = 'SELECT * FROM `contacts` WHERE `id` = :id';
        $statement = $this->getDb()->prepare($query);
        $statement->bindParam('id', $contactsId);
        $statement->execute();
        $contacts = $statement->fetchObject();
        if (empty($contacts)) {
            throw new ContactsException('Contacts not found.', 404);
        }

        return $contacts;
    }

    public function getAllContacts(): array
    {
        $query = 'SELECT * FROM `contacts` ORDER BY `id`';
        $statement = $this->getDb()->prepare($query);
        $statement->execute();

        return $statement->fetchAll();
    }

    public function createContacts($contacts)
    {
        $query = 'INSERT INTO `contacts` (`id`, `name`, `email`, `subject`, `message`, `created`) VALUES (:id, :name, :email, :subject, :message, :created)';
        $statement = $this->getDb()->prepare($query);
        $statement->bindParam('id', $contacts->id);
	$statement->bindParam('name', $contacts->name);
	$statement->bindParam('email', $contacts->email);
	$statement->bindParam('subject', $contacts->subject);
	$statement->bindParam('message', $contacts->message);
	$statement->bindParam('created', $contacts->created);
        $statement->execute();

        return $this->checkAndGetContacts((int) $this->getDb()->lastInsertId());
    }

    public function updateContacts($contacts, $data)
    {
        if (isset($data->name)) { $contacts->name = $data->name; }
        if (isset($data->email)) { $contacts->email = $data->email; }
        if (isset($data->subject)) { $contacts->subject = $data->subject; }
        if (isset($data->message)) { $contacts->message = $data->message; }
        if (isset($data->created)) { $contacts->created = $data->created; }

        $query = 'UPDATE `contacts` SET `name` = :name, `email` = :email, `subject` = :subject, `message` = :message, `created` = :created WHERE `id` = :id';
        $statement = $this->getDb()->prepare($query);
        $statement->bindParam('id', $contacts->id);
	$statement->bindParam('name', $contacts->name);
	$statement->bindParam('email', $contacts->email);
	$statement->bindParam('subject', $contacts->subject);
	$statement->bindParam('message', $contacts->message);
	$statement->bindParam('created', $contacts->created);
        $statement->execute();

        return $this->checkAndGetContacts((int) $contacts->id);
    }

    public function deleteContacts(int $contactsId)
    {
        $query = 'DELETE FROM `contacts` WHERE `id` = :id';
        $statement = $this->getDb()->prepare($query);
        $statement->bindParam('id', $contactsId);
        $statement->execute();
    }
}
