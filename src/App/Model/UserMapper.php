<?php

namespace App\Model;

use Ahs\Error;
use Ahs\ModelMapperAbstract;

class UserMapper extends ModelMapperAbstract
{

	/**
	 * Create user
	 * 
	 * @param \App\Model\User $user
	 * @return \App\Model\User
	 * @throws \Exception
	 * @throws \ErrorException
	 */
	public function create(User $user)
	{
		$sql = 'INSERT INTO `users` ' .
						'(`usr_givenname`, ' .
						'`usr_familyname`, ' .
						'`usr_email`, ' .
						'`usr_pic`, ' .
						'`usr_password`, ' .
						'`usr_salt`) ' .
						'VALUES (' .
						':givenname, ' .
						':familyname, ' .
						':email, ' .
						':pic, ' .
						':password, ' .
						':salt )';

		$stmt = $this->db->prepare($sql);
		if ($stmt) {
			$stmt->bindValue(':givenname', $user->getGivenname());
			$stmt->bindValue(':familyname', $user->getFamilyname());
			$stmt->bindValue(':email', $user->getEmail());
			$stmt->bindValue(':pic', $user->getPic());
			$stmt->bindValue(':password', $user->getPassword());
			$stmt->bindValue(':salt', $user->getSalt());

			if ($stmt->execute()) {
				$user->setId($this->db->lastInsertId());
				return $user;
			}
			throw new \Exception(sprintf(Error::MESSAGE_CREATE, get_class($user)));
		}
		throw new \ErrorException(Error::MESSAGE_UNEXPECTED);
	}

	/**
	 * Read User
	 * 
	 * @param \App\Model\User $user
	 * @return \App\Model\User
	 * @throws \Exception
	 * @throws \ErrorException
	 */
	public function read(User $user)
	{
		$sql = 'SELECT ' .
						'`usr_id` as `id`, ' .
						'`usr_givenname` as `givenname`, ' .
						'`usr_familyname` as `familyname`, ' .
						'`usr_email` as `email`, ' .
						'`usr_pic` as `pic`, ' .
						'`usr_created` as `created` ' .
						'FROM `users` ' .
						'WHERE `usr_id` = :id ' .
						'LIMIT 1';

		$stmt = $this->db->prepare($sql);
		if ($stmt) {
			$stmt->bindValue(':id', $user->getId());

			if ($stmt->execute()) {
				if ($row = $stmt->fetch()) {
					return new User($row);
				}
				return new User();
			}
			throw new \Exception(sprintf(Error::MESSAGE_READ, get_class($user)));
		}
		throw new \ErrorException(Error::MESSAGE_UNEXPECTED);
	}
	
	/**
	 * Check if user with adress exists
	 * 
	 * @param \App\Model\User $user
	 * @return \App\Model\User
	 * @throws \Exception
	 * @throws \ErrorException
	 */
	public function checkAvailable(User $user)
	{
		$sql = 'SELECT ' .
						'`usr_id` as `id`, ' .
						'`usr_givenname` as `givenname`, ' .
						'`usr_familyname` as `familyname`, ' .
						'`usr_email` as `email`, ' .
						'`usr_pic` as `pic`, ' .
						'`usr_created` as `created` ' .
						'FROM `users` ' .
						'WHERE `usr_email` = :email ' .
						'LIMIT 1';

		$stmt = $this->db->prepare($sql);
		if ($stmt) {
			$stmt->bindValue(':email', $user->getEmail());

			if ($stmt->execute()) {
				if ($row = $stmt->fetch()) {
					return new User($row);
				}
				return new User();
			}
			throw new \Exception(sprintf(Error::MESSAGE_READ, get_class($user)));
		}
		throw new \ErrorException(Error::MESSAGE_UNEXPECTED);
	}

	
	/**
	 * Update user
	 * 
	 * @param \App\Model\User $user
	 * @return \App\Model\User
	 * @throws \Exception
	 * @throws \ErrorException
	 */
	public function update(User $user)
	{
			$sql = 'UPDATE `users` ' .
							'SET `usr_givenname` = :givenname, ' .
							'`usr_familyname` = :familyname, ' .
							'`usr_email` = :email, ' .
							'`usr_pic` = :pic, ' .
							'`usr_password` = :password, ' .
							'`usr_salt` = :salt ' .
							'WHERE `usr_id` = :id';

			$stmt = $this->db->prepare($sql);
			if ($stmt) {
				$stmt->bindValue(':givenname', $user->getGivenname());
				$stmt->bindValue(':familyname', $user->getFamilyname());
				$stmt->bindValue(':email', $user->getEmail());
				$stmt->bindValue(':pic', $user->getPic());
				$stmt->bindValue(':password', $user->getPassword());
				$stmt->bindValue(':salt', $user->getSalt());
				$stmt->bindValue(':id', $user->getId());

				$stmt->execute();
		}
	}

	

	/**
	 * Read User Authenticate
	 * 
	 * @param \App\Model\User $user
	 * @return \App\Model\User
	 * @throws \Exception
	 * @throws \ErrorException
	 */
	public function readAuthenticate(User $user)
	{
		$sql = 'SELECT ' .
						'`usr_id` as `id`, ' .
						'`usr_givenname` as `givenname`, ' .
						'`usr_familyname` as `familyname`, ' .
						'`usr_email` as `email`, ' .
						'`usr_pic` as `pic`, ' .
						'`usr_created` as `created` ' .
						'FROM `users` ' .
						'WHERE `usr_email` = :email ' .
						'AND ' .
						'`usr_password` = :password ' .
						'LIMIT 1';

		$stmt = $this->db->prepare($sql);
		if ($stmt) {
			$stmt->bindValue(':email', $user->getEmail());
			$stmt->bindValue(':password', $user->getPassword());

			if ($stmt->execute()) {
				if ($row = $stmt->fetch()) {
					return new User($row);
				}
				return new User();
			}
			throw new \Exception(sprintf(Error::MESSAGE_READ_AUTHENTICATE, get_class($user)));
		}
		throw new \ErrorException(Error::MESSAGE_UNEXPECTED);
	}

	/**
	 * Set Credentials User
	 * 
	 * @param \App\Model\User $user
	 * @return \App\Model\User
	 * @throws \Exception
	 */
	public function setCredentials(User $user)
	{
		$sql = 'SELECT `usr_salt` AS `salt` '
						. 'FROM `users` '
						. 'WHERE `usr_email` = :email '
						. 'LIMIT 1';

		$stmt = $this->db->prepare($sql);
		if ($stmt) {
			$stmt->bindValue(':email', $user->getEmail());

			if ($stmt->execute()) {
				if ($row = $stmt->fetch()) {
					$user->setSalt($row['salt']);
					return $user;
				}
				throw new \Exception(sprintf(Error::MESSAGE_READ_VERIFY, get_class($user)));
			}
			throw new \Exception(sprintf(Error::MESSAGE_READ_CREDENTIALS, get_class($user)));
		}
		throw new \Exception(Error::MESSAGE_UNEXPECTED);
	}


}
