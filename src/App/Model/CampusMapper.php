<?php

namespace App\Model;

use Ahs\Error;
use Ahs\ModelMapperAbstract;

class CampusMapper extends ModelMapperAbstract
{

	/**
	 * Read Campus
	 * 
	 * @param \App\Model\Campus $campus
	 * @return \App\Model\Campus
	 * @throws \Exception
	 */
	public function read(Campus $campus)
	{
		$sql = 'SELECT ' .
						'`camp_id` as `id`, ' .
						'`camp_name` as `name`, ' .
						'`camp_address` as `address`, ' .
						'`camp_city` as `city`, ' .
						'`camp_postal` as `postal`, ' .
						'`camp_telephone` as `telephone`, ' .
						'`camp_lat` as `lat`, ' .
						'`camp_lng` as `lng`, ' .
						'`camp_pic` as `pic` ' .
						'FROM `campuses` ' .
						'WHERE `camp_id` = :id ' .
						'LIMIT 1';

		$stmt = $this->db->prepare($sql);
		if ($stmt) {
			$stmt->bindValue(':id', $campus->getId());

			if ($stmt->execute()) {
				$row = $stmt->fetch();
				return new Campus($row);
			}
			throw new \Exception(sprintf(Error::MESSAGE_READ, get_class($campus)));
		}
		throw new \Exception(Error::MESSAGE_UNEXPECTED);
	}

	/**
	 * Read All campuses
	 * 
	 * @return \App\Model\Campus
	 */
	public function readAll()
	{
		$sql = 'SELECT ' .
						'`camp_id` as `id`, ' .
						'`camp_name` as `name`, ' .
						'`camp_address` as `address`, ' .
						'`camp_city` as `city`, ' .
						'`camp_postal` as `postal`, ' .
						'`camp_telephone` as `telephone`, ' .
						'`camp_lat` as `lat`, ' .
						'`camp_lng` as `lng`, ' .
						'`camp_pic` as `pic` ' .
						'FROM `campuses` ' .
						'ORDER BY `camp_name` ASC';

		$campuses = [];

		$stmt = $this->db->query($sql);
		while ($row = $stmt->fetch()) {
			$campuses[] = new Campus($row);
		}

		return $campuses;
	}

	/**
	 * Read campus with ID
	 * 
	 * @param type $id
	 * @return \App\Model\Campus
	 * @throws \Excpetion
	 * @throws \Exception
	 */
	public function readID($id)
	{
		$sql = 'SELECT ' .
						'`camp_id` as `id`, ' .
						'`camp_name` as `name`, ' .
						'`camp_address` as `address`, ' .
						'`camp_city` as `city`, ' .
						'`camp_postal` as `postal`, ' .
						'`camp_telephone` as `telephone`, ' .
						'`camp_lat` as `lat`, ' .
						'`camp_lng` as `lng`, ' .
						'`camp_pic` as `pic` ' .
						'FROM `campuses` ' .
						'WHERE `camp_id` = :id ' .
						'LIMIT 1';

		$stmt = $this->db->prepare($sql);
		if ($stmt) {
			$stmt->bindValue(':id', $id);

			if ($stmt->execute()) {
				$row = $stmt->fetch();

				return new Campus($row);
			}
			throw new \Excpetion(sprintf(Error::MESSAGE_READ, get_class($campus)));
		}
		throw new \Exception(Error::MESSAGE_UNEXPECTED);
	}

	/**
	 * Create a new Campus
	 * 
	 * @param \App\Model\Campus $campus
	 * @return \App\Model\Campus
	 * @throws \Exception
	 * @throws \ErrorException
	 */
	public function create(Campus $campus)
	{
		$sql = 'INSERT INTO `campuses` ' .
						'(`camp_name`, ' .
						'`camp_address`, ' .
						'`camp_city`, ' .
						'`camp_postal`, ' .
						'`camp_telephone`, ' .
						'`camp_lat`, ' .
						'`camp_lng`, ' .
						'`camp_pic`) ' .
						'VALUES (' .
						':name, ' .
						':address, ' .
						':city, ' .
						':postal, ' .
						':telephone, ' .
						':lat, ' .
						':lng, ' .
						':pic)';

		$stmt = $this->db->prepare($sql);
		if ($stmt) {
			$stmt->bindValue(':name', $campus->getName());
			$stmt->bindValue(':address', $campus->getAddress());
			$stmt->bindValue(':city', $campus->getCity());
			$stmt->bindValue(':postal', $campus->getPostal());
			$stmt->bindValue(':telephone', $campus->getTelephone());
			$stmt->bindValue(':lat', $campus->getLat());
			$stmt->bindValue(':lng', $campus->getLng());
			$stmt->bindValue(':pic', $campus->getPic());

			if ($stmt->execute()) {
				$campus->setId($this->db->lastInsertId());
				return $campus;
			}
			throw new \Exception(sprintf(Error::MESSAGE_CREATE, get_class($campus)));
		}
		throw new \ErrorException(Error::MESSAGE_UNEXPECTED);
	}

	/**
	 * CHECK IF THE CAMPUS EXISTS
	 * 
	 * @param type $id
	 * @return boolean
	 */
	public function checkIfCampusExists($id)
	{
		$sql = 'SELECT * FROM `campuses` WHERE `camp_id` = :id';

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
	 * Update Campus
	 * 
	 * @param \App\Model\Campus $campus
	 */
	public function update(Campus $campus)
	{
		$sql = 'UPDATE `campuses` ' .
						'SET `camp_name` = :name, ' .
						'`camp_address` = :address, ' .
						'`camp_city` = :city, ' .
						'`camp_postal` = :postal, ' .
						'`camp_telephone` = :telephone, ' .
						'`camp_lat` = :lat, ' .
						'`camp_lng` = :lng, ' .
						'`camp_pic` = :pic ' .
						'WHERE `camp_id` = :id';

		$stmt = $this->db->prepare($sql);

		if ($stmt) {
			$stmt->bindValue(':name', $campus->getName());
			$stmt->bindValue(':address', $campus->getAddress());
			$stmt->bindValue(':city', $campus->getCity());
			$stmt->bindValue(':postal', $campus->getPostal());
			$stmt->bindValue(':telephone', $campus->getTelephone());
			$stmt->bindValue(':lat', $campus->getLat());
			$stmt->bindValue(':lng', $campus->getLng());
			$stmt->bindValue(':pic', $campus->getPic());
			$stmt->bindValue(':id', $campus->getId());

			$stmt->execute();
		}
	}

}
