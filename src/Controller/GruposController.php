<?php
namespace App\Controller;

use App\Controller\AppController;
use Cake\Datasource\ConnectionManager;
use Cake\ORM\TableRegistry;


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
        //Verifica por permisos y login
        $carne = $this->getRequest()->getSession()->read('id'); 
        if($carne != null){
           $connect = ConnectionManager::get('default');
           $consulta = "select roles_id from usuarios where nombre_usuario = '".$carne."';";
           $rol =  $connect->execute($consulta)->fetchAll(); //Devuelve el rol del usuario en cuestión
          
           $consulta = "select pos.estado
                       from posee as pos join permisos as per on pos.permisos_id =  per.id
                        where per.id = 1 and roles_id = ".$rol[0][0].";";
                        //1 = Consultar Curso-Grupo
           $tupla =  $connect->execute($consulta)->fetchAll();      

            if($tupla[0][0] != '1'){//1 = Tiene permisos para consultar usuarios
               $this->redirect(['controller' => 'Inicio','action' => 'fail']);
            }
        }
        else{
            $this->redirect(['controller' => 'Inicio','action' => 'fail']);
        }
        //Cierra la seguridad

        $todo= $this->Grupos->getIndexValues();
        $this->paginate = [
            'contain' => ['Usuarios']
        ];
        $grupos = $this->paginate($this->Grupos);

        $this->set(compact('grupos','todo'));
    }

    /**
     * View method
     *
     * @param string|null $id Grupo id.
     * @return \Cake\Http\Response|void
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     *//*
    public function view($id = null)
    {
        $grupo = $this->Grupos->get($id, [
            'contain' => ['Usuarios']
        ]);

        $this->set('grupo', $grupo);
    } COMENTADO PARA EVITAR ACCESOS POR URL*/

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
                        where per.id = 3 and roles_id = ".$rol[0][0].";";
                        //3 = Agregar Curso-Grupo
           $tupla =  $connect->execute($consulta)->fetchAll();      

            if($tupla[0][0] != '1'){//1 = Tiene permisos para consultar usuarios
               $this->redirect(['controller' => 'Inicio','action' => 'fail']);
            }
        }
        else{
            $this->redirect(['controller' => 'Inicio','action' => 'fail']);
        }
        //Cierra la seguridad
        $opcionesSemestre=[1,2,3];
        $semestreEncontrado=false;
        $itSemestre=0;
        $defaultSelectSemestre=0;
        $profesorEncontrado=false;
        $itProfesor=0;
        $defaultSelectProfesor=0;
        $siglaEncontrado=false;
        $itSigla=0;
        $defaultSelectSigla=0;

        $cursos = $this->Grupos->obtenerTodosCursos();
        $siglaIndex= array(0 => "");
        $siglaIds=array(0 => "");

        foreach ($cursos as $key => $value) {
            array_push($siglaIndex, $value[0]);
            array_push($siglaIds, $value[1]);
        }

        $profesores = $this->Grupos->seleccionarProfesoresCorreos();
        $profesoresCorreos= array(0 => "");
        $profesoresIds=array(0 => "");

        foreach ($profesores as $key => $value) {
          
            array_push($profesoresCorreos, $value[0]);
            array_push($profesoresIds, $value[1]);
        }

    
        $grupo = $this->Grupos->newEntity();
        if ($this->request->is('post')) {
            $grupo = $this->Grupos->patchEntity($grupo, $this->request->getData());
            $semestreSeleccionado = $this->request->getData('Semestre');
            $grupo->semestre = $opcionesSemestre[$semestreSeleccionado];
            $profesorSeleccionado = $this->request->getData('Profesor');
            $grupo->usuarios_id = $profesoresIds[$profesorSeleccionado];
            $siglaSeleccionada = $this->request->getData('Sigla');
            $grupo->cursos_id = $siglaIds[3];
            if ($this->Grupos->save($grupo)) {
                $this->Flash->success(__('El grupo ha sido agregado.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('El grupo no se ha podido agregar. Por favor intente de nuevo.'));
        }
        
        $this->set('siglaIndex', $siglaIndex);
        $this->set('opcionesSemestre', $opcionesSemestre);
        $this->set('correos',$profesoresCorreos);
        $this->set('defaultSelectProfesor',$defaultSelectProfesor);
        $this->set('defaultSelectSemestre',$defaultSelectSemestre);
        $this->set('defaultSelectCurso',$defaultSelectSigla);
        $this->set(compact('grupo', 'profesores', 'cursos'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Grupo id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
     public function edit($id = null, $id2 = null, $id3 = null)
     {
        //Verifica por permisos y login
        $carne = $this->getRequest()->getSession()->read('id'); 
        if($carne != null){
           $connect = ConnectionManager::get('default');
           $consulta = "select roles_id from usuarios where nombre_usuario = '".$carne."';";
           $rol =  $connect->execute($consulta)->fetchAll(); //Devuelve el rol del usuario en cuestión
          
           $consulta = "select pos.estado
                       from posee as pos join permisos as per on pos.permisos_id =  per.id
                        where per.id = 4 and roles_id = ".$rol[0][0].";";
                        //4 = Editar Curso-Grupo
           $tupla =  $connect->execute($consulta)->fetchAll();      

            if($tupla[0][0] != '1'){//1 = Tiene permisos para consultar usuarios
               $this->redirect(['controller' => 'Inicio','action' => 'fail']);
            }
        }
        else{
            $this->redirect(['controller' => 'Inicio','action' => 'fail']);
        }
        //Cierra la seguridad

        $opcionesSemestre=[1,2,3];
        $semestreEncontrado=false;
        $itSemestre=0;
        $defaultSelectSemestre=0;
        $profesorEncontrado=false;
        $itProfesor=0;
        $defaultSelectProfesor=0;
/*
$connect = ConnectionManager::get('default');
        $profesores = $connect->execute("select correo, id from Usuarios where Usuarios.roles_id = 3")->fetchAll();
*/
        $profesores = $this->Grupos->seleccionarProfesoresCorreos();
        $profesoresCorreos= array(0 => "");
        $profesoresIds=array(0 => "");
        $grupo = $this->Grupos->get($id, [
            'contain' => []
        ]);
        //debug($profesores);
        //die();
        $cursos = $this->Grupos->obtenerCursos($id2);
        foreach ($profesores as $key => $value) {
          
            array_push($profesoresCorreos, $value[0]);
            array_push($profesoresIds, $value[1]);
        }/*
        debug($profesoresIds);
        die();*/
        //coso lento
         while(!$profesorEncontrado){
            if($profesoresIds[$itProfesor]==$id3){
                $profesorEncontrado=true;
            }
            else{
                $itProfesor++;
            }
         }
         $defaultSelectProfesor=$itProfesor;
        while(!$semestreEncontrado){
            if($opcionesSemestre[$itSemestre]==$grupo->semestre){
                $semestreEncontrado=true;
            }
            else{
                $itSemestre++;
            }
         }
         $defaultSelectSemestre=$itSemestre;
        if ($this->request->is(['patch', 'post', 'put'])) {
            //debug($this->request->getData('Profesor'));
            //die();
            $grupo = $this->Grupos->patchEntity($grupo, $this->request->getData());
            $semestreSeleccionado = $this->request->getData('Semestre');
           
            $grupo->semestre = $opcionesSemestre[$semestreSeleccionado];
            //debug($grupo->semestre);
            //die();
            $profesorSeleccionado = $this->request->getData('Profesor');
           
            $grupo->usuarios_id = $profesoresIds[$profesorSeleccionado];
            //debug($grupo);  
            //die();
            if ($this->Grupos->save($grupo)) {
                $this->Flash->success(__('El grupo ha sido modificado.'));
                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('El grupo no se ha podido modificar. Por favor intente de nuevo.'));
        }
        $usuarios = $this->Grupos->Usuarios->find('list', ['limit' => 200]);
        
        /*$cursos=[];
        foreach ($cursos2 as $c ) {
            array_push($cursos, $c->Cursos['sigla']);
        }*/
        $this->set('correos',$profesoresCorreos);
        $this->set('opcionesSemestre', $opcionesSemestre);
        $this->set('defaultSelectProfesor',$defaultSelectProfesor);
        $this->set('defaultSelectSemestre',$defaultSelectSemestre);
        $this->set(compact('grupo', /*'usuarios', */'cursos'/*,'correo'*/));
    }

    /**
     * Delete method
     *
     * @param string|null $id Grupo id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post']);
        $grupo = $this->Grupos->get($id);
        if ($this->Grupos->delete($grupo)) {
            $this->Flash->success(__('El grupo ha sido eliminado.'));
        } else {
            $this->Flash->error(__('El grupo no se ha podido eliminar. Por favor intente de nuevo.'));
        }

        return $this->redirect(['action' => 'index']);
    }

}
