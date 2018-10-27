<?php
namespace App\View\Helper;

use Cake\View\Helper;
use Cake\View\View;
use App\Model\Table\UsuariosTable;

/**
 * Usuario helper
 */
class UsuarioHelper extends Helper
{

    /**
     * Default configuration.
     *
     * @var array
     */
    protected $_defaultConfig = [];

    public function getUser($carne){
    	$fila = (new UsuariosTable)->getUser($carne);
    	return [$fila[0]];
    }

    public function getRol($carne){
        $fila = (new UsuariosTable)->getRol($carne);
        return [$fila[0]];
    }

    // Devuelva el rol del usuario según el carné
    public function getTipoCedula($carne){
        $fila = (new UsuariosTable)->getTipoCedula($carne);
        return [$fila[0]];
    }

}
