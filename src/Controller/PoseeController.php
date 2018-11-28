<?php
namespace App\Controller;

use App\Controller\AppController;
use Cake\ORM\TableRegistry;
use Cake\Datasource\ConnectionManager;

/**
 * Posee Controller
 *
 * @property \App\Model\Table\PoseeTable $Posee
 *
 * @method \App\Model\Entity\Posee[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class PoseeController extends AppController
{
    /*
    * Metodo para tratar de guardar los datos del form
    * Retorna una entidad para insertar en la tabla
    */
    private function guardarDatos($datos = null, $rolId = null){
        foreach ($datos as $dato => $value) {
            $noCheckbox = false;//Variable para ver si el dato recibido del form no es un checkbox
            //primero busca en la tabla posee con los datos de la llave primaria, rol_id y permismo_id en ese orden en los gets que aparecen abajo
            if($dato == "checkboxInsUsuarios"){
                $poseeTupla = $this->Posee->get([$rolId, 19]);
            }
            else if($dato == "checkboxInsCursos"){
                $poseeTupla = $this->Posee->get([$rolId, 3]);
            }
            else if($dato == "checkboxInsReq"){
                $poseeTupla = $this->Posee->get([$rolId, 7]);
            }
            else if($dato == "checkboxInsSoli"){
                $poseeTupla = $this->Posee->get([$rolId, 15]);
            }
            else if($dato == "checkboxModUsuarios"){
                $poseeTupla = $this->Posee->get([$rolId, 20]);
            }
            else if($dato == "checkboxModCursos"){
                $poseeTupla = $this->Posee->get([$rolId, 4]);
            }
            else if($dato == "checkboxModRondas"){
                $poseeTupla = $this->Posee->get([$rolId, 12]);
            }
            else if($dato == "checkboxModReq"){
                $poseeTupla = $this->Posee->get([$rolId, 8]);
            }
            else if($dato == "checkboxModCont"){
                $poseeTupla = $this->Posee->get([$rolId, 22]);
            }
            else if($dato == "checkboxElimUsuarios"){
                $poseeTupla = $this->Posee->get([$rolId, 18]);
            }
            else if($dato == "checkboxElimCursos"){
                $poseeTupla = $this->Posee->get([$rolId, 2]);
            }
            else if($dato == "checkboxElimReq"){
                $poseeTupla = $this->Posee->get([$rolId, 6]);
            }
            else if($dato == "checkboxElimSoli"){
                $poseeTupla = $this->Posee->get([$rolId, 14]);
            }
            else if($dato == "checkboxConsUsuarios"){
                $poseeTupla = $this->Posee->get([$rolId, 17]);
            }
            else if($dato == "checkboxConsCursos"){
                $poseeTupla = $this->Posee->get([$rolId, 1]);
            }
            else if($dato == "checkboxConsRondas"){
                $poseeTupla = $this->Posee->get([$rolId, 9]);
            }
            else if($dato == "checkboxConsReq"){
                $poseeTupla = $this->Posee->get([$rolId, 5]);
            }
            else if($dato == "checkboxConsSoli"){
                $poseeTupla = $this->Posee->get([$rolId, 13]);
            }
            else if($dato == "checkboxConsCont"){
                $poseeTupla = $this->Posee->get([$rolId, 23]);
            }
            else if($dato == "checkboxIngresoRev"){
                $poseeTupla = $this->Posee->get([$rolId, 21]);
            }
            else if($dato == "checkboxIngresoRep"){
                $poseeTupla = $this->Posee->get([$rolId, 24]);
            }
            else if($dato == "checkboxIngresoImp"){
                $poseeTupla = $this->Posee->get([$rolId, 25]);
            }
            else{
                $noCheckbox = true;//Cualquier dato que no sea checkbox
            }
            if($noCheckbox == false){
                if($value == ''){
                    $poseeTupla->estado = 0;//Se desactiva en la base de datos
                }
                else{
                    $poseeTupla->estado = 1;//Se activa
                }
                $this->Posee->save($poseeTupla);
            }   
        }       
    }
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
        if($carne == ''){
            return $this->redirect(['controller' => 'Inicio','action' => 'fail']);
        }
         $resultado = $seguridad->getRol($carne);
        if($resultado != 1){
            return $this->redirect(['controller' => 'Inicio','action' => 'fail']);
        }
        /*Cierra la seguridad*/
        

        $query = $this->Posee->find('all');//Toma todas las tuplas
        $posee = $query->toArray();//Las convierte en arreglo
        $opciones = array("1" => "Administrador","2" => "Asistente Administrativo", "3" => "Profesor", "4" => "Estudiante");//Usado para el selection en la vista

        $this->set(compact('posee'));//envia la tabla como variable para llenar los checkboxes
        $this->set('opciones', $opciones);

        if($this->request->is('post')){
            $datos = $this->request->getData();//Toma todos los datos del form
            $rolId = $this->request->getData("Seleccion");//Toma el rol al que se le estan agregando o quitando permisos
            if(count($datos) > 2){
                $this->guardarDatos($datos, $rolId);//Llama al metodo para guardar cambios
                $this->Flash->success(__('Los permisos han sido modificados exitosamente.'));
            }
            else{//Si no se ha seleccionado nada
                $this->Flash->error(__('No hay ningun permiso seleccionado, por favor seleccione al menos uno.'));
            }
            return $this->redirect(['action' => 'index']);//Recarga la pagina
        }
    }
}
