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
		// is de gebruiker ingelogd?
		if ($this->session->has('user')) {
			// SHOW USER CENTER
			$view = $this->getView();
			$view->hasIdentity = true;

			$user = $this->session->read('user');

			// READ THE USER
			$userMapper = new UserMapper();
			$view->user = $userMapper->read($user);

			
			// READ CAMPUSES 
			$campusMapper = new CampusMapper();
			$view->campuses = $campusMapper->readAll();
			} else {
				// If not, Redirect
				return $this->redirect(PATH_WEBROOT . '/user/login');
			}
	}
}
?>