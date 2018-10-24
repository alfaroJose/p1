<?php
namespace App\Controller;

use App\Controller\AppController;



/**
 * Usuarios Controller
 *
 * @property \App\Model\Table\UsuariosTable $Usuarios
 *
 * @method \App\Model\Entity\Usuario[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class UsuariosController extends AppController
{

    private function test(){
        $usuario = $this->getRequest()->getSession()-read('id');

        if (null == $usuario){

        }



    }
    /**
     * Index method
     *
     * @return \Cake\Http\Response|void
     */
    public function index()
    {
        $this->paginate = [
            'contain' => ['Roles']
        ];
        $usuarios = $this->paginate($this->Usuarios);

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

        $this->set('usuario', $usuario);
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
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
        $usuario = $this->Usuarios->newEntity();
        if ($this->request->is('post')) {
            $usuario = $this->Usuarios->patchEntity($usuario, $this->request->getData());           
            $usuario->roles_id = '4';
            if ($this->Usuarios->save($usuario)) {
                $this->Flash->success(__('El usuario ha sido agregado.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('El usuario no se ha podido agregar. Por favor intente de nuevo.'));
        }
        $roles = $this->Usuarios->Roles->find('list', ['limit' => 200]);
        $this->set(compact('usuario', 'roles'));
    }

    /*Función para agregar un usuario cuando la vista pertenece al profesor*/
    public function addProfesor()
    {
        $usuario = $this->Usuarios->newEntity();
        if ($this->request->is('post')) {
            $usuario = $this->Usuarios->patchEntity($usuario, $this->request->getData());           
            $usuario->roles_id = '3';
            if ($this->Usuarios->save($usuario)) {
                $this->Flash->success(__('El usuario ha sido agregado.'));

                return $this->redirect(['action' => 'index']);
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
        if ($this->request->is(['patch', 'post', 'put'])) {
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

            if ($this->Usuarios->save($usuario)) {
                $this->Flash->success(__('El usuario ha sido modificado.'));

                return $this->redirect(['action' => 'index']);
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
            $this->Flash->success(__('El usuario no se ha podido eliminar. Por favor intente de nuevo.'));
        }
        return $this->redirect(['action' => 'index']);
    }


    public function getUsuario()
    {
        $username = $this->getRequest()->getSession()->read('id');
        return $username;
    }

    public function getRol($id = null)
    {
        $rol = $this->find()
        ->select(['roles_id'])
        ->where(['id =' => $id])
         ->toList();
        return $rol;
    }
}
