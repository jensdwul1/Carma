<?php

namespace App\Model;

use Ahs\ModelAbstract;

class Passenger extends ModelAbstract
{

	/**
	 * Passenger id
	 * 
	 * @var int
	 */
	protected $id;

	/**
	 * Passenger Carpool
	 * 
	 * @var carpool
	 */
	
	protected $carpool;

	/**
	 * Passenger User
	 * 
	 * @var user
	 */
	protected $user;

	/**
	 * 
	 * @param array $data
	 */
	public function __construct(array $data = [])
	{
		foreach ($data as $key => $value) {
			switch ($key) {
				case 'id':
					$this->setId($value);
					break;
				
				case 'carpool':
					$carpool = new Carpool(['id' => $value]);
					$carpoolmapper = new CarpoolMapper();
					$this->setCarpool($carpoolmapper->Read($carpool));
					break;
				case 'user':
					$user = new User(['id' => $value]);
					$usermapper = new UserMapper();
					$this->setUser($usermapper->Read($user));
					break;
				default:
					break;
			}
		}
	}

	/**
	 * Get Passenger Id
	 * 
	 * @return int
	 */
	public function getId()
	{
		return $this->id;
	}

	/**
	 * Set Passenger Id
	 * 
	 * @param int $id
	 */
	public function setId($id)
	{
		$this->id = $id;
	}

	/**
	 * Get Passenger Date
	 * 
	 * @return string
	 */
	
	/**
	 * Get Passenger Carpool
	 * 
	 * @return carpool
	 */
	public function getCarpool()
	{
		return $this->carpool;
	}

	/**
	 * Set Passenger Carpool
	 * 
	 * @param \App\Model\carpool $carpool
	 */
	public function setCarpool(carpool $carpool)
	{
		$this->carpool = $carpool;
	}

	/**
	 * Get Passenger User
	 * 
	 * @return user
	 */
	public function getUser()
	{
		return $this->user;
	}

	/**
	 * Set Passenger User
	 * 
	 * @param \App\Model\user $user
	 */
	public function setUser(user $user)
	{
		$this->user = $user;
	}

}
