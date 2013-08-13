<?php

namespace App\Controller;

use Ahs\ControllerRestAbstract;
use Ahs\Http;
use Ahs\Route;
use App\Model\CampusMapper;

class CampusesControllerRest extends ControllerRestAbstract
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
		$campusMapper = new CampusMapper();
		$campuses = $campusMapper->readAll();

		$view = $this->getView();

		if (empty($campuses)) {
			$view->setResponseCode(Http::STATUS_CODE_NO_CONTENT);
		} else {
			foreach ($campuses as $key => $campus) {
				$campuses[$key] = $campus->toArray();
			}
			$view->setResponseCode(Http::STATUS_CODE_OK)
							->setContentType(Http::CONTENT_TYPE_JSON)
							->setBody($campuses);
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
