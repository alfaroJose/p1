<?php
namespace App\View\Helper;

use Cake\View\Helper;
use Cake\View\View;
use App\Model\Table\GruposTable;
/**
 * Grupos helper
 */
class GruposHelper extends Helper
{

    /**
     * Default configuration.
     *
     * @var array
     */
    protected $_defaultConfig = [];

    public function obtenerCursos($id = null){
        $sigla = (new GruposTable)->obtenerCursos($id = null);
        return $sigla[0];
    }
}
