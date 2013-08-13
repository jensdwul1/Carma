<?php

namespace App\Model;

use Ahs\ModelAbstract;

class Carpool extends ModelAbstract
{

	/**
	 * Carpool id
	 * 
	 * @var int
	 */
	protected $id;

	/**
	 * Carpool title
	 * 
	 * @var string
	 */
	protected $title;

	/**
	 * Carpool description
	 * 
	 * @var string
	 */
	protected $description;

	/**
	 * Carpool Start
	 * 
	 * @var string 
	 */
	protected $departure;

	/**
	 * Carpool seats
	 * 
	 * @var double 
	 */
	protected $seats;

	/**
	 * Carpool campus
	 * 
	 * @var int 
	 */
	protected $campus;
	
	/**
	 * Carpool user
	 * 
	 * @var int 
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
				case 'title':
					$this->setTitle($value);
					break;
				case 'description':
					$this->setDescription($value);
					break;
				case 'departure':
					$this->setDeparture($value);
					break;
				case 'lat':
					$this->setLat($value);
					break;
				case 'lng':
					$this->setLng($value);
					break;
				case 'seats':
					$this->SetSeats($value);
					break;
				case 'campus':
					$campus = new Campus(['id' => $value]);
					$campusMapper = new CampusMapper();
					$this->setCampus($campusMapper->read($campus));
					break;
				case 'user':
					$user = new User(['id' => $value]);
					$userMapper = new UserMapper();
					$this->setUser($userMapper->read($user));
					break;
				default:
					break;
			}
		}
	}

	/**
	 * Get Carpool id
	 * 
	 * @return int
	 */
	public function getId()
	{
		return $this->id;
	}

	/**
	 * Set Carpool Id
	 * 
	 * @param int $id
	 */
	public function setId($id)
	{
		$this->id = $id;
	}

	/**
	 * Get Carpool Title
	 * 
	 * @return string
	 */
	public function getTitle()
	{
		return $this->title;
	}

	/**
	 * Set Carpool Title
	 * 
	 * @param string $title
	 */
	public function setTitle($title)
	{
		$this->title = $title;
	}

	/**
	 * Get Carpool Description
	 * 
	 * @return string
	 */
	public function getDescription()
	{
		return $this->description;
	}

	/**
	 * Set Carpool Description
	 * 
	 * @param string $description
	 */
	public function setDescription($description)
	{
		$this->description = $description;
	}

	/**
	 * Get Carpool Departure
	 * 
	 * @return string
	 */
	public function getDeparture()
	{
		return $this->departure;
	}

	/**
	 * Set Carpool Departure
	 * 
	 * @param string $Departure
	 */
	public function setDeparture($departure)
	{
		$this->departure = $departure;
	}
		/**
	 * Get Carpool Latitude
	 * 
	 * @return float
	 */
	public function getLat()
	{
		return $this->lat;
	}

	/**
	 * Set Carpool Latitude
	 * 
	 * @param float $lat
	 */
	public function setLat($lat)
	{
		$this->lat = $lat;
	}

	/**
	 * Get Carpool Longitude
	 * 
	 * @return float
	 */
	public function getLng()
	{
		return $this->lng;
	}

	/**
	 * Set Carpool Longitude
	 * 
	 * @param float $lng
	 */
	public function setLng($lng)
	{
		$this->lng = $lng;
	}

	/**
	 * Get Carpool Seats
	 * 
	 * @return double
	 */
	public function getSeats()
	{
		return $this->seats;
	}

	/**
	 * Set Carpool Seats
	 * 
	 * @param double $seats
	 */
	public function setSeats($seats)
	{
		$this->seats = $seats;
	}

	/**
	 * Get Carpool Campus
	 * 
	 * @return Campus
	 */
	public function getCampus()
	{
		return $this->campus;
	}

	/**
	 * Set Carpool Campus
	 * 
	 * @param Campus $campus
	 */
	public function setCampus(Campus $campus)
	{
		$this->campus = $campus;
	}
	/**
	 * Get Carpool User
	 * 
	 * @return User
	 */
	public function getUser()
	{
		return $this->user;
	}

	/**
	 * Set Carpool User
	 * 
	 * @param User $user
	 */
	public function setUser(User $user)
	{
		$this->user = $user;
	}
	
	
	public function toArray()
	{
		return [
				'id' => $this->getId(),
				'name' => $this->getTitle(),
				'seats' => $this->getSeats(),
				'user' => $this->getUser(),
				'campus' => $this->getCampus()
				];
	}

}
