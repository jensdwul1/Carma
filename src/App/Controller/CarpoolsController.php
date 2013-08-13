<?php

namespace App\Controller;

use Ahs\ControllerAbstract;
use App\Model\UserMapper;
use App\Model\CarpoolMapper;
use App\Model\PassengerMapper;


class CarpoolsController extends ControllerAbstract
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
		
		
		// CAMPUSES OPHALEN UIT DB
		$campusMapper = new CampusMapper();
		$view->campuses = $campusMapper->readAll();
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
		
		/*// PASSENGER AANMAKEN
			$passengerMapper = new PassengerMapper();
			if ($view->hasIdentity) {
				$view->passengers = $passengerMapper->readForUser($passenger);
			}

			if( isset( $_POST['here'] ) ) {
				// CHECK IF USER LOGGED IN
				if ($view->hasIdentity)
				{
					// CHECK IF USER NOT ALREADY A PASSENGER
//					if (!empty($view->checkins))
//					{
						$passenger = new \App\Model\Passenger();
						$passenger->setCampus($view->carpool->getCampus());
						$passenger->setUser($user);
						$passengerMapper->create($passenger);
//					}
				}
				$seats = $view->carpool->getSeats();
				
			}*/
		}
		catch (\Exception $ex) {
				$ex->getMessage();
		}
	}
	
	/**
	 * New Carpool
	 * user/newcarpool
	 * 
	 * @return type
	 */
	public function newcarpoolAction()
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
		}
		catch (\Exception $ex) {
				$ex->getMessage();
		}
		
		// ANDERS
		if (isset($_POST) && isset($_POST['btnNewCarpool'])) {
			$carpool = new Carpool($_POST);

			try {
				$carpoolMapper = new CarpoolMapper();
				$carpoolMapper->create($carpool);
                            }
			catch (\ErrorException $e) {
				die($e->getMessage());
			}
			catch (\Exception $e) {
				die($e->getMessage());
			}

			if ($carpool->getId() !== null) {
				return $this->redirect(PATH_WEBROOT . '/user');
			}
		}
		$campusMapper = new CampusMapper();
		$view->campuses = $campusMapper->readAll();
		return $view;
	}

	/**
	 * carpool/editcarpool
	 * Update formulier
	 */
	public function editcarpoolAction()
	{
		if ($this->session->has('user')) {
			if (isset($_POST) && isset($_POST['btnEditCarpool'])) {
				try {
					$carp_id = (int) $_POST['carp_id'];

					$carpool = new Carpool([
							'id' => $carp_id
					]);

					$view = $this->getView();

					$carpoolMapper = new CarpoolMapper();
					$view->carpool = $carpoolMapper->read($carpool);

					$campusMapper = new campusMapper();
					$user = $this->session->read('user');
					$view->campuses = $campusMapper->readAll();
				}
				catch (Exception $ex) {
					$ex->getMessage();
				}
			} else {
				$this->redirect(PATH_WEBROOT . '/user');
			}
		} else {
			$this->redirect(PATH_WEBROOT . '/user');
		}
	}

	/**
	 * user/updatecarpool
	 * 
	 * dient enkel om de bewerking te verwerken en door te verwijzen
	 */
	public function updatecarpoolAction()
	{
		if ($this->session->has('user')) {
			if (isset($_POST) && isset($_POST['btnUpdateCarpool'])) {

				$carpool = new Carpool($_POST);

				try {
					$carpoolMapper = new CarpoolMapper();
					$carpoolMapper->update($carpool);

					$this->redirect(PATH_WEBROOT . '/user');
				}
				catch (Exception $ex) {
					$ex->getMessage();
				}
			} else {
				$this->redirect(PATH_WEBROOT . '/user');
			}
		} else {
			$this->redirect(PATH_WEBROOT . '/user');
		}
	}

}