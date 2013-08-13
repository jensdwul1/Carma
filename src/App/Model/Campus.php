<?php

namespace App\Model;

use Ahs\ModelAbstract;

class Campus extends ModelAbstract
{

	/**
	 * Campus id
	 * 
	 * @var int 
	 */
	protected $id;

	/**
	 * Campus name
	 * 
	 * @var string 
	 */
	protected $name;

	/**
	 * Campus address
	 * 
	 * @var string 
	 */
	protected $address;

	/**
	 * Campus city
	 * 
	 * @var string 
	 */
	protected $city;

	/**
	 * Campus postal
	 * 
	 * @var int 
	 */
	protected $postal;

	/**
	 * Campus telephone
	 * 
	 * @var string 
	 */
	protected $telephone;

	/**
	 * Campus latitude
	 * 
	 * @var float 
	 */
	protected $lat;

	/**
	 * Campus longitude
	 * 
	 * @var float
	 */
	protected $lng;

	/**
	 * Campus Picture
	 * 
	 * @var string 
	 */
	protected $pic;

	public function __construct(array $data = [])
	{
		foreach ($data as $key => $value) {
			switch ($key) {
				case 'id':
					$this->setId($value);
					break;
				case 'name':
					$this->setName($value);
					break;
				case 'address':
					$this->setAddress($value);
					break;
				case 'city':
					$this->setCity($value);
					break;
				case 'postal':
					$this->setPostal($value);
					break;
				case 'telephone':
					$this->setTelephone($value);
					break;
				case 'lat':
					$this->setLat($value);
					break;
				case 'lng':
					$this->setLng($value);
					break;
				case 'pic':
					$this->setPic($value);
					break;
				default:
					break;
			}
		}
	}

	/**
	 * Get Campus id
	 * 
	 * @return int
	 */
	public function getId()
	{
		return $this->id;
	}

	/**
	 * Set Campus id
	 * 
	 * @param int $id
	 */
	public function setId($id)
	{
		$this->id = $id;
	}

	/**
	 * Get campus name
	 * 
	 * @return string
	 */
	public function getName()
	{
		return $this->name;
	}

	/**
	 * Set campus name
	 * 
	 * @param string $name
	 */
	public function setName($name)
	{
		$this->name = $name;
	}

	/**
	 * Get Campus address
	 * 
	 * @return string
	 */
	public function getAddress()
	{
		return $this->address;
	}

	/**
	 * Set Campus address
	 * 
	 * @param string $address
	 */
	public function setAddress($address)
	{
		$this->address = $address;
	}

	/**
	 * Get Campus City
	 * 
	 * @return string
	 */
	public function getCity()
	{
		return $this->city;
	}

	/**
	 * Set Campus City
	 * 
	 * @param string $city
	 */
	public function setCity($city)
	{
		$this->city = $city;
	}

	/**
	 * Get Campus Postal
	 * 
	 * @return int
	 */
	public function getPostal()
	{
		return $this->postal;
	}

	/**
	 * Set Campus Postal
	 * 
	 * @param int $postal
	 */
	public function setPostal($postal)
	{
		$this->postal = $postal;
	}

	/**
	 * Get Campus Telephone
	 * 
	 * @return string
	 */
	public function getTelephone()
	{
		return $this->telephone;
	}

	/**
	 * Set Campus Telephone
	 * 
	 * @param string $telephone
	 */
	public function setTelephone($telephone)
	{
		$this->telephone = $telephone;
	}

	/**
	 * Get Campus Latitude
	 * 
	 * @return float
	 */
	public function getLat()
	{
		return $this->lat;
	}

	/**
	 * Set Campus Latitude
	 * 
	 * @param float $lat
	 */
	public function setLat($lat)
	{
		$this->lat = $lat;
	}

	/**
	 * Get Campus Longitude
	 * 
	 * @return float
	 */
	public function getLng()
	{
		return $this->lng;
	}

	/**
	 * Set Campus Longitude
	 * 
	 * @param float $lng
	 */
	public function setLng($lng)
	{
		$this->lng = $lng;
	}

	/**
	 * Get Campus Pic
	 * 
	 * @return string
	 */
	public function getPic()
	{
		return $this->pic;
	}

	/**
	 * Set Campus Pic
	 * 
	 * @param string $pic
	 */
	public function setPic($pic)
	{
		$this->pic = $pic;
	}

	
	public function toArray()
	{
		return [
				'id' => $this->getId(),
				'name' => $this->getName()
		];
	}

}
