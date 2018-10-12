<?php
namespace Cake\Core\Configure;
namespace App\Controller;

use App\Controller\AppController;

/**
 * Inicio Controller
 *
 * @property \App\Model\Table\InicioTable $Inicio
 *
 * @method \App\Model\Entity\Inicio[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class InicioController extends AppController
{
    private function esEstudiante($usuario){
        if( 6 == strlen($usuario)){
          return true; 
        }
        else{
            return false;
        }
    }

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

    public function getId(){return $_SESSION['id'];}

    public function login(){
        
        $this->layout = 'inicio';

        $usuario = $this->request->getData('Usuario');
        $pass = $this->request->getData('Contraseña');  

        if($usuario != null && $pass != null){
           if($this->entrar($usuario,$pass)){

                $_SESSION['id'] = $usuario;
                if($this->esEstudiante($usuario)){

                }
                else{

                }
                return $this->redirect(['controller' => 'Main','action' => 'index']);
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
}