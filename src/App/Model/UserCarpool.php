<?php

namespace App\Model;

use Ahs\ModelAbstract;

class UserCarpool extends ModelAbstract
{

	/**
	 * User Carpool ID
	 * 
	 * @var int 
	 */
	protected $id;

	/**
	 * User Carpool - Carpool ID
	 * 
	 * @var Carpool 
	 */
	protected $carpool;

	/**
	 * User Carpool - User ID
	 * 
	 * @var User 
	 */
	protected $user;

	/**
	 * 
	 * @param array $data
	 */
	public function __construct(array $data = []) {
		foreach ($data as $key => $value) {
			switch ($key) {
				case 'id':
					$this->setUsrpro_id($value);
					break;
				case 'carpool':
					$carpool = new Carpool(['id' => $value]);
					$carpoolMapper = new CarpoolMapper();
					$this->setCarpool($carpoolMapper->read($carpool));
					break;
				case 'user':
					$user = new User(['id' => $value]);
					$userMapper = new UserMapper();
					$this->setUser($userMapper->read($user));
				default:
					break;
			}
		}
	}
	
	/**
	 * Get User Carpool ID
	 * 
	 * @return int
	 */
	public function getId()
	{
		return $this->id;
	}

	/**
	 * Set User Carpool ID
	 * 
	 * @param int $id
	 */
	public function setId($id)
	{
		$this->id = $id;
	}

	/**
	 * Get User Carpool Carpool
	 * 
	 * @return Carpool
	 */
	public function getCarpool()
	{
		return $this->carpool;
	}

	/**
	 * Set User Carpool Carpool
	 * 
	 * @param Carpool $carpool
	 */
	public function setCarpool($carpool)
	{
		$this->carpool = $carpool;
	}

	/**
	 * Get User Carpool User
	 * 
	 * @return User
	 */
	public function getUser()
	{
		return $this->user;
	}

	/**
	 * Set User Carpool User
	 * 
	 * @param User $user
	 */
	public function setUser($user)
	{
		$this->user = $user;
	}



}
