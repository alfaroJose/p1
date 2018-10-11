<?php
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
                    return $this->redirect(['controller' => 'Main','action' => 'index']);
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
}