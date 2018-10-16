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
        //$grupo = $this->Grupos->find('all')->first(); 

        $grupo = $this->Grupos->newEntity();
        $todo=$this->Grupos->obtenerDatosCurso($cursosigla, $numero, $semestre, $año);
        
        $grupo->curso_sigla=$todo[0]->Cursos['sigla'];
        $grupo->numero=$todo[0]->numero;
        $grupo->semestre=$todo[0]->semestre;
        $grupo->año=$todo[0]->año;
        //debug($todo);
        //debug($grupo);
        if ($this->request->is(['patch', 'post', 'put'])) {
           // $prueba=$this->request->getData();
            

            $grupo = $this->Grupos->patchEntity($grupo, $this->request->getData());
            debug($grupo);
            /*$this->Grupos->actualizarTodo($cursosigla = $todo[0]->Cursos['sigla'], $numero = $todo[0]->numero, $semestre = $todo[0]->semestre, $año = $todo[0]->$año*/
            if ($this->Grupos->actualizarTodo(['Grupos.numero','Grupos.semestre','Grupos.año'], ['Cursos.sigla','Grupos.numero','Grupos.semestre','Grupos.año'])/*$this->Grupos->save($grupo)*/) {
                $this->Flash->success(__('El Grupo ha sido Modificado.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('El Grupo no se pudo Modificar. Por favor, intentalo de nuevo.'));
        }
        $usuarios = $this->Grupos->Usuarios->find('list', ['limit' => 200]);
        
        $this->set(compact('grupo', 'usuarios','todo'));
    }

    /**
     * Delete method
     *
     * @param string|null $numero Grupo numero, parte de la llave compuesta.
     * @param string|null $semestre Grupo semestre, parte de la llave compuesta.
     * @param string|null $año Grupo año, parte de la llave compuesta.
     * @param string|null $curso_sigla Grupo llave foranea cursos_sigla, parte de la llave compuesta.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete( $numero = null, $semestre = null, $año = null, $curso_sigla = null)
    {
        $this->request->allowMethod(['post']);
        if ($this->Grupos->deleteValues( $numero, $semestre, $año, $curso_sigla)) {
            $this->Flash->success(__('The grupo has been deleted.'));
        } else {
            $this->Flash->error(__('The grupo could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
