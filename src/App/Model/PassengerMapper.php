<?php

namespace App\Model;

use Ahs\Error;
use Ahs\ModelMapperAbstract;

class PassengerMapper extends ModelMapperAbstract
{

	/**
	 * Read Passenger
	 * 
	 * @param \App\Model\Passenger $passenger
	 * @return \App\Model\Passenger
	 * @throws \Exception
	 */
	public function read(Passenger $passenger)
	{
		$sql = 'SELECT ' .
						'`pass_id` as `id`, ' .
						'`pass_accepted` as `state`, ' .
						'`carp_id` as `carpoool`, ' .
						'`usr_id` as `user` ' .
						'FROM `passengers` ' .
						'WHERE `pass_id` = :id ' .
						'LIMIT 1';

		$stmt = $this->db->prepare($sql);

		if ($stmt) {
			$stmt->bindValue(':id', $passenger->getId());

			if ($stmt->execute()) {
				$row = $stmt->fetch();
				return new Passenger($row);
			}
			throw new \Exception(sprintf(Error::MESSAGE_READ, get_class($passenger)));
		}
		throw new \Exception(Error::MESSAGE_UNEXPECTED);
	}

	/**
	 * Create a new Passenger
	 * 
	 * @param \App\Model\Passenger $passenger
	 * @return \App\Model\Passenger
	 * @throws \Exception
	 * @throws \ErrorException
	 */
	public function create(Passenger $passenger)
	{
		$sql = 'INSERT INTO `passengers` (`state`, `carp_id`, `usr_id`) VALUES (:state, :carp_id, :usr_id)';

		$stmt = $this->db->prepare($sql);
		if ($stmt) {
			$stmt->bindValue(':state', $passenger->getState());
			$stmt->bindValue(':carp_id', $passenger->getCarpool()->getId());
			$stmt->bindValue(':usr_id', $passenger->getUser()->getId());
			
			if ($stmt->execute()) {
				$passenger->setId($this->db->lastInsertId());

				return $passenger;
			}
			throw new \Exception('Could not create Passenger');
		}
		throw new \ErrorException('Unexpected Error');
	}

	/**
	 * Delete a passenger
	 * 
	 * @param \App\Model\Passenger $passenger
	 */
	public function delete(Passenger $passenger)
	{
		$sql = 'DELETE FROM `passengers` WHERE `pass_id` = :id';

		$stmt = $this->db->prepare($sql);
		if ($stmt) {
			$stmt->bindValue(':id', $passenger->getId());

			$stmt->execute();
		}
	}

	/**
	 * Read Last Passenger for specific user
	 * 
	 * @param \App\Model\User $user
	 * @return \App\Model\Passenger
	 * @throws \Exception
	 */
	public function readLastPassenger(Passenger $passenger)
	{
		$sql = 'SELECT ' .
						'`pass_id` as `id`, ' .
						'`pass_accepted` as `state`, ' .
						'`carp_id` as `carpoool`, ' .
						'`usr_id` as `user` ' .
						'FROM `passengers` ' .
						'WHERE `usr_id` = :usr_id ' .
						'ORDER BY `pass_id` DESC ' .
						'LIMIT 1';

		$stmt = $this->db->prepare($sql);

		if ($stmt) {
			$stmt->bindValue(':usr_id', $user->getId());

			if ($stmt->execute()) {
				while ($row = $stmt->fetch()) {
					$passenger = new Passenger($row);
				}
				return $passenger;
			}
			throw new \Exception(sprintf(Error::MESSAGE_READ, get_class($user)));
		}
		throw new \Exception(Error::MESSAGE_UNEXPECTED);
	}

	/**
	 * Read for user
	 * 
	 * @param \App\Model\User $user
	 * @return \App\Model\Passenger
	 * @throws \Exception
	 */
	public function readForUser(Passenger $passenger)
	{
		$sql = 'SELECT ' .
						'`pass_id` as `id`, ' .
						'`pass_accepted` as `state`, ' .
						'`carp_id` as `carpoool`, ' .
						'`usr_id` as `user` ' .
						'FROM `passengers` ' .
						'WHERE `usr_id` = :usr_id ' .
						'ORDER BY `pass_id` DESC ' .
						'LIMIT 10';

		$stmt = $this->db->prepare($sql);

		if ($stmt) {
			$stmt->bindValue(':usr_id', $user->getId());

			$passengers = [];
			if ($stmt->execute()) {
				while ($row = $stmt->fetch()) {
					$passengers[] = new Passenger($row);
				}
				return $passengers;
			}
			throw new \Exception(sprintf(Error::MESSAGE_READ, get_class($user)));
		}
		throw new \Exception(Error::MESSAGE_UNEXPECTED);
	}
	
	/**
	 * Read for user
	 * 
	 * @param \App\Model\User $user
	 * @return \App\Model\Passenger
	 * @throws \Exception
	 */
	public function readForCarpool(Passenger $passenger)
	{
		$sql = 'SELECT ' .
						'`pass_id` as `id`, ' .
						'`pass_accepted` as `state`, ' .
						'`carp_id` as `carpoool`, ' .
						'`usr_id` as `user` ' .
						'FROM `passengers` ' .
						'WHERE `carp_id` = :carp_id ' .
						'ORDER BY `pass_id` DESC ' .
						'LIMIT 10';

		$stmt = $this->db->prepare($sql);

		if ($stmt) {
			$stmt->bindValue(':carp_id', $carpool->getId());

			$passengers = [];
			if ($stmt->execute()) {
				while ($row = $stmt->fetch()) {
					$passengers[] = new Passenger($row);
				}
				return $passengers;
			}
			throw new \Exception(sprintf(Error::MESSAGE_READ, get_class($user)));
		}
		throw new \Exception(Error::MESSAGE_UNEXPECTED);
	}

	
	/**
	 * Read Last Five Passengers for User
	 * 
	 * @param \App\Model\User $user
	 * @return \App\Model\Passenger
	 * @throws \Exception
	 */
	public function readLastFiveForUser(Passenger $passenger)
	{
		$sql = 'SELECT ' .
						'`pass_id` as `id`, ' .
						'`pass_accepted` as `state`, ' .
						'`carp_id` as `carpoool`, ' .
						'`usr_id` as `user` ' .
						'FROM `passengers` ' .
						'WHERE `usr_id` = :usr_id ' .
						'ORDER BY `pass_id` DESC ' .
						'LIMIT 5';

		$stmt = $this->db->prepare($sql);

		if ($stmt) {
			$stmt->bindValue(':usr_id', $user->getId());

			$passengers = [];
			if ($stmt->execute()) {
				while ($row = $stmt->fetch()) {
					$passengers[] = new Passenger($row);
				}
				return $passengers;
			}
			throw new \Exception(sprintf(Error::MESSAGE_READ, get_class($user)));
		}
		throw new \Exception(Error::MESSAGE_UNEXPECTED);
	}

	
	
}
