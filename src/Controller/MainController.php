<?php
namespace App\Controller;

use App\Controller\AppController;

/**
 * Main Controller
 *
 */
class MainController extends AppController
{

	public function index()
	{
		debug($this->getRequest()->getSession()->read('id'));
		die();
	}
}
