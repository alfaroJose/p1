<?php
namespace App\View\Helper;

use Cake\View\Helper;
use Cake\View\View;
use App\Model\Table\RondasTable;
/**
 * Ronda helper
 */
class RondaHelper extends Helper
{

    /**
     * Default configuration.
     *
     * @var array
     */
    protected $_defaultConfig = [];

    public function getFila(){
    	$fila = (new RondasTable)->getFila();
    	return ["Ronda # " . $fila[0], ", Fecha Inicio: " . $fila[1], ", Fecha Fin: " . $fila[2]];
    }

}
