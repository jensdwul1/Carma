<?php

namespace App\Controller;

use Ahs\ControllerAbstract;
use App\Model\User;
use App\Model\UserMapper;

class UserController extends ControllerAbstract
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

			// READ CARPOOLS
			$carpoolMapper = new CarpoolMapper();
			$view->carpools = $carpoolMapper->readForUser($user);
		} else {
			// Zo niet, omleiden naar de login-pagina
			return $this->redirect('/user/login');
		}
	}

	/**
	 * user/login
	 * 
	 * @return mixed
	 */
	public function loginAction()
	{
		if (!isset($_POST['btnLogin']))
		{
			$_SESSION['Error'] = "";
		}
		// ALS ER AL EEN GEBRUIKER IS INGELOGD,
		// OMLEIDEN NAAR USER/INDEX
		if ($this->session->has('user')) {
			return $this->redirect(PATH_WEBROOT . '/user');
		}
		// 
		else if (isset($_POST) && isset($_POST['btnLogin'])) {
			$user = new User($_POST);

			try {
				$userMapper = new UserMapper();
				$userMapper->setCredentials($user);
				$user = $userMapper->readAuthenticate($user);
			}
			catch (\ErrorException $e) {
				die($e->getMessage());
			}
			catch (\Exception $e) {
				$_SESSION["Error"] = "Username & password invalid";
			}

			if ($user->getId() !== null) {
				$this->session->create('user', $user);
				$this->redirect(PATH_WEBROOT . '/user');
			}
			else
			{
				$_SESSION["Error"] = "Username & password invalid";
			}
		}

		return $view = $this->getView();
	}

	/**
	 * user/register
	 * 
	 * @return redirect
	 */
	public function registerAction()
	{
		// ALS GEBRUIKER AL IS INGELOGD
		// OMLEIDEN NAAR USER/INDEX
		if ($this->session->has('user')) {
			$this->redirect(PATH_WEBROOT . '/user');
		}
		// ANDERS EEN NIEUWE GEBRUIKER LATEN AANMAKEN
		elseif (isset($_POST) && isset($_POST['btnRegister'])) {
			$user = new User($_POST, true);
			if(!preg_match("/\b(?:(?:https?|ftp):\/\/|www\.)[-a-z0-9+&@#\/%?=~_|!:,.;]*[-a-z0-9+&@#\/%=~_|]/i", $_POST["pic"]))
			{
				$_SESSION["Error"] = "Link to picture is not correct";
			}
			else {
				try {
					$userMapper = new UserMapper();
					$check = $userMapper->checkAvailable($user);
					if ($check->getId() == null)
					{
						$userMapper->create($user);
						return $this->redirect(PATH_WEBROOT . '/user/login');
					}
					else { $_SESSION["Error"] = "Emailadress already exists."; }
					
				}
				catch (\ErrorException $e) {
					die($e->getMessage());
				}
				catch (\Exception $e) {
					die($e->getMessage());
				}
			}
		}

		// ALS ER NIETS GEBEURT, DAN GEWOON DE PAGINA TONEN
		return $view = $this->getView();
	}

	/**
	 * user/edituser
	 * bewerk de gebruiker en weergave formulier
	 */
	public function edituserAction()
	{
		if ($this->session->has('user')) {
			if (isset($_POST) && isset($_POST['btnEditUser'])) {
				try {
					$usr_id = (int) $_POST['usr_id'];

					$user = new User([
							'id' => $usr_id
					]);

					$view = $this->getView();

					$userMapper = new UserMapper();
					$view->user = $userMapper->read($user);
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
	 * updateuser
	 * enkel verwerken en doorverwijzen
	 */
	public function updateuserAction()
	{
		if ($this->session->has('user')) {
			if (isset($_POST) && isset($_POST['btnUpdateUser'])) {

				$user = new User($_POST, true);

				try {
					$userMapper = new UserMapper();
					$userMapper->update($user);

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
/**
	 * All Carpools
	 * 
	 * @return type
	 */
	public function allcarpoolsAction()
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

			// READ CARPOOLS
			$carpoolMapper = new CarpoolMapper();
			$view->carpools = $carpoolMapper->readForUser($user);
		} else {
			// Zo niet, omleiden naar de login-pagina
			return $this->redirect(PATH_WEBROOT . '/user/login');
		}
	}

	// UITLOGGEN
	public function logoutAction()
	{
		$this->session->destroy();
		$this->redirect(PATH_WEBROOT);
	}

}
