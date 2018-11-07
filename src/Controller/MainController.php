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
		$carne = $this->getRequest()->getSession()->read('id'); 
        if($carne == null){
			return $this->redirect(['controller' => 'Inicio','action' => 'fail']);
		}
		date_default_timezone_set("America/Costa_Rica");//Se pone el huso horario de Costa Rica
		$nombreUsuario = $this->getRequest()->getSession()->read('id');//Toma de la sesion el identificador de ingreso al sistema (nombre_usuario en la tabla usuarios)
		$usuarios = TableRegistry::getTableLocator()->get('usuarios');//Pide la tabla usuario

		//$nombre = $usuarios->find()->select(['nombre', 'id'])->where(['nombre_usuario' => $carne])->toList();

		$datos = $usuarios->find()
		->select(['nombre', 'roles.tipo'])
		->join([
			'table' => 'roles',
			'conditions' => 'roles.id = roles_id',
		])
		->where(['nombre_usuario' => $nombreUsuario])
		->toList();//Realiza la consulta para tomar el nombre y el tipo de rol que tiene

		//Envia las variables $nombre y $tipoRol con base a la consulta
		$this->set('nombre', $datos[0]->nombre);
		$this->set('tipoRol', $datos[0]->roles['tipo']);

		//Se toma la fecha y la hora actuales
		$today = Date::today();
		$time = date("h:ia");
		$this->set('today', $today);
		$this->set('time', $time);
	}
}
