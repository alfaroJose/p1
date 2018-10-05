<?php
namespace App\Controller;

use App\Controller\AppController;

/**
 * Requisitos Controller
 *
 * @property \App\Model\Table\RequisitosTable $Requisitos
 *
 * @method \App\Model\Entity\Requisito[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class RequisitosController extends AppController
{

    /**
     * Index method
     *
     * @return \Cake\Http\Response|void
     */
    public function index()
    {
        $requisitos = $this->paginate($this->Requisitos);

        $this->set(compact('requisitos'));
    }

    /**
     * View method
     *
     * @param string|null $id Requisito id.
     * @return \Cake\Http\Response|void
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $requisito = $this->Requisitos->get($id, [
            'contain' => []
        ]);

        $this->set('requisito', $requisito);
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $requisito = $this->Requisitos->newEntity();
        if ($this->request->is('post')) {
            $requisito = $this->Requisitos->patchEntity($requisito, $this->request->getData());
            if ($this->Requisitos->save($requisito)) {
                $this->Flash->success(__('The requisito has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The requisito could not be saved. Please, try again.'));
        }
        $this->set(compact('requisito'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Requisito id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $requisito = $this->Requisitos->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $requisito = $this->Requisitos->patchEntity($requisito, $this->request->getData());
            if ($this->Requisitos->save($requisito)) {
                $this->Flash->success(__('The requisito has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The requisito could not be saved. Please, try again.'));
        }
        $this->set(compact('requisito'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Requisito id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $requisito = $this->Requisitos->get($id);
        if ($this->Requisitos->delete($requisito)) {
            $this->Flash->success(__('The requisito has been deleted.'));
        } else {
            $this->Flash->error(__('The requisito could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}