<?php
namespace App\View\Helper;

use Cake\View\Helper;
use Cake\View\View;
use App\Model\Table\SolicitudesTable;
use App\Model\Table\UsuariosTable;


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

    /*public function getGrupos($id_estudiante, $semestre, $year){
        $fila = (new SolicitudesTable)->getGrupos($id_estudiante, $semestre, $year);
        return $fila;
    }*/

    /*public function getIDEstudiante($carne){
        $fila = (new SolicitudesTable)->getIDEstudiante($carne);
        return $fila;
    }*/


    public function getIndexValuesEstudiante($id){
        $fila = (new SolicitudesTable)->getIndexValuesEstudiante($id);
        return [$fila];
    }

}
