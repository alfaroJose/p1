<?php
namespace App\Controller;

use App\Controller\AppController;

/**
 * Contador Controller
 *
 * @property \App\Model\Table\ContadorTable $Contador
 *
 * @method \App\Model\Entity\Contador[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class ContadorController extends AppController
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
             $resultado = $seguridad->getPermiso($carne,23);
             if($resultado != 1){
                 return $this->redirect(['controller' => 'Inicio','action' => 'fail']);
             }
         }
         else{
             return $this->redirect(['controller' => 'Inicio','action' => 'fail']);
         }
         /*Cierra la seguridad*/

        $contador = $this->paginate($this->Contador);

        $this->set(compact('contador'));
    }

    /**
     * View method
     *
     * @param string|null $id Contador id.
     * @return \Cake\Http\Response|void
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
         /*Inicia seguridad*/
         $seguridad = $this->loadModel('Seguridad');
         $carne = $this->request->getSession()->read('id');
         if ($carne != ''){
             $resultado = $seguridad->getPermiso($carne,23);
             if($resultado != 1){
                 return $this->redirect(['controller' => 'Inicio','action' => 'fail']);
             }
         }
         else{
             return $this->redirect(['controller' => 'Inicio','action' => 'fail']);
         }
         /*Cierra la seguridad*/
        $contador = $this->Contador->get($id, [
            'contain' => []
        ]);

        $this->set('contador', $contador);
    }

    /**
     * Edit method
     *
     * @param string|null $id Contador id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
         /*Inicia seguridad*/
         $seguridad = $this->loadModel('Seguridad');
         $carne = $this->request->getSession()->read('id');
         if ($carne != ''){
             $resultado = $seguridad->getPermiso($carne,22);
             if($resultado != 1){
                 return $this->redirect(['controller' => 'Inicio','action' => 'fail']);
             }
         }
         else{
             return $this->redirect(['controller' => 'Inicio','action' => 'fail']);
         }
         /*Cierra la seguridad*/
        $contador = $this->Contador->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $contador = $this->Contador->patchEntity($contador, $this->request->getData());
            if ($this->Contador->save($contador)) {
                $this->Flash->success(__('El contador ha sido modificado.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('El contador no se ha podido modificar. Por favor intente de nuevo.'));
        }
        $this->set(compact('contador'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Contador id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $contador = $this->Contador->get($id);
        if ($this->Contador->delete($contador)) {
            $this->Flash->success(__('The contador has been deleted.'));
        } else {
            $this->Flash->error(__('The contador could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
