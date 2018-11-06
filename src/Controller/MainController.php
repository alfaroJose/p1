<?php
namespace App\Controller;

use App\Controller\AppController;
use Cake\ORM\TableRegistry;
use Cake\Datasource\ConnectionManager;
use Cake\Chronos\Date;
use Cake\I18n\Time;

/**
 * Main Controller
 *
 */
class MainController extends AppController
{
	public function index()
	{
		date_default_timezone_set("America/Costa_Rica");
		$carne = $this->getRequest()->getSession()->read('id');
		$usuarios = TableRegistry::getTableLocator()->get('usuarios');
		$nombre = $usuarios->find()->select('nombre')->where(['nombre_usuario' => $carne])->toList();
		$this->set('nombre', $nombre[0]->nombre);
		$today = Date::today();
		$time = date("h:ia");
		$this->set('today', $today);
		$this->set('time', $time);
	}
}
