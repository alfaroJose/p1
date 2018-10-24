<?php
namespace Cake\Core\Configure;
namespace App\Controller;

use App\Controller\AppController;
use Cake\ORM\TableRegistry;

/**
 * Inicio Controller
 *
 * @property \App\Model\Table\InicioTable $Inicio
 *
 * @method \App\Model\Entity\Inicio[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class InicioController extends AppController
{

    //Función que se encarga de hacer la autenticación con la base de datos de la ECCI
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
    
    //Pantalla del Login
    //Esta función se encarga de recopilar los datos del login para ser verificados
    //Luego identifica el tipo de usuario que ingresó y 
    //Finalmente lo ingresa a la aplicación ya sea la primera vez en entrar o si ya tenía una cuenta asociada
    public function login(){
        $this->layout = 'inicio';

        //En caso de que la Sessión siga abierta
        if ($this->getRequest()->getSession()->read('id') != ''){
            return $this->redirect(['controller' => 'Main','action' => 'index']);
            //DEVOLVER AL INICIO DE CADA USUARIO
        }
        

        $usuario = $this->request->getData('Usuario');
        $pass = $this->request->getData('Contraseña');  
    
       // $this->getRequest()->getSession()->write('id','');
        if($usuario != null && $pass != null){

           if ($this->entrar($usuario,$pass)){//Credenciales válidos

                //Todos los nombre_usuario se guardan en minúscula
                $usuario = strtolower($usuario);
              
                //Guardamos el id del usuario en la sesion
                $name = $this->getRequest()->getSession()->write('id',$usuario);
                //Para sacarlos es $this->getRequest()->getSession()->read('id');

                //aquí se verifica si el usuario existe en la tabla o no para mandarlo a la vista principal o de añadir sus datos personales
                $users = TableRegistry::get('Usuarios');
                $index = $users->find()
                ->select(['id'])
                ->where(['nombre_usuario =' => $usuario])
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

    //Carga la pantalla de inicio
    public function inicio(){
        $this->layout = 'inicio';
    }

    //Carga la pantalla de recuperación de contraseña
    public function contrasena(){
        $this->layout = 'inicio';
    }

    //Carga la vista de falta de permisos para una funcionalidad
    public function fail(){
        $this->layout = 'inicio';
    }

    //Carga la vista de sesión cerrada
    public function logout(){
        $this->layout = 'inicio';
    }

}