<?php
namespace App\Model\Table;
use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;
use Cake\ORM\TableRegistry;
use Cake\Datasource\ConnectionManager;

class SeguridadTable extends Table
{

    public function initialize(array $config)
    {
        parent::initialize($config);
        $this->setTable('seguridad');

    }

    //Devuelve el rol del usuario logeado
    public function getRol($carne){
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

     //Verifica por permisos y login
    public function getPermiso($carne,$id){
       
       // $carne = $this->request->getSession()->read('id'); 
        if($carne != null){
           $connect = ConnectionManager::get('default');
           $consulta = "select roles_id from usuarios where nombre_usuario = '".$carne."';";
           $rol =  $connect->execute($consulta)->fetchAll(); //Devuelve el rol del usuario en cuestión
           
           $consulta = "select pos.estado
                       from posee as pos join permisos as per on pos.permisos_id =  per.id
                        where per.id =".$id." and roles_id = ".$rol[0][0].";";
                        
           $tupla =  $connect->execute($consulta)->fetchAll();      

           return $tupla[0][0];

        }
        else{
            return 0;
        }
   }

   //Devuelve el id de la persona logeada
   public function getId($carne){
    
     if($carne != null){
        $connect = ConnectionManager::get('default');
        $consulta = "select id from usuarios where nombre_usuario = '".$carne."';";
        $rol =  $connect->execute($consulta)->fetchAll(); //Devuelve el rol del usuario en cuestión
        return $rol[0][0];
     }
     else{
         return 0;
     }

}


}