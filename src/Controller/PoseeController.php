<?php
namespace App\Controller;

use App\Controller\AppController;
use Cake\ORM\TableRegistry;

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
            $noCheckbox = false;
            if($dato == "checkbox1"){
                $poseeTupla = $this->Posee->get(['Usuarios','Insertar', $rolId]);
            }
            else if($dato == "checkbox2"){
                $poseeTupla = $this->Posee->get(['Cursos-Grupos','Insertar', $rolId]);
            }
            else if($dato == "checkbox3"){
                $poseeTupla = $this->Posee->get(['Rondas','Insertar', $rolId]);
            }
            else if($dato == "checkbox4"){
                $poseeTupla = $this->Posee->get(['Requisitos','Insertar', $rolId]);
            }
            else if($dato == "checkbox5"){
                $poseeTupla = $this->Posee->get(['Solicitudes','Insertar', $rolId]);
            }
            else if($dato == "checkbox6"){
                $poseeTupla = $this->Posee->get(['Usuarios','Modificar', $rolId]);
            }
            else if($dato == "checkbox7"){
                $poseeTupla = $this->Posee->get(['Cursos-Grupos','Modificar', $rolId]);
            }
            else if($dato == "checkbox8"){
                $poseeTupla = $this->Posee->get(['Rondas','Modificar', $rolId]);
            }
            else if($dato == "checkbox9"){
                $poseeTupla = $this->Posee->get(['Requisitos','Modificar', $rolId]);
            }
            else if($dato == "checkbox10"){
                $poseeTupla = $this->Posee->get(['Solicitudes','Modificar', $rolId]);
            }
            else if($dato == "checkbox11"){
                $poseeTupla = $this->Posee->get(['Usuarios','Eliminar', $rolId]);
            }
            else if($dato == "checkbox12"){
                $poseeTupla = $this->Posee->get(['Cursos-Grupos','Eliminar', $rolId]);
            }
            else if($dato == "checkbox13"){
                $poseeTupla = $this->Posee->get(['Rondas','Eliminar', $rolId]);
            }
            else if($dato == "checkbox14"){
                $poseeTupla = $this->Posee->get(['Requisitos','Eliminar', $rolId]);
            }
            else if($dato == "checkbox15"){
                $poseeTupla = $this->Posee->get(['Solicitudes','Eliminar', $rolId]);
            }
            else if($dato == "checkbox16"){
                $poseeTupla = $this->Posee->get(['Usuarios','Consultar', $rolId]);
            }
            else if($dato == "checkbox17"){
                $poseeTupla = $this->Posee->get(['Cursos-Grupos','Consultar', $rolId]);
            }
            else if($dato == "checkbox18"){
                $poseeTupla = $this->Posee->get(['Rondas','Consultar', $rolId]);
            }
            else if($dato == "checkbox19"){
                $poseeTupla = $this->Posee->get(['Requisitos','Consultar', $rolId]);
            }
            else if($dato == "checkbox20"){
                $poseeTupla = $this->Posee->get(['Solicitudes','Consultar', $rolId]);
            }
            else{
                $noCheckbox = true;//Cualquier dato que no sea checkbox
            }
            if($noCheckbox == false){
                if($value == ''){
                    $poseeTupla->estado = 0;
                }
                else{
                    $poseeTupla->estado = 1;
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
        $query = $this->Posee->find('all');//Toma todas las tuplas
        $posee = $query->toArray();//
        $opciones = array("1" => "Administrador","2" => "Asistente Administrativo", "3" => "Profesor", "4" => "Estudiante");//Usado para el selection

        $this->set(compact('posee'));
        $this->set('opciones', $opciones);

        if($this->request->is('post')){
            $datos = $this->request->getData();
            $rolId = $this->request->getData("Seleccion");//Toma el rol al que se le estan agregando o quitando permisos
            if(count($datos) > 2){
                $this->guardarDatos($datos, $rolId);
                $this->Flash->success(__('Los permisos han sido modificados exitosamente.'));
            }
            else{//Si no se ha seleccionado nada
                $this->Flash->error(__('No hay ningun permiso seleccionado, por favor seleccione al menos uno.'));
            }
            return $this->redirect(['action' => 'index']);
        }
    }
}
