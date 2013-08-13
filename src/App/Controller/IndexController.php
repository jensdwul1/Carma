<?php

namespace App\Controller;

use Ahs\ControllerAbstract;
use App\Model\UserMapper;
use App\Model\CarpoolMapper;
use App\Model\PassengerMapper;

class IndexController extends ControllerAbstract
{

	/**
	 * carpools/index
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

		// ALLE CARPOOLS OPHALEN
		$carpoolMapper = new CarpoolMapper();
		$view->carpools = $carpoolMapper->readAll();
	}

	/**
	 * carpools/carpool
	 */
	public function carpoolAction()
	{
		$view = $this->getView();
		
		try{
			// USER CHECK
			$view->hasIdentity = $this->session->has('user');
			if ($view->hasIdentity) {
				$user = $this->session->read('user');

				$userMapper = new UserMapper();
				$view->user = $userMapper->read($user);
			}

			// CARPOOLMAPPER AANMAKEN
			$carpoolMapper = new CarpoolMapper();

			// HAAL ARGUMENTEN OP UIT URL
			$args = \Ahs\Route::getArgs();

			// FOUTAHNDELING
			if (isset($args['id'])) {
				$id = (int) $args['id'];
				if ($carpoolMapper->checkIfCarpoolExists($id) == false) {
					// omleiden naar error-page als id niet bestaat
					$_SESSION['error'] = array (
							"text"  => "Carpool doesn't exist.",
							"page" => "http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]"
					);
					$this->redirect(PATH_WEBROOT . '/error');
				}
			} else {
				// omleiden naar index als id niet bestaat
				$this->redirect(PATH_WEBROOT . '/carpools');
			}

			// LEES DE CARPOOL ADHV DE ID
			$view->carpool = $carpoolMapper->readID($id);
		
		// CHECKIN AANMAKEN
			$checkinMapper = new CheckinMapper();
			if ($view->hasIdentity) {
				$view->passengers = $passengerMapper->readForUser($user);
			}

			if( isset( $_POST['here'] ) ) {
				// CHECK IF USER LOGGED IN
				if ($view->hasIdentity)
				{
					// CHECK IF USER NOT ALREADY CHEKED IN
//					if (!empty($view->checkins))
//					{
						$passenger = new \App\Model\Passenger();
						$passenger->setCampus($view->carpool->getCampus());
						$passenger->setUser($user);
						$passengerMapper->create($passenger);
//					}
				}
				$seats = $view->carpool->getSeats();
				
			}
		}
		catch (\Exception $ex) {
				$ex->getMessage();
		}
	}
}
