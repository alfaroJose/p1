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

    /**
     * Index method
     *
     * @return \Cake\Http\Response|void
     */
    public function index()
    {
        $inicio = $this->paginate($this->Inicio);

        $this->set(compact('inicio'));
    }

    /**
     * View method
     *
     * @param string|null $id Inicio id.
     * @return \Cake\Http\Response|void
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $inicio = $this->Inicio->get($id, [
            'contain' => []
        ]);

        $this->set('inicio', $inicio);
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $inicio = $this->Inicio->newEntity();
        if ($this->request->is('post')) {
            $inicio = $this->Inicio->patchEntity($inicio, $this->request->getData());
            if ($this->Inicio->save($inicio)) {
                $this->Flash->success(__('The inicio has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The inicio could not be saved. Please, try again.'));
        }
        $this->set(compact('inicio'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Inicio id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $inicio = $this->Inicio->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $inicio = $this->Inicio->patchEntity($inicio, $this->request->getData());
            if ($this->Inicio->save($inicio)) {
                $this->Flash->success(__('The inicio has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The inicio could not be saved. Please, try again.'));
        }
        $this->set(compact('inicio'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Inicio id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $inicio = $this->Inicio->get($id);
        if ($this->Inicio->delete($inicio)) {
            $this->Flash->success(__('The inicio has been deleted.'));
        } else {
            $this->Flash->error(__('The inicio could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }


    public function login(){
        
        //$this->Flash->error(__('Rellene todos los campos MAMADOR'));

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
        
    }
}
