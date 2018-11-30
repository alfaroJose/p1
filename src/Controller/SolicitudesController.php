<?php
namespace App\Controller;
use App\Controller\AppController;
use Dompdf\Dompdf;
use Cake\Datasource\ConnectionManager;
use Cake\Chronos\Date;
use Cake\ORM\TableRegistry;
use Cake\Event\Event;
use Cake\Network\Email\Email;

use PhpOffice\PhpSpreadsheet\IOFactory;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Helper;
use PhpOffice\PhpSpreadsheet\Writer\Xls;
use Cake\Filesystem\Folder;
use Cake\Filesystem\File;
use Cake\Database\Exception;
require ROOT.DS.'vendor' .DS. 'phpoffice/phpspreadsheet/src/Bootstrap.php';



//Para generar el excel de solicitud

require 'C:\xampp\htdocs\p1\vendor\autoload.php';

//$carnetCompartido='b67130';variable para guardar el carnet seleccionado en reporte y obtenertlo en genera

/**
 * Solicitudes Controller
 *
 * @property \App\Model\Table\SolicitudesTable $Solicitudes
 *
 * @method \App\Model\Entity\Solicitude[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class SolicitudesController extends AppController
{
    /**
     * Index method
     *
     * @return \Cake\Http\Response|void
     */
    public function index()
    {     
        $semestre = $this->get_semester(); //obtiene el semestre actual
        $año = $this->get_year(); //obtiene el año actual
        $username = $this->getRequest()->getSession()->read('id'); //obtiene el nombre de usuario actualmente logueado


        /*Inicia seguridad*/
        $seguridad = $this->loadModel('Seguridad');
        $carne = $this->request->getSession()->read('id');
        if ($carne != ''){
            $resultado = $seguridad->getPermiso($carne,13);
            if($resultado != 1){
                return $this->redirect(['controller' => 'Inicio','action' => 'fail']);
            }
        }
        else{
            return $this->redirect(['controller' => 'Inicio','action' => 'fail']);

        }
        /*Cierra la seguridad*/

        $rolActual =  $seguridad->getRol($carne);
             
        $idActual = $this->Solicitudes->getIDUsuario($username); //obtiene el id de usuario actualmente logueado
        if(4==$rolActual[0]){ //si el usuario es un estudiante     
                $todo = $this->Solicitudes->getIndexValuesActualesEstudiante($idActual[0][0], $semestre, $año); //carga el index con solo los datos de este semestre del estudiante actualmente logueado
        }else if(3==$rolActual[0]){ //si el usuario es un profesor 
                $todo = $this->Solicitudes->getIndexValuesActualesProfesor($idActual[0][0], $semestre, $año); //carga el index con solo las solicitudes del semestre actual del profesor actualmente logueado 
        }else if(1==$rolActual[0]||2==$rolActual[0]){ //si el usuario es un admin o asistente de admin 
                $todo = $this->Solicitudes->getIndexActualesValues($semestre, $año); //carga el index con todas las solicitudes del semestre actual
            }
      
        $this->paginate = [
            'contain' => ['Usuarios', 'Grupos']
        ];   
        $estado = $this->get_estado_ronda();
        $this->set(compact('todo','estado'));
        $this->set('rolActual',$rolActual);
    }
/*Index para el historial de solicitudes del estudiante*/
    public function indexHistorialEstudiante()
    {     
        $username = $this->getRequest()->getSession()->read('id'); //obtiene el nombre de usuario actualmente logueado
               
       /*Inicia seguridad*/
       $seguridad = $this->loadModel('Seguridad');
       $carne = $this->request->getSession()->read('id');
       $rolActual = $seguridad->getRol($carne);
       if ($carne != ''){
           $resultado = $seguridad->getPermiso($carne,13);
           if($resultado != 1 || $rolActual != 4){
               return $this->redirect(['controller' => 'Inicio','action' => 'fail']);
           }
       }
       else{
           return $this->redirect(['controller' => 'Inicio','action' => 'fail']);

       }
       /*Cierra la seguridad*/
             
        $idActual = $this->Solicitudes->getIDUsuario($username); //obtiene el id de usuario actualmente logueado
        
        $todo = $this->Solicitudes->getIndexValuesEstudiante($idActual[0][0]); //carga el index con todas las solicitudes del estudiante actualmente logueado 
           
      
        $this->paginate = [
            'contain' => ['Usuarios', 'Grupos']
        ];
        $estado = $this->get_estado_ronda();
        $this->set(compact('todo','estado'));
        $this->set('rolActual',$rolActual);
    }
    /*Index para el historial de solicitudes en total*/
    public function indexHistorialAdmin()
    {     
        
        $username = $this->getRequest()->getSession()->read('id'); //obtiene el nombre de usuario actualmente logueado
               
        /*Inicia seguridad*/
        $seguridad = $this->loadModel('Seguridad');
        $carne = $this->request->getSession()->read('id');
        $rolActual = $seguridad->getRol($carne);
        if ($carne != ''){
            $resultado = $seguridad->getPermiso($carne,13);
            $rolAdecuado = false;
            if($rolActual == 1 || $rolActual == 2){
                $rolAdecuado = true;
            }
            if($resultado != 1 || !$rolAdecuado){
                return $this->redirect(['controller' => 'Inicio','action' => 'fail']);
            }
        }
        else{
            return $this->redirect(['controller' => 'Inicio','action' => 'fail']);

        }
        /*Cierra la seguridad*/
             
        $idActual = $this->Solicitudes->getIDUsuario($username); //obtiene el id de usuario actualmente logueado
        
        $todo = $this->Solicitudes->getIndexValues(); //carga el index con todas las solicitudes existentes 
           
      
        $this->paginate = [
            'contain' => ['Usuarios', 'Grupos']
        ];
        $estado = $this->get_estado_ronda();
        $this->set(compact('todo','estado'));
        $this->set('rolActual',$rolActual);
    }
    /*Index para el historial de solicitudes del profesor*/
    public function indexHistorialProfesor()
    {     
        //$semestre = $this->get_semester(); //obtiene el semestre actual
        //$año = $this->get_year(); //obtiene el año actual
        $username = $this->getRequest()->getSession()->read('id'); //obtiene el nombre de usuario actualmente logueado
               
        /*Inicia seguridad*/
        $seguridad = $this->loadModel('Seguridad');
        $carne = $this->request->getSession()->read('id');
        $rolActual = $seguridad->getRol($carne);
        if ($carne != ''){
            $resultado = $seguridad->getPermiso($carne,13);
            if($resultado != 1 || $rolActual != 3){
                return $this->redirect(['controller' => 'Inicio','action' => 'fail']);
            }
        }
        else{
            return $this->redirect(['controller' => 'Inicio','action' => 'fail']);
        }
        /*Cierra la seguridad*/
             
        $idActual = $this->Solicitudes->getIDUsuario($username); //obtiene el id de usuario actualmente logueado
        
        $todo = $this->Solicitudes->getIndexValuesProfesor($idActual[0][0]); //carga el index con todas las solicitudes del profesor actualmente logueado
           
      
        $this->paginate = [
            'contain' => ['Usuarios', 'Grupos']
        ];
        $estado = $this->get_estado_ronda();
        $this->set(compact('todo','estado'));
        $this->set('rolActual',$rolActual);
    }
    public function revisar($id = null)
    {
        /*Inicia seguridad*/
        $seguridad = $this->loadModel('Seguridad');
        $carne = $this->request->getSession()->read('id');
        $rolActual = $seguridad->getRol($carne);
        if ($carne != ''){
            $resultado = $seguridad->getPermiso($carne,21);
            if($resultado != 1 && $rolActual != 1){
                return $this->redirect(['controller' => 'Inicio','action' => 'fail']);
            }
        }
        else{
            return $this->redirect(['controller' => 'Inicio','action' => 'fail']);
        }
        /*Cierra la seguridad*/
        $datosSolicitud = $this->Solicitudes->getSolicitudCompleta($id);
        $datosRequisitosSolicitud = $this->Solicitudes->getRequisitosSolicitud($id);
        $solicitude = $this->Solicitudes->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $solicitude = $this->Solicitudes->patchEntity($solicitude, $this->request->getData());
            $data = $this->request->getData();

            if ($this->Solicitudes->save($solicitude)) {
                foreach ($datosRequisitosSolicitud as $requisitosSolicitud):
                    if ($data[$requisitosSolicitud['requisito_id']] == '') {
                        $data[$requisitosSolicitud['requisito_id']] = $requisitosSolicitud['tiene_condicion'];
                    }
                    $this->Solicitudes->setCondicionTiene($solicitude['id'], $requisitosSolicitud['requisito_id'], $data[$requisitosSolicitud['requisito_id']]);
                endforeach;
                if ($datosSolicitud[0]['solicitud_promedio'] != $solicitude['promedio']){
                    $this->Solicitudes->setPromedio($solicitude['promedio'], $solicitude['grupos_id'], $solicitude['usuarios_id']);
                }
                if ($datosSolicitud[0]['solicitud_estado'] != $solicitude['promedio']){
                    $this->sendMail($id);
                }
                $this->Flash->success(__('La solicitud ha sido revisada.'));
                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('La solicitud no se ha podido revisar. Por favor intente de nuevo.'));
        }
        $this->set(compact('solicitude','datosSolicitud','datosRequisitosSolicitud'));
    }

    public function revisarAsistente($id = null)
    {
        /*Inicia seguridad*/
        $seguridad = $this->loadModel('Seguridad');
        $carne = $this->request->getSession()->read('id');
        $rolActual = $seguridad->getRol($carne);
        if ($carne != ''){
            $resultado = $seguridad->getPermiso($carne,21);
            if($resultado != 1 && $rolActual != 2){
                return $this->redirect(['controller' => 'Inicio','action' => 'fail']);
            }
        }
        else{
            return $this->redirect(['controller' => 'Inicio','action' => 'fail']);
        }
        /*Cierra la seguridad*/
        $datosSolicitud = $this->Solicitudes->getSolicitudCompleta($id);
        $datosRequisitosSolicitud = $this->Solicitudes->getRequisitosSolicitud($id);
        $solicitude = $this->Solicitudes->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $solicitude = $this->Solicitudes->patchEntity($solicitude, $this->request->getData());
            $data = $this->request->getData();
            $solicitude['estado'] = 'Pendiente - Administrador';

            if ($this->Solicitudes->save($solicitude)) {
                foreach ($datosRequisitosSolicitud as $requisitosSolicitud):
                    if ($data[$requisitosSolicitud['requisito_id']] == '') {
                        $data[$requisitosSolicitud['requisito_id']] = $requisitosSolicitud['tiene_condicion'];
                    }
                    $this->Solicitudes->setCondicionTiene($solicitude['id'], $requisitosSolicitud['requisito_id'], $data[$requisitosSolicitud['requisito_id']]);
                endforeach;

                $this->Flash->success(__('La solicitud ha sido revisada.'));
                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('La solicitud no se ha podido revisar. Por favor intente de nuevo.'));
        }
        $this->set(compact('solicitude','datosSolicitud','datosRequisitosSolicitud'));
    }
    /**
     * View method
     *
     * @param string|null $id Solicitude id.
     * @return \Cake\Http\Response|void
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
     public function view($id = null){
       
        $username = $this->Getrequest()->getSession()->read('id'); //obtiene el nombre de usuario actualmente logueado
        
       
        /*Inicia seguridad*/
        $seguridad = $this->loadModel('Seguridad');
        $carne = $this->request->getSession()->read('id');
        if ($carne != ''){
            $rol = $seguridad->getRol($carne);
            $resultado = $seguridad->getPermiso($carne,13);
            if($resultado != 1){//Se pregunta por el permiso
                return $this->redirect(['controller' => 'Inicio','action' => 'fail']);
            }
            if(4 == $rol){
                $usuarios = $this->loadModel('Usuarios');
                $usuarioActual = $usuarios->getUsuariosId($id);
                $idActual = $this->Solicitudes->getIDUsuario($carne);
                if($usuarioActual != $idActual[0][0]){
                    return $this->redirect(['controller' => 'Inicio','action' => 'fail']);
                }
            else if (3 == $rol){
                $idActual = $this->Solicitudes->getIDUsuario($carne);
                $idProfe = $idActual[0][0];
                $idProfeSolicitud = $this->Solicitudes->getIdProfeSolicitud($id);
                if($idProfe != $idProfeSolicitud){
                    return $this->redirect(['controller' => 'Inicio','action' => 'fail']);
                }
            }
            }
        }
        else{
            return $this->redirect(['controller' => 'Inicio','action' => 'fail']);

        }
        /*Cierra la seguridad*/
       
        $solicitude = $this->Solicitudes->get($id, [
            'contain' => ['Usuarios', 'Grupos']
        ]);
        
        $idActual = $this->Solicitudes->getIDUsuario($username); //obtiene el id de usuario actualmente logueado
        $todo = $this->Solicitudes->getViewValuesUsuario($id);//obtiene los datos de la solicitud para la vista
        $this->set('todo',$todo);
        $this->set('solicitude', $solicitude);
    }
    public function imprimir($id = null){

        /*Inicia seguridad*/
        $seguridad = $this->loadModel('Seguridad');
        $carne = $this->request->getSession()->read('id');
        $rolActual = $seguridad->getRol($carne);
        if ($carne != ''){
            $resultado = $seguridad->getPermiso($carne,25);
            if($resultado != 1){
                return $this->redirect(['controller' => 'Inicio','action' => 'fail']);
            }
        }
        else{
            return $this->redirect(['controller' => 'Inicio','action' => 'fail']);
        }
        /*Cierra la seguridad*/
        $this->layout = 'None';
        $solicitude = $this->Solicitudes->get($id, [
            'contain' => ['Usuarios', 'Grupos']
        ]);
        $curso = $this->Solicitudes->getCurso($solicitude->id);
        $this->set('solicitude', $solicitude);
        $this->set('curso', $curso);
    }
    public function get_round()
    {
      return $this->Solicitudes->getRonda(); 
    }

    public function get_contador_horas()
    {
      return $this->Solicitudes->getContadorHoras(); 
    }

    public function get_estado_ronda(){
        $ronda = $this->get_round();
        $today = Date::today();
        $inic = new Date($ronda['fecha_inicial']);
        $fin = new Date($ronda['fecha_final']);
        $est = $today->between($inic, $fin) ;
        return $est;
    }
    public function get_year()
    {
        //Se trae la ronda actusl
        $round = $this->get_round();
        $roundNumber = $round['numero'];
        /*Se obtiene la fecha final para sacar el año*/
        $r = $round['fecha_final'];
        /*Se concatena el año, siempre son 4 caracteres*/
        $año = $r[0].$r[1].$r[2].$r[3];
  
      return $año;
    }
    public function get_semester()
    {
        //Se trae la ronda actusl
        $round = $this->get_round();
        $roundNumber = $round['numero'];
        /*Se obtiene la fecha final para sacar el mes*/
        $r = $round['fecha_final'];
      
        /*Se obtiene el mes de la ronda*/
        $m = $r[5].$r[6];
        /*Cómo la ronda no indica cual semestre es el actual la única forma de sacarlo es comparando las fecha actual, si es Junio o antes es el semestre 1, en caso contrario es semestre 2
        En julio se pueden empezar a pedir asistencias del segundo semestre?*/
        if ($m <= 6){
          $semestre = 1;
        } else {
          $semestre = 2;
        }
  
      return $semestre;
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
        if($carne != ''){
           $resultado = $seguridad->getPermiso($carne,15);
           if($resultado != 1){
              return $this->redirect(['controller' => 'Inicio','action' => 'fail']);
           }
        }
        else{
           return $this->redirect(['controller' => 'Inicio','action' => 'fail']);
        }
        /*Cierra la seguridad*/

        $solicitude = $this->Solicitudes->newEntity();
        if ($this->request->is('post')) {
            $solicitude = $this->Solicitudes->patchEntity($solicitude, $this->request->getData());
            //Se cambian los 0 y 1 que manda el checkbox por Sí o No
            if($solicitude->horas_asistente == 0){ 
              $solicitude->horas_asistente = 'No';
            } else {
              $solicitude->horas_asistente = 'Sí';
            }
            if($solicitude->horas_estudiante == 0){ 
              $solicitude->horas_estudiante = 'No';
            } else {
              $solicitude->horas_estudiante = 'Sí';
            }
            if($solicitude->asistencia_externa == 0){ 
              $solicitude->asistencia_externa = 'No';
            } else {
              $solicitude->asistencia_externa = 'Sí';
            }
            if($solicitude->horas_asistente_externa == 0){ 
              $solicitude->horas_asistente_externa = 'No';
            } else {
              $solicitude->horas_asistente_externa = 'Sí';
            }
            if($solicitude->horas_estudiante_externa == 0){ 
              $solicitude->horas_estudiante_externa = 'No';
            } else {
              $solicitude->horas_estudiante_externa = 'Sí';
            }            
            /*En caso de que el estudiante no digite nada en la cantidad de horas externas entonces se guarda un 0 en lugar de null*/
            if($solicitude->cantidad_horas_externa == null){ 
              $solicitude->cantidad_horas_externa = 0;
            }
            /*En caso de que el usuario deje la opción de "Seleccionar Grupo marcada, es decir no escoja grupo o curso*/
            if($solicitude->grupos_id == null){ 
              $this->Flash->error(__('La solicitud no se ha podido agregar. Por favor seleccione un curso y grupo válido.'));
              return $this->redirect(['action' => 'add']);
            }
            if ($this->Solicitudes->save($solicitude)) {
                $this->Flash->success(__('La solicitud ha sido agregada. Debe imprimir la solicitud y presentarla en Secretaría, de lo contrario no será válida.'));
                return $this->redirect(['action' => 'view', $solicitude->id]);
            }
            $this->Flash->error(__('La solicitud no se ha podido agregar. Por favor intente de nuevo.'));
        }
        //Funcionalidad Solicitada: Agregar datos del usuario
        /*Se obtiene el carné de la persona que inició sesión*/
        $username = $this->request->getSession()->read('id');
        //En base al carnet del estudiante actual, se trae la tupla de usuario respectiva a ese estudiante
        $datosEstudiante = $this->Solicitudes->getStudentInfo($username);
        //Las keys de los arrays deben corresponder al nombre del campo de la tabla que almacene los usuarios
        $idEstudiante = $datosEstudiante['id'];
        $nombreEstudiante = $datosEstudiante['nombre'];
        $primerApellidoEstudiante = $datosEstudiante['primer_apellido'];
        $segundoApellidoEstudiante = $datosEstudiante['segundo_apellido'];
        $correoEstudiante = $datosEstudiante['correo'];
        $telefonoEstudiante = $datosEstudiante['telefono'];
        $cedulaEstudiante = $datosEstudiante['identificacion'];
        //Se trae la ronda actual
        $round = $this->get_round();
        $roundNumber = $round['numero'];
        //Se trae el año actual
        $año = $this->get_year();
        //Se trae el semestre al cual se requiere solicitar asistencia
        $semestre = $this->get_semester();
      
        $nombre;
       
        $course = array();
        $classes;
        //Se trae todos los grupos del semestre y año actual de la base de datos y los almacena en un vector
        $datosGrupos = $this->Solicitudes->getGrupos($idEstudiante, $semestre, $año);
        if ($datosGrupos != null){
          $aux;             
          $i = 0;
          $course_counter = 0; 
          foreach($datosGrupos as $g)
          {         
            $class[$i] = $g['numero']; //Se trae el número de clase
            $code[$i] = $g['sigla']; //Se trae el nombre de curso. Esto es para que cuando se seleccione un grupo se pueda encontrar sus grupos sin necesidad de realizar un acceso adicional a la base de datos. Recomendado por Diego
            $course[$i] = $g['cursos_id'];  //id de los cursos
            $auto[$i] = $g['id']; //id de los grupos
                                                  
            //Busca los cursos y los coloca solo 1 vez en el vector de cursos.
            //Realiza la busqueda en base al codigo de curso, ya que al ser más corto entonces la busqueda será más eficiente
            $encontrado = 0;
            for($j = 0; $j < $course_counter && $encontrado == 0; $j = $j+1)
            {
              if(strcmp($aux[$j]['id'],$g['cursos_id']) == 0)
              $encontrado = 1;
            }
                  
            if($encontrado == 0)
            {
              $aux[$course_counter] = array();
              $aux[$course_counter]['id'] = $g['cursos_id'];
              $aux[$course_counter]['nombre'] = $g['nombre'];
              $aux[$course_counter]['sigla'] = $g['sigla'];  
              $course_counter = $course_counter + 1;
            }
                                      
              $i = $i + 1;
          }
          //Poner esta etiqueta en el primer campo es obligatorio, para asi obligar al usuario a seleccionar un grupo y asi se pueda
          //activar el evento onChange del select de grupos
          $i = 0;
          //Esta parte se encarga de controlar los codigos y nombres de cursos
          //Llama a la función encargada de traerse el codigo y nombre de cada curso en el sistema
              
              
          $c2[0] = "Seleccione un Curso"; 
          foreach($aux as $c) //Recorre cada tupla de curso
          {
            //Dado que la primer opcion ya tiene un valor por default, los campos deben modifcar el valor proximo a i   
            $c2[$i+1] = $c['sigla']; //Almacena el codigo de curso
            $nombre[$i+1] = $c['nombre']; //Almacena el nombre del curso
            $i = $i + 1;
                  
          }
          $anygroupsleft = true; 
      } else {
          $anygroupsleft = false; //En caso de que el estudiante haya pedido asistencia en todos los grupos, se muestra un mensaje de que ya no hay más grupos disponibles
      }
      $this->set(compact('solicitude', 'c2', 'class', 'course', 'nombre', 'code', 'auto', 'roundNumber', 'nombreEstudiante', 'primerApellidoEstudiante', 'segundoApellidoEstudiante', 'correoEstudiante', 'telefonoEstudiante', 'cedulaEstudiante', 'idEstudiante', 'username', 'anygroupsleft'));
    }
    
    /**
     * Delete method
     *
     * @param string|null $id Solicitude id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $solicitude = $this->Solicitudes->get($id);
        if ($this->Solicitudes->delete($solicitude)) {
            $this->Flash->success(__('La solicitud ha sido eliminada.'));
        } else {
            $this->Flash->error(__('La solicitud no se ha podido eliminar. Por favor intente de nuevo.'));
        }
        return $this->redirect(['action' => 'index']);
    }
    public function obtenerProfesor()
    {
      $curso = $_GET['curso'];
      $grupo = $_GET['grupo'];
      $semestre = $this->get_semester();
      $year = $this->get_year();
      $profesor = $this->Solicitudes->getTeacher($curso, $grupo, $semestre, $year);
        
      foreach($profesor as $p) {
        print_r($p);
      }       
      $this->autoRender = false ;       
    }
    public function obtenerGrupoID()
    {
      $curso = $_GET['curso'];
      $grupo = $_GET['grupo'];
      $semestre = $this->get_semester();
      $year = $this->get_year();
      $idGrupo = $this->Solicitudes->getIDGrupo($curso, $grupo, $semestre, $year);
        
      foreach($idGrupo as $p) {
        print_r($p);
      }    
      $this->autoRender = false ;
      
             
    }
    public function viewFile($filename) {
        $this->viewBuilder()
            ->className('Dompdf.Pdf')
            ->layout('Dompdf.default')
            ->options(['config' => [
                'filename' => $filename,
                'render' => 'browser',
            ]]);
    }

    //Grupos sin asistente que se deben asignar
    public function grupoAsignar(){
     

        /*Inicia seguridad*/
        $seguridad = $this->loadModel('Seguridad');
        $carne = $this->request->getSession()->read('id');
        if($carne != ''){
           $resultado = $seguridad->getPermiso($carne,21);
           if($resultado != 1){
              return $this->redirect(['controller' => 'Inicio','action' => 'fail']);
           }
        }
        else{
           return $this->redirect(['controller' => 'Inicio','action' => 'fail']);
        }
        /*Cierra la seguridad*/

        $semestre = $this->get_semester(); //obtiene el semestre actual
        $año = $this->get_year(); //obtiene el año actual
        $tabla = $this->Solicitudes->getGruposSinAsignar($semestre,$año); //Grupos sin asistente asignado
        $this->set(compact('tabla'));
    }

    //Asignación de un asistente a un grupo
    public function asignarAsistente($sigla,$numGrupo,$profe = '',$grupoId){
       
         /*Inicia seguridad*/
         $seguridad = $this->loadModel('Seguridad');
         $carne = $this->request->getSession()->read('id');
         if($carne != ''){
            $resultado = $seguridad->getPermiso($carne,21);
            if($resultado != 1){
               return $this->redirect(['controller' => 'Inicio','action' => 'fail']);
            }
         }
         else{
            return $this->redirect(['controller' => 'Inicio','action' => 'fail']);
         }
         /*Cierra la seguridad*/

        $contadorHoras = $this->get_contador_horas();

       
        $estudiantesNombres= array();               //Guarda los nombres de estudiantes
        $estudiantesIds=array();                    //Guarda los ids de los estudiantes de arriba
        $horasEstudiante = array();                 //Guarda las HE de cada estudiante segun el orden de la tabla
        $horasAsistente = array();                  //Guarda las HA de cada estudiante segun el orden de la tabla
        $idSolicitud = array();                     //Guarda los ids de las solicitudes elegibles para dicho grpo
        $requisitosInopia = array();                //Guarda los requisitos asociados a la solicitud
        $requisitosAsistenteReprobados = array();   //Guarda los requisitos de categoría asistente que estén en "No"


        $dropInfo = $this->Solicitudes->getEstudiantesGrupoAsistencia($grupoId); //Carga nombres y id de estudiantes
        $i = 0;//Iterador para encontrar las horas de cada estudiante

        foreach ($dropInfo as $key => $value) { //Llena cada vector con las colmnas de la tabla anterior
            array_push($estudiantesNombres, $value['nombre']);
            array_push($estudiantesIds, $value['id']);
            array_push($idSolicitud, $value['sol_id']);

            $horasAux = $this->Solicitudes->getHorasEstudiante($estudiantesIds[$i],$grupoId); //Horas estudiante de X estudiante
            array_push($horasEstudiante,$horasAux);

            $horasAux = $this->Solicitudes->getHorasAsistente($estudiantesIds[$i],$grupoId); //Horas asistente de X estudiante
            array_push($horasAsistente,$horasAux);

            $reqAux = $this->Solicitudes->getRequisitosAsistenteReprobados($idSolicitud[$i]);
            array_push($requisitosAsistenteReprobados,$reqAux);
            $i++;
        }

        if ($this->request->is(['patch', 'post', 'put'])) {
            $data = $this->request->getData(); //data es un solo vector, hay que recorrerlo con iterador? los campos no están en [0] sino en ['Estado23'] o [TipoHoras23]
            $i = 0;                             //Itera sobre todos los estudiantes
            $end = count($idSolicitud);         //Cantidad de estudiantes
           
            while($i < $end){
                if ($data["Estado".$estudiantesIds[$i]] == 'Rechazada - Profesor'){ //Actualiza el estado de la Solicitud del como Rechazada
                    $this->Solicitudes->setSolicitudRechazada($idSolicitud[$i]);
                }
                else{

                    $horas = $data["Horas".$estudiantesIds[$i]]; //Las horas que se quieren asignar                          

                    
                        $valido = false; //Para verificar si lo que se quiere asignar es valido o no

                        $error = '';

                        $horasA = $this->Solicitudes->getHorasAsistente($estudiantesIds[$i],$grupoId); //Horas que ya tiene
                        $horasE = $this->Solicitudes->getHorasEstudiante($estudiantesIds[$i],$grupoId);
                        $horasTotal = $horasA + $horasE;                       


                        if($horasTotal < 20){ //Si el total de horas que ya tiene es menor que el limite, se le pueden asignar

                            $maxE = 12 - $horasE; //Maximo de horas que se le puede asignar
                            $maxA = 20 - $horasTotal;

                           // $minE = $horasE > 0 ? 1 : 3;//Minimo de horas que se le puede asignar
                            //$minA = $horasA > 0 ? 1 : 3;

                            $min = $horasTotal > 3 ? 1 : 3;

                            $contHA = $contadorHoras['horas_asistente'];
                            $contHEE= $contadorHoras['horas_estudiante_ecci'];
                            $contHED= $contadorHoras['horas_estudiante_docente'];

                            if($data["TipoHora".$estudiantesIds[$i]] == 'Asistente'){
                                if($contHA >= $min ){  //Si hay horas disponibles
                                    $maxA = $maxA > $contHA ? $contHA : $maxA; // Evalua el maximo de horas con el contador
                                    $min = $min > $contHA ? $contHA : $min;
                                    if($horas <= $maxA  && $horas >= $min){$valido = true;}else{$error = "valor debe estar en rango [".$min.",".$maxA."]";}  //Si las horas no superan el limite son validas
                                }else{$error = 'no hay horas asistente disponibles o el valor ingresado es menor que '.$min;}
                            }
                            else if ($maxE > 0){ // Si se le pueden asignar horas estudiante
                                if($data["TipoHora".$estudiantesIds[$i]] == 'Estudiante ECCI'){
                                    if($contHEE >= $min){ // Si hay horas disponibles
                                        $maxE = $maxE > $contHEE ? $contHEE : $maxE;// Evalua el maximo de horas por contador
                                        if($horasA > 0){ //Si tiene horas asistente vuelve a evaluar el maximo
                                            $maxE = $maxE > $maxA ? $maxA : $maxE;
                                        }
                                        $min = $min > $contHEE ? $contHEE : $min;
                                        if($horas <= $maxE && $horas >= $min){$valido = true;}else{$error = "valor debe estar en rango [".$min.", ".$maxE."]";} //Si las horas no superan el limite son validas
                                    }else{$error = 'no hay horas estudiante ecci disponibles o el valor ingresado es menor que '.$min;}
                                }
                                else{
                                    if($contHED >= $min){ // Si hay horas disponibles
                                        $maxE = $maxE > $contHED ? $contHED : $maxE;// Evalua el maximo de horas por contador
                                        if($horasA > 0){ //Si tiene horas asistente vuelve a evaluar el maximo
                                            $maxE = $maxE > $maxA ? $maxA : $maxE;
                                        }
                                        $min = $min > $contHED ? $contHED : $min;
                                        if($horas <= $maxE && $horas >= $min){$valido = true;}else{$error = "valor debe estar en rango [".$min.",".$maxE."]";} //Si las horas no superan el limite son validas
                                    }else{$error = 'no hay horas estudiante docente disponibles o el valor ingresado es menor que '.$min;}
                                }
                            }
                        }

                        if(!$valido){ //Si no es valido hubo un error en las Horas asignadas
                            $this->Flash->error(__('Hubo un error: '.$error. '. Por favor intente de nuevo.'));

                            //redirige a la misma pantalla
                            return $this->redirect(['action' => 'asignarAsistente', $sigla, $numGrupo, $profe, $grupoId]);
                        }
                                      
                    //Agregar al estudiante a la tabla de Aceptados .
                    $this->Solicitudes->setAceptados($idSolicitud[$i], $data["Horas".$estudiantesIds[$i]], $data["TipoHora".$estudiantesIds[$i]]);  //Se agrega la solicitut del estudiante entre las aceptadas

                    //Verificar si fue dada la asistencia por inopia
                    if ($data["TipoHora".$estudiantesIds[$i]] == 'Asistente'){
                        //Consulta por inopia en ASISTENTE
                        $inopia = $this->Solicitudes->InopiaAsistente($idSolicitud[$i]);   
                    }
                    else{
                        //Consulta por inopia en ESTUDIANTE
                        $inopia = $this->Solicitudes->InopiaEstudiante($idSolicitud[$i]);
                    }

                    if($inopia){
                        $this->Solicitudes->setEstadoSolicitud($idSolicitud[$i],'Aceptada - Profesor (Inopia)');
                    }
                    else{
                        $this->Solicitudes->setEstadoSolicitud($idSolicitud[$i],'Aceptada - Profesor');
                    }

                }
                $this->sendMail($idSolicitud[$i]);
                $i++;
            }
            $this->Flash->success(__('Se han guardado los cambios para el grupo'));
            return $this->redirect(['action' => 'grupoAsignar']);
        }

        $this->set('idEstudiante',$estudiantesIds);
        $this->set('estudiantes', $estudiantesNombres);
        $this->set('idSolicitud',$idSolicitud);
        $this->set('reqInopia',$requisitosInopia);
        $this->set('reqReprobados',$requisitosAsistenteReprobados);
        $this->set('horasE',$horasEstudiante);
        $this->set('horasA',$horasAsistente);
        $this->set(compact('sigla','numGrupo','profe','grupoId', 'contadorHoras'));

    }
        /***********************************************************************************************************/
        /*Vista previa a generara un reporte en excel del historico de asistencias*/
    public function reporte(){

        /*Inicia seguridad*/
        $seguridad = $this->loadModel('Seguridad');
        $carne = $this->request->getSession()->read('id');
        $rolActual = $seguridad->getRol($carne);
        if ($carne != ''){
            $resultado = $seguridad->getPermiso($carne,24);
            if($resultado != 1){
                return $this->redirect(['controller' => 'Inicio','action' => 'fail']);
            }
        }
        else{
            return $this->redirect(['controller' => 'Inicio','action' => 'fail']);
        }
        /*Cierra la seguridad*/

        //datos para la vista previa en genera y beneratodo
        $solicitude = $this->Solicitudes->newEntity();

        //Se guardar las siglas y Ids de los estudiantes con solicitudes aceptadas para usarlos en la vista donde se seleecionara algun estudiante
        $carnetId = $this->Solicitudes->getCarnetId();
        $carnet=array(); //vector para guardad los carnet de estudiantes que han sido asistentes
        $Ids=array(); //vector para guardad los id de estudiantes que han sido asistentes
        foreach ($carnetId as $key => $value) {
          array_push($carnet, $value['nombre_usuario']);
          array_push($Ids, $value['usuarios_id']);
        }

        if ($this->request->is('post')) {          
            $data = $this->request->getData();           
            $ronda = $data['Ronda'];
            if ($ronda == 0){
                $id = $data['Carné'];
                return $this->redirect(['action' => 'genera', $Ids[$id]]);
            } else {
                return $this->redirect(['action' => 'generaRonda', $ronda]);
            }
        }

        $this->set(compact('carnet', 'solicitude', 'ronda'));
    }

    /*Creación del excel con el total de solicitudes de un estudiante en especifico*/
    public function genera($id = null){

        $solicitude = $this->Solicitudes->newEntity();

        if ($this->request->is('post')) {
            
            $solicitude = $this->Solicitudes->patchEntity($solicitude, $this->request->getData());

            $info = $this->Solicitudes->getHistorialExcelEstudiante($id); //Se trae la informacion que se agrega al excel segun el id del estudiante
            $spreadsheet = new Spreadsheet(); //para usar excel

            //acceder al objeto hoja
            $sheet = $spreadsheet->getActiveSheet();           

            /*Encabezados de las columnas*/
            $sheet->setCellValue('A1', 'Curso');
            $sheet->setCellValue('B1', 'Sigla');
            $sheet->setCellValue('C1', 'Grupo');
            $sheet->setCellValue('D1', 'Profesor');
            $sheet->setCellValue('E1', 'Carné');
            $sheet->setCellValue('F1', 'Nombre');
            $sheet->setCellValue('G1', 'Tipo Horas');
            $sheet->setCellValue('H1', 'Cantidad');

            /*Se agrega la informacion a las filas y columnas del excel*/
            $i = 0; //indice en el vector de la asistencia que se esta llenando
            $fila = 2; //indice de la fila en el excel
            foreach ($info as $data) {
                $sheet->setCellValueByColumnAndRow(1, $fila, $info[$i]['nombre']);
                $sheet->setCellValueByColumnAndRow(2, $fila, $info[$i]['sigla']);
                $sheet->setCellValueByColumnAndRow(3, $fila, $info[$i]['numero']);
                $sheet->setCellValueByColumnAndRow(4, $fila, $info[$i]['profesor']);
                $sheet->setCellValueByColumnAndRow(5, $fila, $info[$i]['nombre_usuario']);
                $sheet->setCellValueByColumnAndRow(6, $fila, $info[$i]['estudiante']);
                $sheet->setCellValueByColumnAndRow(7, $fila, $info[$i]['tipo_horas']);
                $sheet->setCellValueByColumnAndRow(8, $fila, $info[$i]['cantidad_horas']);

                $i = $i + 1;
                $fila = $fila + 1;
            }    

            $writer = new Xls($spreadsheet);
            $nombreArchivo='Reporte_'.$info[0]['nombre_usuario'].'.xls'; //Nombre para el documento segun el estudiante con formato tipo: Reporte_carnet.xls 

            /*Descarga el archivo en la carpeta descargas independientemente de la computadora o usuario*/
            try{
                $sheet->getDefaultColumnDimension()->setWidth(20);
                header('Content-Type: application/vnd.ms-excel');
                header('Content-Disposition: attachment;filename="'. $nombreArchivo);
                header('Cache-Control: max-age=0');
        
                $writer->save('php://output');
            }
            catch(Exception $e){
                echo $e->getMessage();
            }      
            
        }
    
        /*Se envia la indormacion a genera para crear la vista previa de la tabla*/
        $todo = $this->Solicitudes->getHistorialExcelEstudiante($id);
        $this->set(compact('todo', 'solicitude'));
    }

      /*Creacion del excel con el historico de asistencias*/
      public function generatodo(){
        $solicitude = $this->Solicitudes->newEntity();
        if ($this->request->is('post')) {
            $solicitude = $this->Solicitudes->patchEntity($solicitude, $this->request->getData());
            $info = $this->Solicitudes->getHistorialExcelEstudianteTodo(); //Se trae la informacion que se agrega al excel com todas las asistencias de la historia
            $spreadsheet = new Spreadsheet(); //para usar excel

            //acceder al objeto hoja
            $sheet = $spreadsheet->getActiveSheet();           

            /*Encabezados de las columnas*/
            $sheet->setCellValue('A1', 'Curso');
            $sheet->setCellValue('B1', 'Sigla');
            $sheet->setCellValue('C1', 'Grupo');
            $sheet->setCellValue('D1', 'Profesor');
            $sheet->setCellValue('E1', 'Carné');
            $sheet->setCellValue('F1', 'Nombre');
            $sheet->setCellValue('G1', 'Tipo Horas');
            $sheet->setCellValue('H1', 'Cantidad');

            /*Se agrega la informacion a las filas y columnas del excel*/
            $i = 0; //indice en el vector de la asistencia que se esta llenando
            $fila = 2; //indice de la fila en el excel
            foreach ($info as $data) {
                $sheet->setCellValueByColumnAndRow(1, $fila, $info[$i]['nombre']);
                $sheet->setCellValueByColumnAndRow(2, $fila, $info[$i]['sigla']);
                $sheet->setCellValueByColumnAndRow(3, $fila, $info[$i]['numero']);
                $sheet->setCellValueByColumnAndRow(4, $fila, $info[$i]['profesor']);
                $sheet->setCellValueByColumnAndRow(5, $fila, $info[$i]['nombre_usuario']);
                $sheet->setCellValueByColumnAndRow(6, $fila, $info[$i]['estudiante']);
                $sheet->setCellValueByColumnAndRow(7, $fila, $info[$i]['tipo_horas']);
                $sheet->setCellValueByColumnAndRow(8, $fila, $info[$i]['cantidad_horas']);

                $i = $i + 1;
                $fila = $fila + 1;
            }          

            $writer = new Xls($spreadsheet);

            /*Descarga el archivo en la carpeta descargas independientemente de la computadora o usuario*/
            try{
                $sheet->getDefaultColumnDimension()->setWidth(20);
                header('Content-Type: application/vnd.ms-excel');
                header('Content-Disposition: attachment;filename="'. "Reporte Historico" .'.xls"');
                header('Cache-Control: max-age=0');
        
                $writer->save('php://output');
            }
            catch(Exception $e){
                echo $e->getMessage();
            }
            
        }
    
        /*Se envia la indormacion a generatodo para crear la vista previa de la tabla*/
        $todo = $this->Solicitudes->getHistorialExcelEstudianteTodo();
        $this->set(compact('todo', 'solicitude'));
    }


    /***************Fin genera Excel historico y estudiante**************/ 

    public function generaRonda($ronda = null){
        
        /*Inicia seguridad*/
        $seguridad = $this->loadModel('Seguridad');
        $carne = $this->request->getSession()->read('id');
        $rolActual = $seguridad->getRol($carne);
        if ($carne != ''){
            $resultado = $seguridad->getPermiso($carne,24);
            if($resultado != 1){
                return $this->redirect(['controller' => 'Inicio','action' => 'fail']);
            }
        }
        else{
            return $this->redirect(['controller' => 'Inicio','action' => 'fail']);
        }
        /*Cierra la seguridad*/
        $solicitude = $this->Solicitudes->newEntity();

        if ($this->request->is('post')) {
            
            $solicitude = $this->Solicitudes->patchEntity($solicitude, $this->request->getData());        
            $info = $this->Solicitudes->getHistorialExcelRonda($ronda);       

            //libro de trabajo
            $spreadsheet = new Spreadsheet();

            //acceder al objeto hoja
            $sheet = $spreadsheet->getActiveSheet();           

            /*Encabezados de las columnas*/
            $sheet->setCellValue('A1', 'Curso');
            $sheet->setCellValue('B1', 'Sigla');
            $sheet->setCellValue('C1', 'Grupo');
            $sheet->setCellValue('D1', 'Profesor');
            $sheet->setCellValue('E1', 'Carné');
            $sheet->setCellValue('F1', 'Nombre');
            $sheet->setCellValue('G1', 'Tipo Horas');
            $sheet->setCellValue('H1', 'Cantidad');

            $i = 0;
            $fila = 2;
            foreach ($info as $data) {
                //$sheet->setCellValue('A2', $info[$i]['nombre']);
                $sheet->setCellValueByColumnAndRow(1, $fila, $info[$i]['nombre']);
                $sheet->setCellValueByColumnAndRow(2, $fila, $info[$i]['sigla']);
                $sheet->setCellValueByColumnAndRow(3, $fila, $info[$i]['numero']);
                $sheet->setCellValueByColumnAndRow(4, $fila, $info[$i]['profesor']);
                $sheet->setCellValueByColumnAndRow(5, $fila, $info[$i]['nombre_usuario']);
                $sheet->setCellValueByColumnAndRow(6, $fila, $info[$i]['estudiante']);
                $sheet->setCellValueByColumnAndRow(7, $fila, $info[$i]['tipo_horas']);
                $sheet->setCellValueByColumnAndRow(8, $fila, $info[$i]['cantidad_horas']);

                $i = $i + 1;
                $fila = $fila + 1;
            }          

            //$writer = new Xlsx($spreadsheet);
            $writer = new Xls($spreadsheet);

            try{
                //$writer->save($ruta/*.'librotest.xlsx'*/);
        
                //Descarga el archivo excel
                $sheet->getDefaultColumnDimension()->setWidth(20);
                header('Content-Type: application/vnd.ms-excel');
                header('Content-Disposition: attachment;filename="'. "Reporte de Ronda ".$ronda.'.xls"'); /*-- $filename is  xsl filename ---*/
                header('Cache-Control: max-age=0');
        
                $writer->save('php://output');
                //echo "Archivo Creado";
            }
            catch(Exception $e){
                echo $e->getMessage();
            }
            
        }
    
        $todo = $this->Solicitudes->getHistorialExcelRonda($ronda);
        $this->set(compact('todo', 'solicitude', 'ronda'));
    }

    public function generaCiclo(){
        
        /*Inicia seguridad*/
        $seguridad = $this->loadModel('Seguridad');
        $carne = $this->request->getSession()->read('id');
        $rolActual = $seguridad->getRol($carne);
        if ($carne != ''){
            $resultado = $seguridad->getPermiso($carne,24);
            if($resultado != 1){
                return $this->redirect(['controller' => 'Inicio','action' => 'fail']);
            }
        }
        else{
            return $this->redirect(['controller' => 'Inicio','action' => 'fail']);
        }
        /*Cierra la seguridad*/
        $solicitude = $this->Solicitudes->newEntity();

        if ($this->request->is('post')) {
            
            $solicitude = $this->Solicitudes->patchEntity($solicitude, $this->request->getData());       
            $semestre = $this->get_semester(); //obtiene el semestre actual
            $año = $this->get_year(); //obtiene el año actual           
            $info = $this->Solicitudes->getHistorialExcelCiclo($semestre, $año); 

            //libro de trabajo
            $spreadsheet = new Spreadsheet();

            //acceder al objeto hoja
            $sheet = $spreadsheet->getActiveSheet();           

            /*Encabezados de las columnas*/
            $sheet->setCellValue('A1', 'Curso');
            $sheet->setCellValue('B1', 'Sigla');
            $sheet->setCellValue('C1', 'Grupo');
            $sheet->setCellValue('D1', 'Profesor');
            $sheet->setCellValue('E1', 'Carné');
            $sheet->setCellValue('F1', 'Nombre');
            $sheet->setCellValue('G1', 'Tipo Horas');
            $sheet->setCellValue('H1', 'Cantidad');

            $i = 0;
            $fila = 2;
            foreach ($info as $data) {
                //$sheet->setCellValue('A2', $info[$i]['nombre']);
                $sheet->setCellValueByColumnAndRow(1, $fila, $info[$i]['nombre']);
                $sheet->setCellValueByColumnAndRow(2, $fila, $info[$i]['sigla']);
                $sheet->setCellValueByColumnAndRow(3, $fila, $info[$i]['numero']);
                $sheet->setCellValueByColumnAndRow(4, $fila, $info[$i]['profesor']);
                $sheet->setCellValueByColumnAndRow(5, $fila, $info[$i]['nombre_usuario']);
                $sheet->setCellValueByColumnAndRow(6, $fila, $info[$i]['estudiante']);
                $sheet->setCellValueByColumnAndRow(7, $fila, $info[$i]['tipo_horas']);
                $sheet->setCellValueByColumnAndRow(8, $fila, $info[$i]['cantidad_horas']);

                $i = $i + 1;
                $fila = $fila + 1;
            }          

            $writer = new Xls($spreadsheet);
            $nombreArchivo='Reporte_'.$semestre.'-'.$año.'.xls'; //Nombre para el documento segun el estudiante con formato tipo: Reporte_carnet.xls 

            try{        
                //Descarga el archivo excel
                $sheet->getDefaultColumnDimension()->setWidth(20);
                header('Content-Type: application/vnd.ms-excel');
                header('Content-Disposition: attachment;filename="'. $nombreArchivo); /*-- $filename is  xsl filename ---*/
                header('Cache-Control: max-age=0');
        
                $writer->save('php://output');
            }
            catch(Exception $e){
                echo $e->getMessage();
            }
            
        }

        $semestre = $this->get_semester(); //obtiene el semestre actual
        $año = $this->get_year(); //obtiene el año actual
        $todo = $this->Solicitudes->getHistorialExcelCiclo($semestre, $año);
        $this->set(compact('todo', 'solicitude', 'semestre', 'año'));
    }

    public function reprovedMessage($id)
    {
        $requirements = $this->Solicitudes->getRequisitosIncumplidos($id); //Llama al método que está en el modelo
        $list = ' '; //Inicializa la lista de los requisitos rechazados
        foreach($requirements as $r) //Aquí se van concatenando los requisitos recuperados
        {
            $list .= '
            ' . $r['requisito_nombre'];
        }
        return $list; //Se devuelve la lista de requisitos rechazados del estudiante
    }

    public function sendMail($id)
    {
        //Aquí se obtienen datos de la solicitud, nombre de profesor, curso, grupo y nombre de estudiante, 
        // necesarios para el correo
        $solicitud = $this->Solicitudes->getSolicitudCompleta($id);
        $professor = $solicitud[0]['profesor_nombre'];
        $course = $solicitud[0]['curso_nombre'];
        $group = $solicitud[0]['grupo_numero'];
        $mail = $solicitud[0]['estudiante_correo'];
        $name = $solicitud[0]['estudiante_nombre'] . " " . $solicitud[0]['estudiante_primer_apellido'] . " " . $solicitud[0]['estudiante_segundo_apellido'];
        $state = $solicitud[0]['solicitud_estado'];
        $text = null;

        //Se crea una nueva instancia de correo de cakephp
        $email = new Email();
        $email->transport('email'); //Se debe cambiar 'mailjet' por el nombre de transporte que se puso en config/app.php
        //En todos los mensajes se debe cambiar la parte "correo de contacto" por el correo utilizado para atender dudas con respecto al tema de solicitudes de horas
        //Indica que si el estado es 1, se debe enviar mensaje de estudiante no elegible.
        if($state == 'No Elegible'){
        $list = $this->reprovedMessage($id);
        $text = 'Estudiante ' . $name . ':';
        $text .= "\n" .'
        Por este medio se le comunica que su solicitud de asistencia para el curso ' . $course . ' grupo ' . $group . ' con el profesor(a) ' . $professor . ' fue RECHAZADA debido a que no cumplió el(los) siguiente(s) requisito(s):';
        $text .= "\n" ;
        $text .= '' . $list;
        $text .= '
        
        Por favor no contestar este correo. Cualquier consulta comunicarse con la secretaría de la ECCI al 2511-0000 o asistencias-ecci@gmail.com';
        }
        // Si el estado es 2, se debe enviar mensaje de estudiante rechazado.
        if($state == 'Rechazada'){
        $text = 'Estudiante ' . $name . ':';
        $text .= "\n" .'
        Por este medio se le comunica que su solicitud de asistencia para el curso ' . $course . ' grupo ' . $group . ' con el profesor(a) ' . $professor . ' fue RECHAZADA por el profesor.
        
        Por favor no contestar este correo. Cualquier consulta comunicarse con la secretaría de la ECCI al 2511-0000 o asistencias-ecci@gmail.com';
        }
        //Si el estado es 3, se debe enviar mensaje de estudiante aceptado.
        if($state == 'Aceptada - Profesor'){
        $list = $this->reprovedMessage($id);
        $text = 'Estudiante ' . $name . ':';
        $text .= "\n" .'
        Por este medio se le comunica que su solicitud de asistencia para el curso ' . $course . ' grupo ' . $group . ' con el profesor(a) ' . $professor . ' fue ACEPTADA.
        
        Por favor no contestar este correo. Cualquier consulta comunicarse con la secretaría de la ECCI al 2511-0000 o asistencias-ecci@gmail.com';
        }
        if($state == 'Aceptada - Profesor (Inopia)'){
        $list = $this->reprovedMessage($id);
        $text = 'Estudiante ' . $name . ':';
        $text .= "\n" .'
        Por este medio se le comunica que su solicitud de asistencia para el curso ' . $course . ' grupo ' . $group . ' con el profesor(a) ' . $professor . ' fue ACEPTADA POR INOPIA.
        
        Por favor no contestar este correo. Cualquier consulta comunicarse con la secretaría de la ECCI al 2511-0000 o asistencias-ecci@gmail.com';
        }

        //Despues de poner el pass descomentar esto para empezar a enviar correos
        /*
        if ($text != null){
            //Se envía el correo.
            try {
                $res = $email->from('asistencias.ecci@gmail.com') // Se debe cambiar este correo por el que se usa en config/app.php
                      ->to($mail)
                      ->subject('Resultado del concurso de asistencia')                  
                      ->send($text);
            } catch (Exception $e) {
                echo 'Exception : ',  $e->getMessage(), "\n";
            }
        }
        */
    }

}