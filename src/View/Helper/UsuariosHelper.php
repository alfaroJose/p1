<?php
namespace App\View\Helper;

use Cake\View\Helper;
use Cake\View\View;
use App\Model\Table\UsuariosTable;
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

    public function seleccionarProfesoresCorreos(){
        $profesor = (new GruposTable)->seleccionarProfesoresCorreos();
        return $profesor;
    }

}
