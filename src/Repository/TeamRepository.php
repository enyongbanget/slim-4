<?php declare(strict_types=1);

namespace App\Repository;

use App\Exception\TeamException;

class TeamRepository extends BaseRepository
{
    public function __construct(\PDO $database)
    {
        $this->database = $database;
    }

    public function checkAndGetTeam(int $teamId)
    {
        $query = 'SELECT * FROM `team` WHERE `id` = :id';
        $statement = $this->getDb()->prepare($query);
        $statement->bindParam('id', $teamId);
        $statement->execute();
        $team = $statement->fetchObject();
        if (empty($team)) {
            throw new TeamException('Team not found.', 404);
        }

        return $team;
    }

    public function getAllTeam(): array
    {
        $query = 'SELECT * FROM `team` ORDER BY `id`';
        $statement = $this->getDb()->prepare($query);
        $statement->execute();

        return $statement->fetchAll();
    }

    public function createTeam($team)
    {
        $query = 'INSERT INTO `team` (`id`, `name`, `email`, `phone`) VALUES (:id, :name, :email, :phone)';
        $statement = $this->getDb()->prepare($query);
        $statement->bindParam('id', $team->id);
	$statement->bindParam('name', $team->name);
	$statement->bindParam('email', $team->email);
	$statement->bindParam('phone', $team->phone);
        $statement->execute();

        return $this->checkAndGetTeam((int) $this->getDb()->lastInsertId());
    }

    public function updateTeam($team, $data)
    {
        if (isset($data->name)) { $team->name = $data->name; }
        if (isset($data->email)) { $team->email = $data->email; }
        if (isset($data->phone)) { $team->phone = $data->phone; }

        $query = 'UPDATE `team` SET `name` = :name, `email` = :email, `phone` = :phone WHERE `id` = :id';
        $statement = $this->getDb()->prepare($query);
        $statement->bindParam('id', $team->id);
	$statement->bindParam('name', $team->name);
	$statement->bindParam('email', $team->email);
	$statement->bindParam('phone', $team->phone);
        $statement->execute();

        return $this->checkAndGetTeam((int) $team->id);
    }

    public function deleteTeam(int $teamId)
    {
        $query = 'DELETE FROM `team` WHERE `id` = :id';
        $statement = $this->getDb()->prepare($query);
        $statement->bindParam('id', $teamId);
        $statement->execute();
    }
}
