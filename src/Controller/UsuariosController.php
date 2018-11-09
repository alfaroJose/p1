<?php
namespace App\Controller;

use App\Controller\AppController;

//Estos dos sirven para las consultas
use Cake\ORM\TableRegistry;
use Cake\Datasource\ConnectionManager;

/**
 * Usuarios Controller
 *
 * @property \App\Model\Table\UsuariosTable $Usuarios
 *
 * @method \App\Model\Entity\Usuario[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class UsuariosController extends AppController
{

    /**
     * Index method
     *
     * @return \Cake\Http\Response|void
     */
    public function index()
    {
        //Verifica por permisos y login
        $carne = $this->getRequest()->getSession()->read('id'); 
        if($carne != null){
           $connect = ConnectionManager::get('default');
           $consulta = "select roles_id from usuarios where nombre_usuario = '".$carne."';";
           $rol =  $connect->execute($consulta)->fetchAll(); //Devuelve el rol del usuario en cuestión
          
           $consulta = "select pos.estado
                       from posee as pos join permisos as per on pos.permisos_id =  per.id
                        where per.id = 17 and roles_id = ".$rol[0][0].";";
                        //17 = Consultar Usuario
           $tupla =  $connect->execute($consulta)->fetchAll();      

            if($tupla[0][0] != '1'){//1 = Tiene permisos para consultar usuarios
               $this->redirect(['controller' => 'Inicio','action' => 'fail']);
            }
        }
        else{
            $this->redirect(['controller' => 'Inicio','action' => 'fail']);
        }
        //Cierra la seguridad

        /*Saca la cantidad de tuplas de la tabla Usuarios*/
        $cantidad = $this->Usuarios->getCountUsers();

        $this->paginate = [
            'contain' => ['Roles']
        ];
        /*Esto es por que la función paginate tiene un default de límite de records*/
        $this->paginate['maxLimit'] = $cantidad[0];
        $this->paginate['limit']    = $cantidad[0];

        $usuarios = $this->paginate($this->Usuarios);
        //debug($usuarios);
        //die();

        $this->set(compact('usuarios'));
    }

    /**
     * View method
     *
     * @param string|null $id Usuario id.
     * @return \Cake\Http\Response|void
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $usuario = $this->Usuarios->get($id, [
            'contain' => ['Roles']
        ]);

        //Inicia seguridad
        $carne = $this->getRequest()->getSession()->read('id'); 
        
        //Puedo ser un usuario con permisos y quiero ver el ususario
        if($carne != ''){
            $connect = ConnectionManager::get('default');
            $consulta = "select roles_id from usuarios where nombre_usuario = '".$carne."';";
            $rol =  $connect->execute($consulta)->fetchAll(); //Devuelve el rol del usuario en cuestión
            
            $consulta = "select pos.estado
                        from posee as pos join permisos as per on pos.permisos_id =  per.id
                            where per.id = 17 and roles_id = ".$rol[0][0].";";
                            //17 = Consultar Usuario
            $tupla =  $connect->execute($consulta)->fetchAll();      

                if($tupla[0][0] != '1' && $carne != $usuario->nombre_usuario){//1 = Tiene permisos para consultar usuarios
                                        //Soy el mismo usuario que quiero ver
                $this->redirect(['controller' => 'Inicio','action' => 'fail']);
                }
        }
        else{
            $this->redirect(['controller' => 'Inicio','action' => 'fail']);
        }
        //Cierra la seguridad

        $this->set('usuario', $usuario);
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
         //Verifica por permisos y login
         $carne = $this->getRequest()->getSession()->read('id'); 
         if($carne != null){
            $connect = ConnectionManager::get('default');
            $consulta = "select roles_id from usuarios where nombre_usuario = '".$carne."';";
            $rol =  $connect->execute($consulta)->fetchAll(); //Devuelve el rol del usuario en cuestión
           
            $consulta = "select pos.estado
                        from posee as pos join permisos as per on pos.permisos_id =  per.id
                         where per.id = 19 and roles_id = ".$rol[0][0].";";
                         //19 = Insertar Usuario
            $tupla =  $connect->execute($consulta)->fetchAll();      
 
             if($tupla[0][0] != '1'){//1 = Tiene permisos para consultar usuarios
                $this->redirect(['controller' => 'Inicio','action' => 'fail']);
             }
         }
         else{
            
             $this->redirect(['controller' => 'Inicio','action' => 'fail']);
 
         }
         //Cierra la seguridad

        $usuario = $this->Usuarios->newEntity();
        if ($this->request->is('post')) {
            $usuario = $this->Usuarios->patchEntity($usuario, $this->request->getData());
            if ($usuario->roles_id == 0) {
                $usuario->roles_id = '1';
            } else if ($usuario->roles_id == 1){
                $usuario->roles_id = '2';
            } else if ($usuario->roles_id == 2){
                $usuario->roles_id = '3';
            } else {
                $usuario->roles_id = '4';
            }

            if ($usuario->tipo_identificacion == 0) {
                $usuario->tipo_identificacion = 'Cédula Nacional';
            } else if ($usuario->tipo_identificacion == 1){
                $usuario->tipo_identificacion = 'Cédula Extranjera';
            } else if ($usuario->tipo_identificacion == 2){
                $usuario->tipo_identificacion = 'DIMEX';
            } else {
                $usuario->tipo_identificacion = 'Pasaporte';
            }

            if ($this->Usuarios->save($usuario)) {
                $this->Flash->success(__('El usuario ha sido agregado.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('El usuario no se ha podido agregar. Por favor intente de nuevo.'));
        }
        $roles = $this->Usuarios->Roles->find('list', ['limit' => 200]);
        $this->set(compact('usuario', 'roles'));
    }

    /*Función para agregar un usuario cuando la vista pertenece al estudiante*/
    public function addEstudiante()
    {
        $this->layout = "inicio";
        $usuario = $this->Usuarios->newEntity();
        if ($this->request->is('post')) {
            $usuario = $this->Usuarios->patchEntity($usuario, $this->request->getData());           
            $usuario->roles_id = '4';

            if ($usuario->tipo_identificacion == 0) {
                $usuario->tipo_identificacion = 'Cédula Nacional';
            } else if ($usuario->tipo_identificacion == 1){
                $usuario->tipo_identificacion = 'Cédula Extranjera';
            } else if ($usuario->tipo_identificacion == 2){
                $usuario->tipo_identificacion = 'DIMEX';
            } else {
                $usuario->tipo_identificacion = 'Pasaporte';
            }

            if ($this->Usuarios->save($usuario)) {
                $this->Flash->success(__('El usuario ha sido agregado.'));

                return $this->redirect(['controller'=>'Main', 'action'=>'index']);
            }
            $this->Flash->error(__('El usuario no se ha podido agregar. Por favor intente de nuevo.'));
        }
        $roles = $this->Usuarios->Roles->find('list', ['limit' => 200]);
        $this->set(compact('usuario', 'roles'));
    }

    /*Función para agregar un usuario cuando la vista pertenece al profesor*/
    public function addProfesor()
    {
        $this->layout = 'inicio';
        $usuario = $this->Usuarios->newEntity();
        if ($this->request->is('post')) {
            $usuario = $this->Usuarios->patchEntity($usuario, $this->request->getData());           
            $usuario->roles_id = '3';

            if ($usuario->tipo_identificacion == 0) {
                $usuario->tipo_identificacion = 'Cédula Nacional';
            } else if ($usuario->tipo_identificacion == 1){
                $usuario->tipo_identificacion = 'Cédula Extranjera';
            } else if ($usuario->tipo_identificacion == 2){
                $usuario->tipo_identificacion = 'DIMEX';
            } else {
                $usuario->tipo_identificacion = 'Pasaporte';
            }

            if ($this->Usuarios->save($usuario)) {
                $this->Flash->success(__('El usuario ha sido agregado.'));

                return $this->redirect(['controller'=>'Main', 'action'=>'index']);
            }
            $this->Flash->error(__('El usuario no se ha podido agregar. Por favor intente de nuevo.'));
        }
        $roles = $this->Usuarios->Roles->find('list', ['limit' => 200]);
        $this->set(compact('usuario', 'roles'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Usuario id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $usuario = $this->Usuarios->get($id, [
            'contain' => []
        ]);
       
        //Inicia seguridad
        $carne = $this->getRequest()->getSession()->read('id'); 

        if($carne != '' ){//Puedo ser un usuario con permisos
            $connect = ConnectionManager::get('default');
            $consulta = "select roles_id from usuarios where nombre_usuario = '".$carne."';";
            $rol =  $connect->execute($consulta)->fetchAll(); //Devuelve el rol del usuario en cuestión
           
            $consulta = "select pos.estado
                        from posee as pos join permisos as per on pos.permisos_id =  per.id
                         where per.id = 20 and roles_id = ".$rol[0][0].";";
                         //20 = Editar Usuario
            $tupla =  $connect->execute($consulta)->fetchAll();      
 
             if($tupla[0][0] != '1' && $carne != $usuario->nombre_usuario){//1 = Tiene permisos para consultar usuarios
                                    //Si soy el mismo usuario me puedo editar
                $this->redirect(['controller' => 'Inicio','action' => 'fail']);
             }

        }
        else{
            $this->redirect(['controller' => 'Inicio','action' => 'fail']);
        }
        //Cierra la seguridad



        if ($this->request->is(['patch', 'post', 'put'])) {
            $usuario = $this->Usuarios->patchEntity($usuario, $this->request->getData());
            if ($usuario->roles_id == 1) {
                $usuario->roles_id = '1';
            } else if ($usuario->roles_id == 2){
                $usuario->roles_id = '2';
            } else if ($usuario->roles_id == 3){
                $usuario->roles_id = '3';
            } else {
                $usuario->roles_id = '4';
            }

            if ($usuario->tipo_identificacion == 1) {
                $usuario->tipo_identificacion = 'Cédula Nacional';
            } else if ($usuario->tipo_identificacion == 2){
                $usuario->tipo_identificacion = 'Cédula Extranjera';
            } else if ($usuario->tipo_identificacion == 3){
                $usuario->tipo_identificacion = 'DIMEX';
            } else {
                $usuario->tipo_identificacion = 'Pasaporte';
            }

            if ($this->Usuarios->save($usuario)) {
                $this->Flash->success(__('El usuario ha sido modificado.'));

                return $this->redirect(['action' => 'edit', $usuario->id]);
            }
            $this->Flash->error(__('El usuario no se ha podido modificar. Por favor intente de nuevo.'));
        }
        $roles = $this->Usuarios->Roles->find('list', ['limit' => 200]);
        $this->set(compact('usuario', 'roles'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Usuario id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'get']);
        $usuario = $this->Usuarios->get($id);

        if ($this->Usuarios->delete($usuario)) {
            $this->Flash->success(__('El usuario ha sido eliminado.'));
        } else {
            $this->Flash->error(__('El usuario no se ha podido eliminar. Por favor intente de nuevo.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
