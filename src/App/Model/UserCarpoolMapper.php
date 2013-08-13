<?php

namespace App\Model;

use Ahs\Error;
use Ahs\ModelMapperAbstract;

class UserCarpoolMapper extends ModelMapperAbstract
{

	/**
	 * Read User Carpool
	 * 
	 * @param \App\Model\UserCarpool $usercarpool
	 * @return \App\Model\UserCarpool
	 * @throws \Exception
	 */
	public function read(UserCarpool $usercarpool)
	{
		$sql = 'SELECT ' .
						'`usrpro_id` as `id`, ' .
						'`carp_id` as `carpool`, ' .
						'`usr_id` as `user` ' .
						'FROM `usercarpools` ' .
						'WHERE `usrpro_id` = :id ' .
						'LIMIT 1';

		$stmt = $this->db->prepare($sql);
		if ($stmt) {
			$stmt->bindValue(':id', $usercarpool->getId());

			if ($stmt->execute()) {
				if ($row = $stmt->fetch()) {
					return new UserCarpool($row);
				}
				return new UserCarpool();
			}
			throw new \Exception(sprintf(Error::MESSAGE_READ, get_class($usercarpool)));
		}
		throw new \Exception(Error::MESSAGE_UNEXPECTED);
	}

	public function readAll()
	{
		$sql = 'SELECT ' .
						'`usrpro_id` as `id`, ' .
						'`carp_id` as `carpool`, ' .
						'`usr_id` as `user` ' .
						'FROM `usercarpools` ' .
						'ORDER BY `usrpro_id` ASC';

		$usercarpools = [];

		$stmt = $this->db->query($sql);
		while ($row = $stmt->fetch()) {
			$usercarpools = new UserCarpool($row);
		}

		return $usercarpools;
	}

	public function readAllForUser(User $user)
	{
		// TO DO
	}
	
	

}
