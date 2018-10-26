<?php
namespace App\View\Helper;

use Cake\View\Helper;
use Cake\View\View;
use App\Model\Table\GruposTable;
/**
 * Usuarios helper
 */
class UsuariosHelper extends Helper
{

    /**
     * Default configuration.
     *
     * @var array
     */
    protected $_defaultConfig = [];

    public function obtenerProfesor($id = null){
        $profesor = (new GruposTable)->obtenerCursos($id = null);
        return $profesor;
    }

}
