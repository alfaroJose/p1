<?php
namespace App\View\Helper;

use Cake\View\Helper;
use Cake\View\View;
use App\Model\Table\SolicitudesTable;


/**
 * Solicitude helper
 */
class SolicitudeHelper extends Helper
{

    /**
     * Default configuration.
     *
     * @var array
     */
    protected $_defaultConfig = [];

    public function getStudentInfo($carne){
    	$fila = (new SolicitudesTable)->getStudentInfo($carne);
    	return $fila;
    }

}
