<?php
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

    public function login(){
        
        $this->layout = 'inicio';

        $usuario = $this->request->getData('Usuario');
        $pass = $this->request->getData('Contraseña');  

        if($usuario != null && $pass != null){
           
            // conexión al servidor LDAP
            $ldapconn = ldap_connect("10.1.4.78")
                or die("Could not connect to LDAP server.");

            if ($ldapconn) {
                // realizando la autenticación
                $ldaprdn = $usuario.'@ecci.ucr.ac.cr';
                $ldappass = $pass;
                $pass = '';
                $ldapbind = @ldap_bind($ldapconn,$ldaprdn, $ldappass);

                // verificación del enlace
                if ($ldapbind) {
                    //return $this->redirect(['controller' => 'Main','action' => 'index']);
                    $users = TableRegistry::get('Usuarios');
                    $index = $users->find()
                    ->select(['id'])
                    ->where(['id =' => $usuario])
                    ->toList();
                    if ($index != null){ //Usuario ya ha ingresado antes
                        return $this->redirect(['controller' => 'Main','action' => 'index']);    
                    } else { //Usuario no existe en la tabla, por lo que debe ser registrado

                        $pos = strpos($usuario, '.');
                        if ($pos === false){ //El usuario es un estudiante, puesto que el username no tiene el caracter punto
                            return $this->redirect(['controller' => 'Usuarios','action' => 'addEstudiante']);    

                        } else {
                            return $this->redirect(['controller' => 'Usuarios','action' => 'addProfesor']);    
                        }

                    }
                } else { 
                    
                    //debug('hliwis');
                   $this->Flash->error(__('Credenciales incorrectos, vuelva a intentarlo'));
                }
                ldap_close($ldapconn);
                
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