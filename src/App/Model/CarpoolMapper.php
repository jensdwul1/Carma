<?php

namespace App\Model;

use Ahs\Error;
use Ahs\ModelMapperAbstract;

clASs CarpoolMapper extends ModelMapperAbstract
{

	/**
	 * Read Carpool
	 * 
	 * @param \App\Model\Carpool $carpool
	 * @return \App\Model\Carpool
	 * @throws \Exception
	 */
	public function read(Carpool $carpool)
	{
		$sql = 'SELECT ' .
						'`carp_id` AS `id`, ' .
						'`carp_title` AS `title`, ' .
						'`carp_description` AS `description`, ' .
						'`carp_departure` AS `departure`, ' .
						'`carp_lat` AS `lat`, ' .
						'`carp_long` AS `lng`, ' .
						'`carp_seats` AS `seats`, ' .
						'`camp_id` AS `campus`, ' .
						'`usr_id` AS `user` ' .
						'FROM carpools ' .
						'WHERE `carp_id` = :id ' .
						'LIMIT 1';

		$stmt = $this->db->prepare($sql);
		if ($stmt) {
			$stmt->bindValue(':id', $carpool->getId());

			if ($stmt->execute()) {
				$row = $stmt->fetch();
				return new Carpool($row);
			}
			throw new \Exception(sprintf(Error::MESSAGE_READ, get_class($carpool)));
		}
		throw new \Exception(Error::MESSAGE_UNEXPECTED);
	}

	/**
	 * Read All Carpools
	 * 
	 * @return \App\Model\Carpool
	 */
	public function readAll()
	{
		$sql = 'SELECT ' .
						'`carp_id` AS `id`, ' .
						'`carp_title` AS `title`, ' .
						'`carp_description` AS `description`, ' .
						'`carp_departure` AS `departure`, ' .
						'`carp_lat` AS `lat`, ' .
						'`carp_long` AS `lng`, ' .
						'`carp_seats` AS `seats`, ' .
						'`camp_id` AS `campus`, ' .
						'`usr_id` AS `user` ' .
						'FROM carpools ' .
						'ORDER BY `carp_title` ASC';

		$carpools = [];

		$stmt = $this->db->query($sql);
		while ($row = $stmt->fetch()) {
			$carpools[] = new Carpool($row);
		}

		return $carpools;
	}

	/**
	 * Read a specific Carpool
	 * 
	 * @param int $id
	 * @return \App\Model\Carpool
	 * @throws \Excpetion
	 */
	public function readID($id)
	{
		$sql = 'SELECT ' .
						'`carp_id` AS `id`, ' .
						'`carp_title` AS `title`, ' .
						'`carp_description` AS `description`, ' .
						'`carp_departure` AS `departure`, ' .
						'`carp_lat` AS `lat`, ' .
						'`carp_long` AS `lng`, ' .
						'`carp_seats` AS `seats`, ' .
						'`camp_id` AS `campus`, ' .
						'`usr_id` AS `user` ' .
						'FROM carpools ' .
						'WHERE `carp_id` = :id ' .
						'LIMIT 1';

		$stmt = $this->db->prepare($sql);
		if ($stmt) {
			$stmt->bindValue(':id', $id);

			if ($stmt->execute()) {
				$row = $stmt->fetch();

				return new Carpool($row);
			}
			throw new \Excpetion(sprintf(Error::MESSAGE_READ, get_class($carpool)));
		}
		throw new \Exception(Error::MESSAGE_UNEXPECTED);
	}

	/**
	 * Create a Carpool
	 * 
	 * @param \App\Model\Carpool $carpool
	 * @return \App\Model\Carpool
	 * @throws \Exception
	 * @throws \ErrorException
	 */
	public function create(Carpool $carpool)
	{
		$sql = 'INSERT INTO `carpools` ' .
						'(`carp_title`, ' .
						'`carp_description`, ' .
						'`carp_departure`, ' .
						'`carp_lat`, ' .
						'`carp_long`, ' .
						'`carp_seats`, ' .
						'`usr_id`, ' .
						'`camp_id`) ' .
						
						'VALUES (' .
						':title, ' .
						':description, ' .
						':departure, ' .
						':lat, ' .
						':lng, ' .
						':seats, ' .
						':user, ' .
						':campus )';

		$stmt = $this->db->prepare($sql);
		if ($stmt) {
			$stmt->bindValue(':title', $carpool->getTitle());
			$stmt->bindValue(':description', $carpool->getDescription());
			$stmt->bindValue(':departure', $carpool->getDeparture());
			$stmt->bindValue(':lat', $carpool->getLat());
			$stmt->bindValue(':lng', $carpool->getLng());
			$stmt->bindValue(':seats', $carpool->getSeats());
			$stmt->bindValue(':campus', $carpool->getCampus()->getId());
			$stmt->bindValue(':user', $carpool->getUser()->getId());
			
			if ($stmt->execute()) {
				$carpool->setId($this->db->lastInsertId());
				return $carpool;
			}
			throw new \Exception(sprintf(Error::MESSAGE_CREATE, get_class($carpool)));
		}
		throw new \ErrorException(Error::MESSAGE_UNEXPECTED);
	}

	/**
	 * Check if the carpool exists
	 * 
	 * @param type $id
	 * @return boolean
	 */
	public function checkIfCarpoolExists($id)
	{
		$sql = 'SELECT * FROM `carpools` WHERE `carp_id` = :id';

		$stmt = $this->db->prepare($sql);
		if ($stmt) {
			$stmt->bindValue(':id', $id);

			if ($stmt->execute()) {
				if ($stmt->rowCount() == 0) {
					$exists = false;
				} else {
					$exists = true;
				}

				return $exists;
			}
		}
	}

	/**
	 * Read Last 5 carpools
	 * 
	 * @return \App\Model\Carpool
	 */
	public function readLastFiveCarpools()
	{
		$sql = 'SELECT ' .
						'`carp_id` AS `id`, ' .
						'`carp_title` AS `title`, ' .
						'`carp_description` AS `description`, ' .
						'`carp_departure` AS `departure`, ' .
						'`carp_lat` AS `lat`, ' .
						'`carp_long` AS `lng`, ' .
						'`carp_seats` AS `seats`, ' .
						'`camp_id` AS `campus`, ' .
						'`usr_id` AS `user` ' .
						'FROM `carpools` ' .
						'ORDER BY `carp_id` DESC ' .
						'LIMIT 5';

		$carpools = [];

		$stmt = $this->db->query($sql);
		while ($row = $stmt->fetch()) {
			$carpools[] = new Carpool($row);
		}

		return $carpools;
	}

	/**
	 * Read All Carpools For a Campus
	 * 
	 * @param \App\Model\Campus $campus
	 * @return \App\Model\Carpool
	 * @throws \Exception
	 */
	public function readForCampus(Campus $campus)
	{
		$sql = 'SELECT ' .
						'`carp_id` AS `id`, ' .
						'`carp_title` AS `title`, ' .
						'`carp_description` AS `description`, ' .
						'`carp_departure` AS `departure`, ' .
						'`carp_lat` AS `lat`, ' .
						'`carp_long` AS `lng`, ' .
						'`carp_seats` AS `seats`, ' .
						'`camp_id` AS `campus`, ' .
						'`usr_id` AS `user` ' .
						'FROM `carpools` ' .
						'NATURAL JOIN `campuses` ' .
						'WHERE `camp_id` = :camp_id';

		$stmt = $this->db->prepare($sql);

		$carpools = [];

		if ($stmt) {
			$stmt->bindValue(':camp_id', $campus->getId());

			if ($stmt->execute()) {
				while ($row = $stmt->fetch()) {
					$carpools[] = new Carpool($row);
				}
				return $carpools;
			}
			throw new \Exception(sprintf(Error::MESSAGE_READ, get_class($campus)));
		}
		throw new \Exception(Error::MESSAGE_UNEXPECTED);
	}
	/**
	 * Read All Carpools For a User
	 * 
	 * @param \App\Model\User $user
	 * @return \App\Model\Carpool
	 * @throws \Exception
	 */
	
	public function readForUser(User $user)
	{
		$sql = '`carp_id` AS `id`, ' .
						'`carp_title` AS `title`, ' .
						'`carp_description` AS `description`, ' .
						'`carp_departure` AS `departure`, ' .
						'`carp_lat` AS `lat`, ' .
						'`carp_long` AS `lng`, ' .
						'`carp_seats` AS `seats`, ' .
						'`camp_id` AS `campus`, ' .
						'`usr_id` AS `user` ' .
						'FROM `carpools` ' .
						'WHERE `usr_id` = :usr_id'.
						'ORDER BY `carp_id` ASC ' .
						'LIMIT 10';

		$stmt = $this->db->prepare($sql);

		if ($stmt) {
			$stmt->bindValue(':usr_id', $user->getId());

			$carpools = [];
			if ($stmt->execute()) {
				while ($row = $stmt->fetch()) {
					$carpools[] = new Carpool($row);
				}
				return $carpools;
			}
			throw new \Exception(sprintf(Error::MESSAGE_READ, get_class($user)));
		}
		throw new \Exception(Error::MESSAGE_UNEXPECTED);
	}

	
	/**
	 * Update Carpool
	 * 
	 * @param \App\Model\Carpool $carpool
	 */
	public function update(Carpool $carpool)
	{
		$sql = 'UPDATE `carpools` ' .
						'`carp_id` AS `id`, ' .
						'`carp_title` AS `title`, ' .
						'`carp_description` AS `description`, ' .
						'`carp_departure` AS `departure`, ' .
						'`carp_lat` AS `lat`, ' .
						'`carp_long` AS `lng`, ' .
						'`carp_seats` AS `seats`, ' .
						'`camp_id` AS `campus`, ' .
						'`usr_id` AS `user` ' .
						'WHERE `carp_id` = :id';

		$stmt = $this->db->prepare($sql);

		if ($stmt) {
			$stmt->bindValue(':title', $carpool->getTitle());
			$stmt->bindValue(':description', $carpool->getDescription());
			$stmt->bindValue(':departure', $carpool->getDeparture());
			$stmt->bindValue(':lat', $carpool->getLat());
			$stmt->bindValue(':lng', $carpool->getLng());
			$stmt->bindValue(':seats', $carpool->getSeats());
			$stmt->bindValue(':campus', $carpool->getCampus()->getId());
			$stmt->bindValue(':user', $carpool->getUser()->getId());
			$stmt->bindValue(':id', $carpool->getId());
			$stmt->execute();
		}
	}

}
