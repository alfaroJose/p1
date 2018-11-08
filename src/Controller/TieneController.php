<?php
namespace App\Controller;

use App\Controller\AppController;

/**
 * Tiene Controller
 *
 * @property \App\Model\Table\TieneTable $Tiene
 *
 * @method \App\Model\Entity\Tiene[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class TieneController extends AppController
{

    /**
     * Index method
     *
     * @return \Cake\Http\Response|void
     */
    public function index()
    {
        $this->paginate = [
            'contain' => ['Solicitudes', 'Requisitos']
        ];
        $tiene = $this->paginate($this->Tiene);

        $this->set(compact('tiene'));
    }

    /**
     * View method
     *
     * @param string|null $id Tiene id.
     * @return \Cake\Http\Response|void
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $tiene = $this->Tiene->get($id, [
            'contain' => ['Solicitudes', 'Requisitos']
        ]);

        $this->set('tiene', $tiene);
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $tiene = $this->Tiene->newEntity();
        if ($this->request->is('post')) {
            $tiene = $this->Tiene->patchEntity($tiene, $this->request->getData());
            if ($this->Tiene->save($tiene)) {
                $this->Flash->success(__('The tiene has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The tiene could not be saved. Please, try again.'));
        }
        $solicitudes = $this->Tiene->Solicitudes->find('list', ['limit' => 200]);
        $requisitos = $this->Tiene->Requisitos->find('list', ['limit' => 200]);
        $this->set(compact('tiene', 'solicitudes', 'requisitos'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Tiene id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $tiene = $this->Tiene->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $tiene = $this->Tiene->patchEntity($tiene, $this->request->getData());
            if ($this->Tiene->save($tiene)) {
                $this->Flash->success(__('The tiene has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The tiene could not be saved. Please, try again.'));
        }
        $solicitudes = $this->Tiene->Solicitudes->find('list', ['limit' => 200]);
        $requisitos = $this->Tiene->Requisitos->find('list', ['limit' => 200]);
        $this->set(compact('tiene', 'solicitudes', 'requisitos'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Tiene id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $tiene = $this->Tiene->get($id);
        if ($this->Tiene->delete($tiene)) {
            $this->Flash->success(__('The tiene has been deleted.'));
        } else {
            $this->Flash->error(__('The tiene could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
