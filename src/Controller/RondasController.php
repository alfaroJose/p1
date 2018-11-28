<?php
namespace App\Controller;
use App\Controller\AppController;


//Estos dos sirven para las consultas
use Cake\ORM\TableRegistry;
use Cake\Datasource\ConnectionManager;
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
         /*Inicia seguridad*/
         $seguridad = $this->loadModel('Seguridad');
         $carne = $this->request->getSession()->read('id');
         if ($carne != ''){
             $resultado = $seguridad->getPermiso($carne,9);
             if($resultado != 1){
                 return $this->redirect(['controller' => 'Inicio','action' => 'fail']);
             }
         }
         else{
             return $this->redirect(['controller' => 'Inicio','action' => 'fail']);
         }
         /*Cierra la seguridad*/
         
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
       /*Inicia seguridad*/
       $seguridad = $this->loadModel('Seguridad');
       $carne = $this->request->getSession()->read('id');
       if ($carne != ''){
           $resultado = $seguridad->getPermiso($carne,9);
           if($resultado != 1){
               return $this->redirect(['controller' => 'Inicio','action' => 'fail']);
           }
       }
       else{
           return $this->redirect(['controller' => 'Inicio','action' => 'fail']);
       }
       /*Cierra la seguridad*/

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
          /*Inicia seguridad*/
        $seguridad = $this->loadModel('Seguridad');
        $carne = $this->request->getSession()->read('id');
        if ($carne != ''){
            $resultado = $seguridad->getPermiso($carne,11);
            if($resultado != 1){
                return $this->redirect(['controller' => 'Inicio','action' => 'fail']);
            }
        }
        else{
            return $this->redirect(['controller' => 'Inicio','action' => 'fail']);
        }
        /*Cierra la seguridad*/

        $ronda = $this->Rondas->newEntity();
        if ($this->request->is('post')) {
            $ronda = $this->Rondas->patchEntity($ronda, $this->request->getData());
            if ($this->Rondas->save($ronda)) {
                $this->Flash->success(__('La ronda ha sido agregada.'));
                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('La ronda no se ha podido agregar. Por favor intente de nuevo.'));
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
         /*Inicia seguridad*/
         $seguridad = $this->loadModel('Seguridad');
         $carne = $this->request->getSession()->read('id');
         if ($carne != ''){
             $resultado = $seguridad->getPermiso($carne,12);
             if($resultado != 1){
                 return $this->redirect(['controller' => 'Inicio','action' => 'fail']);
             }
         }
         else{
             return $this->redirect(['controller' => 'Inicio','action' => 'fail']);
         }
         /*Cierra la seguridad*/

        $ronda = $this->Rondas->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $ronda = $this->Rondas->patchEntity($ronda, $this->request->getData());
            if ($this->Rondas->save($ronda)) {
                $this->Flash->success(__('La ronda ha sido modificada.'));
                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('La ronda no se ha podido modificar. Por favor intente de nuevo.'));
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
            $this->Flash->success(__('La ronda ha sido eliminada.'));
        } else {
            $this->Flash->error(__('La ronda no se ha podido eliminar. Por favor intente de nuevo.'));
        }
        return $this->redirect(['action' => 'index']);
    }
}