<?php
namespace Cake\Core\Configure;
namespace App\View\Helper;


use Cake\View\Helper;
use Cake\View\View;

//Estos dos sirven para las consultas
use Cake\ORM\TableRegistry;
use Cake\Datasource\ConnectionManager;

/**
 * Seguridad helper
 */
class SeguridadHelper extends Helper
{

    /**
     * Default configuration.
     *
     * @var array
     */
    protected $_defaultConfig = [];

    public function getRol(){
        $carne = $this->request->getSession()->read('id');
         if($carne != null){
            $connect = ConnectionManager::get('default');
            $consulta = "select roles_id from usuarios where nombre_usuario = '".$carne."';";
            $rol =  $connect->execute($consulta)->fetchAll(); //Devuelve el rol del usuario en cuestión
            return $rol[0][0];
         }
         else{
             return 0;
         }

    }
    public function getPermiso($id){
         //Verifica por permisos y login
         $carne = $this->request->getSession()->read('id'); 
         if($carne != null){
            $connect = ConnectionManager::get('default');
            $consulta = "select roles_id from usuarios where nombre_usuario = '".$carne."';";
            $rol =  $connect->execute($consulta)->fetchAll(); //Devuelve el rol del usuario en cuestión
            
            $consulta = "select pos.estado
                        from posee as pos join permisos as per on pos.permisos_id =  per.id
                         where per.id =".$id." and roles_id = ".$rol[0][0].";";
                         
            $tupla =  $connect->execute($consulta)->fetchAll();      
//debug($consulta);
            //die();
            return $tupla[0][0];

         }
         else{
             return 0;
         }
         //Cierra la seguridad
    }
}
