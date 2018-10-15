<?php
namespace App\Controller;

use App\Controller\AppController;

/**
 * Grupos Controller
 *
 * @property \App\Model\Table\GruposTable $Grupos
 *
 * @method \App\Model\Entity\Grupo[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class GruposController extends AppController
{

    /**
     * Index method
     *
     * @return \Cake\Http\Response|void
     */
    public function index()
    {
        $todo= $this->Grupos->getIndexValues();
        $this->paginate = [
            'contain' => ['Usuarios']
        ];
        $grupos = $this->paginate($this->Grupos);

        //$V=$this->loadmodel('Grupos');
        //$V->getIndexData();
        $this->set(compact('grupos','todo'));

    }

    /**
     * View method
     *
     * @param string|null $id Grupo id.
     * @return \Cake\Http\Response|void
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $var= explode(',',$id);
        debug($var);
        die();
        /*Hay que hacer un metodo diferente por la llave compuesta ver http://php.net/manual/es/function.explode.php*/
        /*$grupo = $this->Grupos->get($id, [
            'contain' => ['Usuarios']
        ]);*/

        $this->set('grupo', $grupo);
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $grupo = $this->Grupos->newEntity();
        if ($this->request->is('post')) {
            $grupo = $this->Grupos->patchEntity($grupo, $this->request->getData());
            if ($this->Grupos->save($grupo)) {
                $this->Flash->success(__('The grupo has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The grupo could not be saved. Please, try again.'));
        }
        $usuarios = $this->Grupos->Usuarios->find('list', ['limit' => 200]);
        $this->set(compact('grupo', 'usuarios'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Grupo id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */

    public function edit($cursosigla = null, $numero = null, $semestre = null, $año = null/*$id = null*/)
    {
        /*$grupo = $this->Grupos->get($id, [
            'contain' => []
        ]);*/
        //$var= explode(',',$id);
        $grupo = $this->Grupos->find('all')->first(); 
        /*$grupo = $this->Grupos->get($grupo->curso_sigla=$var[1], $grupo->numero=$var[1], $grupo->semestre=$var[2], $grupo->año=$var[3], [
            'contain' => []
        ]);*/
        /*$grupo = $this->Grupos->get($grupo->curso_sigla=$cursosigla, $grupo->numero=$numero, $grupo->semestre=$semestre, $grupo->año=$año, [
            //'contain' => []
        ]);*/
        
        //$grupo = $this->Grupos->newEntity();//
        //$grupo= $this->Grupos->getIndexValues();

        //$grupo=$this->loadmodel('Grupos');
        //return $grupo->edit($cursosigla, $numero, $semestre, $año);
        $this->Grupos->editValues($cursosigla, $numero, $semestre, $año);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $grupo = $this->Grupos->patchEntity($grupo, $this->request->getData());
            if ($this->Grupos->save($grupo)) {
                $this->Flash->success(__('El Grupo ha sido Modificado.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('El Grupo no se pudo Modificar. Por favor, intentalo de nuevo.'));
        }
        $usuarios = $this->Grupos->Usuarios->find('list', ['limit' => 200]);
        $this->set(compact('grupo', 'usuarios'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Grupo id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($curso_sigla = null, $numero = null, $semestre = null, $año = null)
    {
        $this->request->allowMethod(['post', 'get']);
        $grupo = $this->Grupos->get($curso_sigla);
        if ($this->Grupos->deleteValues($grupo, $numero, $semestre, $año)) {
            $this->Flash->success(__('The grupo has been deleted.'));
        } else {
            $this->Flash->error(__('The grupo could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
