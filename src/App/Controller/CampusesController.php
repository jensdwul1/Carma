<?php

namespace App\Controller;

use Ahs\ControllerAbstract;
use App\Model\CampusMapper;
use App\Model\UserMapper;

class CampusesController extends ControllerAbstract
{

	/**
	 * campuses/index
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

	/**
	 * campuses/campus
	 */
	public function campusAction()
	{

		$view = $this->getView();

		// CAMPUSMAPPER AANMAKEN
		$campusMapper = new CampusMapper();
		// HAAL ARGUMENTEN UIT DE URL
		$args = \Ahs\Route::getArgs();
		if (isset($args['id'])) {
			$id = (int) $args['id'];
			if ($campusMapper->checkIfCampusExists($id) == false) {
				// omleiden naar error-page als id niet bestaat
				$_SESSION['error'] = array (
							"text"  => "Campus doesn't exsist.",
							"page" => "http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]"
					);
				$this->redirect(PATH_WEBROOT . '/error');
			}
		} else {
			$this->redirect(PATH_WEBROOT . '/campuses');
		}
		// LEES HET CAMPUS AHDV ID
		$view->campus = $campusMapper->readID($id);

		$view->hasIdentity = $this->session->has('user');
		if ($view->hasIdentity) {
			$view->user = $this->session->read('user');
		}
	}
}