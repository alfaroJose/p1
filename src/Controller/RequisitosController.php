<?php
namespace App\Controller;

use App\Controller\AppController;

//Estos dos sirven para las consultas
use Cake\ORM\TableRegistry;
use Cake\Datasource\ConnectionManager;

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
        /*Inicia seguridad*/
        $seguridad = $this->loadModel('Seguridad');
        $carne = $this->request->getSession()->read('id');
        if ($carne != ''){
            $resultado = $seguridad->getPermiso($carne,5);
            if($resultado != 1){
                return $this->redirect(['controller' => 'Inicio','action' => 'fail']);
            }
        }
        else{
            return $this->redirect(['controller' => 'Inicio','action' => 'fail']);

        }
        /*Cierra la seguridad*/

        /*Saca la cantidad de tuplas de la tabla Usuarios*/
        $cantidad = $this->Requisitos->getCountRequisitos();

        /*Esto es por que la función paginate tiene un default de límite de 20 records y no permite ver más en la tabla*/
        $this->paginate['maxLimit'] = $cantidad[0];
        $this->paginate['limit']    = $cantidad[0];

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
         /*Inicia seguridad*/
         $seguridad = $this->loadModel('Seguridad');
         $carne = $this->request->getSession()->read('id');
         if ($carne != ''){
             $resultado = $seguridad->getPermiso($carne,5);
             if($resultado != 1){
                 return $this->redirect(['controller' => 'Inicio','action' => 'fail']);
             }
         }
         else{
             return $this->redirect(['controller' => 'Inicio','action' => 'fail']);
         }
         /*Cierra la seguridad*/

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
       /*Inicia seguridad*/
         $seguridad = $this->loadModel('Seguridad');
         $carne = $this->request->getSession()->read('id');
         if ($carne != ''){
             $resultado = $seguridad->getPermiso($carne,7);
             if($resultado != 1){
                 return $this->redirect(['controller' => 'Inicio','action' => 'fail']);
             }
         }
         else{
             return $this->redirect(['controller' => 'Inicio','action' => 'fail']);
         }
         /*Cierra la seguridad*/

        $requisito = $this->Requisitos->newEntity();
        if ($this->request->is('post')) {
            $requisito = $this->Requisitos->patchEntity($requisito, $this->request->getData());
            
            if ($requisito->tipo == 0) {
                $requisito->tipo = 'Obligatorio';
            } else {
                $requisito->tipo = 'Obligatorio Inopia';
            }

            if ($requisito->categoria == 0) {
                $requisito->categoria = 'Horas Asistente';
            } else if ($requisito->categoria == 1){
                $requisito->categoria = 'Horas Estudiante';
            } else {
                $requisito->categoria = 'General';
            }

            if ($this->Requisitos->save($requisito)) {
                $this->Flash->success(__('El requisito ha sido agregado.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('El requisito no se ha podido agregar. Por favor intente de nuevo.'));
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
        /*Inicia seguridad*/
        $seguridad = $this->loadModel('Seguridad');
        $carne = $this->request->getSession()->read('id');
        if ($carne != ''){
            $resultado = $seguridad->getPermiso($carne,8);
            if($resultado != 1){
                return $this->redirect(['controller' => 'Inicio','action' => 'fail']);
            }
        }
        else{
            return $this->redirect(['controller' => 'Inicio','action' => 'fail']);
        }
        /*Cierra la seguridad*/

        $requisito = $this->Requisitos->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $requisito = $this->Requisitos->patchEntity($requisito, $this->request->getData());
            if ($this->Requisitos->save($requisito)) {
                $this->Flash->success(__('El requisito ha sido modificado.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('El requisito no se ha podido modificar. Por favor intente de nuevo.'));
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
            $this->Flash->success(__('El requisito ha sido eliminado.'));
        } else {
            $this->Flash->error(__('El requisito no se ha podido eliminar. Por favor intente de nuevo.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
