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
    	return ["HA: " . $fila[1], "HE ECCI: " . $fila[2], "HE Docente: " . $fila[3]];
    }
}
