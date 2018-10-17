<?php
namespace App\Controller;

use App\Controller\AppController;

/**
 * Posee Controller
 *
 * @property \App\Model\Table\PoseeTable $Posee
 *
 * @method \App\Model\Entity\Posee[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class PoseeController extends AppController
{

    /**
     * Index method
     *
     * @return \Cake\Http\Response|void
     */
    public function index()
    {
        $posee = $this->paginate($this->Posee);
        $opciones = array("1" => "Administrador","2" => "Asistente Administrativo", "3" => "Profesor", "4" => "Estudiante");//Usado para el selection

        $this->set(compact('posee'));
        $this->set('opciones', $opciones);

        $datos = $this->request->data;
        if(count){

        }
    }

    /**
     * View method
     *
     * @param string|null $id Posee id.
     * @return \Cake\Http\Response|void
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $posee = $this->Posee->get($id, [
            'contain' => ['Roles']
        ]);

        $this->set('posee', $posee);
    }

    /**
     * Edit method
     *
     * @param string|null $id Posee id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $posee = $this->Posee->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $posee = $this->Posee->patchEntity($posee, $this->request->getData());
            if ($this->Posee->save($posee)) {
                $this->Flash->success(__('The posee has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The posee could not be saved. Please, try again.'));
        }
        $roles = $this->Posee->Roles->find('list', ['limit' => 200]);
        $this->set(compact('posee', 'roles'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Posee id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $posee = $this->Posee->get($id);
        if ($this->Posee->delete($posee)) {
            $this->Flash->success(__('The posee has been deleted.'));
        } else {
            $this->Flash->error(__('The posee could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
