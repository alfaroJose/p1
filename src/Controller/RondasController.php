<?php
namespace App\Controller;

use App\Controller\AppController;

/**
 * Rondas Controller
 *
 * @property \App\Model\Table\RondasTable $Rondas
 *
 * @method \App\Model\Entity\Ronda[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class RondasController extends AppController
{

    /**
     * Index method
     *
     * @return \Cake\Http\Response|void
     */
    public function index()
    {
        $rondas = $this->paginate($this->Rondas);

        $this->set(compact('rondas'));
    }

    /**
     * View method
     *
     * @param string|null $id Ronda id.
     * @return \Cake\Http\Response|void
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $ronda = $this->Rondas->get($id, [
            'contain' => []
        ]);

        $this->set('ronda', $ronda);
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $ronda = $this->Rondas->newEntity();
        if ($this->request->is('post')) {
            $ronda = $this->Rondas->patchEntity($ronda, $this->request->getData());
            if ($this->Rondas->save($ronda)) {
                $this->Flash->success(__('The ronda has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The ronda could not be saved. Please, try again.'));
        }
        $this->set(compact('ronda'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Ronda id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $ronda = $this->Rondas->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $ronda = $this->Rondas->patchEntity($ronda, $this->request->getData());
            if ($this->Rondas->save($ronda)) {
                $this->Flash->success(__('The ronda has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The ronda could not be saved. Please, try again.'));
        }
        $this->set(compact('ronda'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Ronda id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $ronda = $this->Rondas->get($id);
        if ($this->Rondas->delete($ronda)) {
            $this->Flash->success(__('The ronda has been deleted.'));
        } else {
            $this->Flash->error(__('The ronda could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
