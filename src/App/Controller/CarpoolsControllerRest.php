<?php

namespace App\Controller;

use Ahs\ControllerRestAbstract;
use Ahs\Http;
use Ahs\Route;
use App\Model\CarpoolMapper;

class CarpoolsControllerRest extends ControllerRestAbstract
{

	public function indexAction()
	{
		$view = $this->getView();
		$view->setResponseCode(Http::STATUS_CODE_OK)
						->setBody(__CLASS__ . ' ' . __METHOD__);
	}

	public function deleteAction()
	{
		$view = $this->getView();
		$view->setResponseCode(Http::STATUS_CODE_OK)
						->setBody(__CLASS__ . ' ' . __METHOD__);
	}

	public function getAction()
	{
		$carpoolMapper = new CarpoolMapper();
		$carpools = $carpoolMapper->readAll();

		$view = $this->getView();

		if (empty($carpools)) {
			$view->setResponseCode(Http::STATUS_CODE_NO_CONTENT);
		} else {
			foreach ($carpools as $key => $carpool) {
				$carpools[$key] = $carpool->toArray();
			}
			$view->setResponseCode(Http::STATUS_CODE_OK)
							->setContentType(Http::CONTENT_TYPE_JSON)
							->setBody($carpools);
		}
	}

	public function headAction()
	{
		$view = $this->getView();
		$view->setResponseCode(Http::STATUS_CODE_NO_CONTENT)
						->setBody(__CLASS__ . ' ' . __METHOD__);
	}

	public function postAction()
	{
		$view = $this->getView();
		$view->setResponseCode(Http::STATUS_CODE_CREATED)
						->setBody(__CLASS__ . ' ' . __METHOD__);
	}

	public function putAction()
	{
		$view = $this->getView();
		$view->setResponseCode(Http::STATUS_CODE_CREATED)
						->setBody(__CLASS__ . ' ' . __METHOD__);
	}

}
