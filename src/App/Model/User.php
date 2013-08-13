<?php

namespace App\Model;

use Ahs\ModelAbstract;
use Ahs\Security;

class User extends ModelAbstract
{

	/**
	 * User id
	 * 
	 * @var int  
	 */
	protected $id;

	/**
	 * User Given Name
	 * 
	 * @var string
	 */
	protected $givenname;

	/**
	 * User Family Name
	 * 
	 * @var string
	 */
	protected $familyname;

	/**
	 * User Emailaddress
	 * 
	 * @var string
	 */
	protected $email;

	/**
	 * User Points
	 * 
	 * @var int
	 */
	
	protected $pic;

	/**
	 * User Password
	 * 
	 * @var string
	 */
	protected $password;

	/**
	 * User Salt
	 * 
	 * @var string
	 */
	protected $salt;

	/**
	 * User Created Date
	 * 
	 * @var string
	 */
	protected $createddate;

	/**
	 * @param array $data
	 * @param type $salt
	 */
	public function __construct(array $data = [], $salt = false)
	{
		foreach ($data as $key => $value) {
			switch ($key) {
				case 'id':
					$this->setId($value);
					break;
				case 'givenname':
					$this->setGivenname($value);
					break;
				case 'familyname':
					$this->setFamilyname($value);
					break;
				case 'email':
					$this->setEmail($value);
					break;
				case 'pic':
					$this->setPic($value);
					break;
				case 'password':
					$this->setPassword($value);
					break;
				case 'created':
					$this->setCreateddate($value);
					break;
				default:
					break;
			}
		}

		// Moet uitgevoerd worden nadat het wachtwoord ingesteld is.
		if (isset($data['salt']) && !empty($data['salt'])) {
			$this->setSalt($data['salt']);
		} elseif ($salt) {
			$this->setSalt();
		}
	}

	/**
	 * Get User id
	 * 
	 * @return int
	 */
	public function getId()
	{
		return $this->id;
	}

	/**
	 * Set User id
	 * 
	 * @param int $id
	 */
	public function setId($id)
	{
		$this->id = $id;
	}

	/**
	 * Get User Givenname
	 * 
	 * @return string
	 */
	public function getGivenname()
	{
		return $this->givenname;
	}

	/**
	 * Set User Givenname
	 * 
	 * @param string $givenname
	 */
	public function setGivenname($givenname)
	{
		$this->givenname = $givenname;
	}

	/**
	 * Get User Familyname
	 * 
	 * @return string
	 */
	public function getFamilyname()
	{
		return $this->familyname;
	}

	/**
	 * Set User Familyname
	 * 
	 * @param string $familyname
	 */
	public function setFamilyname($familyname)
	{
		$this->familyname = $familyname;
	}

	/**
	 * Get User Emailaddress
	 * 
	 * @return string
	 */
	public function getEmail()
	{
		return $this->email;
	}

	/**
	 * Set User Emailaddress
	 * 
	 * @param string $email
	 */
	public function setEmail($email)
	{
		$this->email = $email;
	}

	/**
	 * Get User Profile Pic
	 * 
	 * @return string
	 */
	public function getPic()
	{
		return $this->pic;
	}

	/**
	 * Set User Profile Pic
	 * 
	 * @param string $pic
	 */
	public function setPic($pic)
	{
		$this->pic = $pic;
	}

	/**
	 * Get User Password
	 * 
	 * @return string
	 */
	public function getPassword()
	{
		return $this->password;
	}

	/**
	 * Set User Password
	 * 
	 * @param string $password
	 */
	public function setPassword($password)
	{
		$this->password = $password;
	}

	/**
	 * Get Salt
	 * 
	 * @return string
	 */
	public function getSalt()
	{
		return $this->salt;
	}

	/**
	 * Set Salt
	 * 
	 * @param string $salt
	 */
	public function setSalt($salt = null)
	{
		$this->salt = ($salt === null) ? Security::generateSalt() : $salt;
		$this->password = Security::hash($this->password, $this->salt);
	}

	/**
	 * Get Created Date
	 * 
	 * @return string
	 */
	public function getCreateddate()
	{
		return $this->createddate;
	}

	/**
	 * Set Created Date
	 * 
	 * @param string $createddate
	 */
	public function setCreateddate($createddate)
	{
		$this->createddate = $createddate;
	}

}
