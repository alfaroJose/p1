<?php
namespace App\Controller;

use App\Controller\AppController;
use Dompdf\Dompdf;
use Cake\Datasource\ConnectionManager;

/**
 * Solicitudes Controller
 *
 * @property \App\Model\Table\SolicitudesTable $Solicitudes
 *
 * @method \App\Model\Entity\Solicitude[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class SolicitudesController extends AppController
{
    /**
     * Index method
     *
     * @return \Cake\Http\Response|void
     */
    public function index()
    {
        $todo = $this->Solicitudes->getIndexValues();
        $this->paginate = [
            'contain' => ['Usuarios', 'Grupos']
        ];
        $solicitudes = $this->paginate($this->Solicitudes);
        $this->set(compact('solicitudes','todo'));
    }

        /**
     * Index method
     *
     * @return \Cake\Http\Response|void
     */
    public function indexestudiante()
    {
        $username = $this->request->getSession()->read('id');
        $idActual = $this->Solicitudes->getIDEstudiante($username);   
        //debug($idActual[0][0]);
        //die();          
        $todo = $this->Solicitudes->getIndexValuesEstudiante($idActual[0][0]);
        //debug($todo);
        //die();
        $this->paginate = [
            'contain' => ['Usuarios', 'Grupos']
        ];
        $solicitudes = $this->paginate($this->Solicitudes);
        $this->set(compact('solicitudes','todo'));
    }

    /**
     * View method
     *
     * @param string|null $id Solicitude id.
     * @return \Cake\Http\Response|void
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $solicitude = $this->Solicitudes->get($id, [
            'contain' => ['Usuarios', 'Grupos']
        ]);

        $this->set('solicitude', $solicitude);
    }

    public function imprimir($id = null){
        $tupla = $this->Solicitudes->get($id);
        $this->layout='none';
        $solicitude = $this->Solicitudes->get($id, [
            'contain' => ['Usuarios', 'Grupos']
        ]);
        $this->set('tupla', $tupla);
        $this->set('solicitude', $solicitude);
    }

        /**
     * View method
     *
     * @param string|null $id Solicitude id.
     * @return \Cake\Http\Response|void
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function viewestudiante($id = null)
    {
        $solicitude = $this->Solicitudes->get($id, [
            'contain' => ['Usuarios', 'Grupos']
        ]);

        $this->set('solicitude', $solicitude);
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $solicitude = $this->Solicitudes->newEntity();
        if ($this->request->is('post')) {
            $solicitude = $this->Solicitudes->patchEntity($solicitude, $this->request->getData());
            if ($this->Solicitudes->save($solicitude)) {
                $this->Flash->success(__('La solicitud ha sido agregada.'));
                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('La solicitud no se ha podido agregar. Por favor intente de nuevo.'));
        }
        $usuarios = $this->Solicitudes->Usuarios->find('list', ['limit' => 200]);
        $grupos = $this->Solicitudes->Grupos->find('list', ['limit' => 200]);
        $this->set(compact('solicitude', 'usuarios', 'grupos'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Solicitude id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $solicitude = $this->Solicitudes->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $solicitude = $this->Solicitudes->patchEntity($solicitude, $this->request->getData());
            if ($this->Solicitudes->save($solicitude)) {
                $this->Flash->success(__('La solicitud ha sido modificado.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('La solicitud no se ha podido modificar. Por favor intente de nuevo.'));
        }
        $usuarios = $this->Solicitudes->Usuarios->find('list', ['limit' => 200]);
        $grupos = $this->Solicitudes->Grupos->find('list', ['limit' => 200]);
        $this->set(compact('solicitude', 'usuarios', 'grupos'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Solicitude id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $solicitude = $this->Solicitudes->get($id);
        if ($this->Solicitudes->delete($solicitude)) {
            $this->Flash->success(__('La solicitud ha sido eliminada.'));
        } else {
            $this->Flash->error(__('La solicitud no se ha podido eliminar. Por favor intente de nuevo.'));
        }

        return $this->redirect(['action' => 'index']);
    }

    public function viewFile($filename) {
        $this->viewBuilder()
            ->className('Dompdf.Pdf')
            ->layout('Dompdf.default')
            ->options(['config' => [
                'filename' => $filename,
                'render' => 'browser',
            ]]);
    }
}