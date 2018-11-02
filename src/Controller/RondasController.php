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
         //Verifica por permisos y login
         $carne = $this->getRequest()->getSession()->read('id'); 
         if($carne != null){
            $connect = ConnectionManager::get('default');
            $consulta = "select roles_id from usuarios where nombre_usuario = '".$carne."';";
            $rol =  $connect->execute($consulta)->fetchAll(); //Devuelve el rol del usuario en cuestión
           
            $consulta = "select pos.estado
                        from posee as pos join permisos as per on pos.permisos_id =  per.id
                         where per.id = 9 and roles_id = ".$rol[0][0].";";
                         //9 = Consultar Ronda
            $tupla =  $connect->execute($consulta)->fetchAll();      
 
             if($tupla[0][0] != '1'){//1 = Tiene permisos para consultar usuarios
                $this->redirect(['controller' => 'Inicio','action' => 'fail']);
             }
         }
         else{
             $this->redirect(['controller' => 'Inicio','action' => 'fail']);
         }
         //Cierra la seguridad
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
        //Verifica por permisos y login
        $carne = $this->getRequest()->getSession()->read('id'); 
        if($carne != null){
           $connect = ConnectionManager::get('default');
           $consulta = "select roles_id from usuarios where nombre_usuario = '".$carne."';";
           $rol =  $connect->execute($consulta)->fetchAll(); //Devuelve el rol del usuario en cuestión
          
           $consulta = "select pos.estado
                       from posee as pos join permisos as per on pos.permisos_id =  per.id
                        where per.id = 9 and roles_id = ".$rol[0][0].";";
                        //9 = Consultar Ronda
           $tupla =  $connect->execute($consulta)->fetchAll();      

            if($tupla[0][0] != '1'){//1 = Tiene permisos para consultar usuarios
               $this->redirect(['controller' => 'Inicio','action' => 'fail']);
            }
        }
        else{
            $this->redirect(['controller' => 'Inicio','action' => 'fail']);
        }
        //Cierra la seguridad

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
         //Verifica por permisos y login
         $carne = $this->getRequest()->getSession()->read('id'); 
         if($carne != null){
            $connect = ConnectionManager::get('default');
            $consulta = "select roles_id from usuarios where nombre_usuario = '".$carne."';";
            $rol =  $connect->execute($consulta)->fetchAll(); //Devuelve el rol del usuario en cuestión
           
            $consulta = "select pos.estado
                        from posee as pos join permisos as per on pos.permisos_id =  per.id
                         where per.id = 11 and roles_id = ".$rol[0][0].";";
                         //11 = Agregar Ronda
            $tupla =  $connect->execute($consulta)->fetchAll();      
 
             if($tupla[0][0] != '1'){//1 = Tiene permisos para consultar usuarios
                $this->redirect(['controller' => 'Inicio','action' => 'fail']);
             }
         }
         else{
             $this->redirect(['controller' => 'Inicio','action' => 'fail']);
         }
         //Cierra la seguridad

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
         //Verifica por permisos y login
         $carne = $this->getRequest()->getSession()->read('id'); 
         if($carne != null){
            $connect = ConnectionManager::get('default');
            $consulta = "select roles_id from usuarios where nombre_usuario = '".$carne."';";
            $rol =  $connect->execute($consulta)->fetchAll(); //Devuelve el rol del usuario en cuestión
           
            $consulta = "select pos.estado
                        from posee as pos join permisos as per on pos.permisos_id =  per.id
                         where per.id = 12 and roles_id = ".$rol[0][0].";";
                         //12 = Modificar Ronda
            $tupla =  $connect->execute($consulta)->fetchAll();      
 
             if($tupla[0][0] != '1'){//1 = Tiene permisos para consultar usuarios
                $this->redirect(['controller' => 'Inicio','action' => 'fail']);
             }
         }
         else{
             $this->redirect(['controller' => 'Inicio','action' => 'fail']);
         }
         //Cierra la seguridad

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