<?php

namespace App\Controller;

use Ahs\ControllerAbstract;
use App\Model\UserMapper;
use App\Model\CarpoolMapper;
use App\Model\PassengerMapper;
use App\Model\CampusMapper;

class TransitController extends ControllerAbstract
{

	/**
	 * user/index
	 * 
	 * @return mixed
	 */
	public function indexAction()
	{
		$view = $this->getView();

		// USER CHECK
		$view->hasIdentity = $this->session->has('user');
		if ($view->hasIdentity) {
			$user = $this->session->read('user');

			$userMapper = new UserMapper();
			$view->user = $userMapper->read($user);
		}

		// CAMPUSES OPHALEN UIT DB
		$campusMapper = new CampusMapper();
		$view->campuses = $campusMapper->readAll();
	}
}
?>