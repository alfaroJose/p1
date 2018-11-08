<?php
namespace App\Controller;

use App\Controller\AppController;
use Cake\Datasource\ConnectionManager;
use Cake\ORM\TableRegistry;

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
         //Inicia seguridad
         $carne = $this->getRequest()->getSession()->read('id');
         if($carne != null){
            $connect = ConnectionManager::get('default');
            $consulta = "select roles_id from usuarios where nombre_usuario = '".$carne."';";
            $tupla =  $connect->execute($consulta)->fetchAll();
           
            $consulta = "select pos.estado
            from posee as pos join permisos as per on pos.permisos_id =  per.id
             where per.id = 23 and roles_id = ".$tupla[0][0].";";
             //23 = Consultar contadro
            $tupla =  $connect->execute($consulta)->fetchAll();      

            if($tupla[0][0] != '1'){//1 = Tiene permisos para consultar usuarios
                $this->redirect(['controller' => 'Inicio','action' => 'fail']);
            }
         }
         else{
            
             $this->redirect(['controller' => 'Inicio','action' => 'fail']);

         }
         //Cierra seguridad
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
         //Inicia seguridad
         $carne = $this->getRequest()->getSession()->read('id');
         if($carne != null){
            $connect = ConnectionManager::get('default');
            $consulta = "select roles_id from usuarios where nombre_usuario = '".$carne."';";
            $tupla =  $connect->execute($consulta)->fetchAll();
           
            $consulta = "select pos.estado
            from posee as pos join permisos as per on pos.permisos_id =  per.id
             where per.id = 23 and roles_id = ".$tupla[0][0].";";
             //23 = Consultar contador
            $tupla =  $connect->execute($consulta)->fetchAll();      

            if($tupla[0][0] != '1'){//1 = Tiene permisos para consultar usuarios
                $this->redirect(['controller' => 'Inicio','action' => 'fail']);
            }           
         }
         else{
            
             $this->redirect(['controller' => 'Inicio','action' => 'fail']);
         }
         //Cierra seguridad
        $contador = $this->Contador->get($id, [
            'contain' => []
        ]);

        $this->set('contador', $contador);
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
         //Inicia seguridad
         $carne = $this->getRequest()->getSession()->read('id');
         if($carne != null){
            $connect = ConnectionManager::get('default');
            $consulta = "select roles_id from usuarios where nombre_usuario = '".$carne."';";
            $tupla =  $connect->execute($consulta)->fetchAll();
           
             if($tupla[0][0] != '1'){//1 = Administrador
                $this->redirect(['controller' => 'Inicio','action' => 'fail']);
             }
         }
         else{
            
             $this->redirect(['controller' => 'Inicio','action' => 'fail']);

         }
         //Cierra seguridad
        $contador = $this->Contador->newEntity();
        if ($this->request->is('post')) {
            $contador = $this->Contador->patchEntity($contador, $this->request->getData());
            if ($this->Contador->save($contador)) {
                $this->Flash->success(__('The contador has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The contador could not be saved. Please, try again.'));
        }
        $this->set(compact('contador'));
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
         //Inicia seguridad
         $carne = $this->getRequest()->getSession()->read('id');
         if($carne != null){
            $connect = ConnectionManager::get('default');
            $consulta = "select roles_id from usuarios where nombre_usuario = '".$carne."';";
            $tupla =  $connect->execute($consulta)->fetchAll();

            $consulta = "select pos.estado
            from posee as pos join permisos as per on pos.permisos_id =  per.id
             where per.id = 22 and roles_id = ".$tupla[0][0].";";
             //22 = Editar contador
            $tupla =  $connect->execute($consulta)->fetchAll();      

            if($tupla[0][0] != '1'){//1 = Tiene permisos para consultar usuarios
                $this->redirect(['controller' => 'Inicio','action' => 'fail']);
            }
         }
         else{
            $this->redirect(['controller' => 'Inicio','action' => 'fail']);

         }
         //Cierra seguridad
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
         //Inicia seguridad
         $carne = $this->getRequest()->getSession()->read('id');
         if($carne != null){
            $connect = ConnectionManager::get('default');
            $consulta = "select roles_id from usuarios where nombre_usuario = '".$carne."';";
            $tupla =  $connect->execute($consulta)->fetchAll();
           
             if($tupla[0][0] != '1'){//1 = Administrador
                $this->redirect(['controller' => 'Inicio','action' => 'fail']);
             }
         }
         else{
            
             $this->redirect(['controller' => 'Inicio','action' => 'fail']);

         }
         //Cierra seguridad
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
