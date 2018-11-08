<?php
namespace App\View\Helper;

use Cake\View\Helper;
use Cake\View\View;
use App\Model\Table\ContadorTable;

/**
 * Contador helper
 */
class ContadorHelper extends Helper
{

    /**
     * Default configuration.
     *
     * @var array
     */
    protected $_defaultConfig = [];

    public function getContador(){
    	$fila = (new ContadorTable)->getContador();
    	return ["Horas Asistente: " . $fila[1], "Horas Estudiante: " . $fila[2]];
    }
}
