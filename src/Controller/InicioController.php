<?php
namespace Cake\Core\Configure;
namespace App\Controller;

use App\Controller\AppController;
use Cake\ORM\TableRegistry;

//$users = TableRegistry::get('Usuarios');

/**
 * Inicio Controller
 *
 * @property \App\Model\Table\InicioTable $Inicio
 *
 * @method \App\Model\Entity\Inicio[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class InicioController extends AppController
{

    private function entrar($usuario, $pass){
         // conexión al servidor LDAP
         $ldapconn = ldap_connect("10.1.4.78")
         or die("No se ha podido conectar a la red ECCI");

        if ($ldapconn) {
            // realizando la autenticación
            $ldaprdn = $usuario.'@ecci.ucr.ac.cr';
            $ldappass = $pass;
            $pass = '';
            $ldapbind = @ldap_bind($ldapconn,$ldaprdn, $ldappass);

            // verificación del enlace
            if ($ldapbind) {
                ldap_close($ldapconn);
                return true;
                
            } else {
                ldap_close($ldapconn);
                return false;   
            }
        }
    }
    
    public function login(){
        
        $this->layout = 'inicio';

        $usuario = $this->request->getData('Usuario');
        $pass = $this->request->getData('Contraseña');  

        if($usuario != null && $pass != null){

           if ($this->entrar($usuario,$pass)){

                //Guardamos el id del usuario en la sesion
                $name = $this->getRequest()->getSession()->write('id',$usuario);
                //Para sacarlos es $this->getRequest()->getSession()->read('id');

                //aquí se verifica si el usuario existe en la tabla o no para mandarlo a la vista principal o de añadir sus datos personales
                $users = TableRegistry::get('Usuarios');
                $index = $users->find()
                ->select(['id'])
                ->where(['id =' => $usuario])
                ->toList();

                if ($index != null){ //Usuario ya ha ingresado antes
                    return $this->redirect(['controller' => 'Main','action' => 'index']);    
                } 
                else { //Usuario no existe en la tabla, por lo que debe ser registrado

                    $pos = strpos($usuario, '.');
                    if ($pos === false){ //El usuario es un estudiante, puesto que el username no tiene el caracter punto
                        return $this->redirect(['controller' => 'Usuarios','action' => 'addEstudiante']);    

                    } else {
                        return $this->redirect(['controller' => 'Usuarios','action' => 'addProfesor']);    
                    }

                }
            }
            else{
                    $this->Flash->error(__('Credenciales incorrectos, vuelva a intentarlo'));

            }
                   
        }
        
    }


    public function inicio(){
        $this->layout = 'inicio';
    }


    public function contrasena(){
        $this->layout = 'inicio';
    }


    public function getIndexValues(){
        global $nombreusuario;
         $index = $users->find()
        ->select(['id'])
        ->where(['id ==' => 'B54548'])
        ->toList();
        return $index;
        /*debug($index);
        die();*/
     }
}