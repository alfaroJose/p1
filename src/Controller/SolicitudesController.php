<?php
namespace App\Controller;
use App\Controller\AppController;
use Dompdf\Dompdf;
use Cake\Datasource\ConnectionManager;
use Cake\Chronos\Date;
use Cake\ORM\TableRegistry;

use PhpOffice\PhpSpreadsheet\IOFactory;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Helper;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use Cake\Filesystem\Folder;
use Cake\Filesystem\File;
use Cake\Database\Exception;
require ROOT.DS.'vendor' .DS. 'phpoffice/phpspreadsheet/src/Bootstrap.php';




//Para generar el excel de solicitud

require 'C:\xampp\htdocs\p1\vendor\autoload.php';

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
               
        //Inicio seguridad por URL
        if ($username == ''){//En caso de lo haber hecho login
                return $this->redirect(['controller' => 'Inicio','action' => 'fail']);
        }
        else{
            $rolActual = $this->Solicitudes->getRol($username);  //obtiene el rol de usuario actualmente logueado
            $connect = ConnectionManager::get('default');
            $consulta = "select estado from posee where roles_id = ".$rolActual[0]." and permisos_id = 13;";
            $permiso = $connect->execute($consulta)->fetchAll();
            if ($permiso[0][0] != 1){
                return $this->redirect(['controller' => 'Inicio','action' => 'fail']);
            }
        }
        //Cierra seguridad por URL
             
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
        //$semestre = $this->get_semester(); //obtiene el semestre actual
        //$año = $this->get_year(); //obtiene el año actual
        $username = $this->getRequest()->getSession()->read('id'); //obtiene el nombre de usuario actualmente logueado
               
        //Inicio seguridad por URL
        if ($username == ''){//En caso de lo haber hecho login
                return $this->redirect(['controller' => 'Inicio','action' => 'fail']);
        }
        else{
            $rolActual = $this->Solicitudes->getRol($username);  //obtiene el rol de usuario actualmente logueado
            $connect = ConnectionManager::get('default');
            $consulta = "select estado from posee where roles_id = ".$rolActual[0]." and permisos_id = 13;";
            $permiso = $connect->execute($consulta)->fetchAll();
            if ($permiso[0][0] != 1){
                return $this->redirect(['controller' => 'Inicio','action' => 'fail']);
            }
        }
        //Cierra seguridad por URL
             
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
        //$semestre = $this->get_semester(); //obtiene el semestre actual
        //$año = $this->get_year(); //obtiene el año actual
        $username = $this->getRequest()->getSession()->read('id'); //obtiene el nombre de usuario actualmente logueado
               
        //Inicio seguridad por URL
        if ($username == ''){//En caso de lo haber hecho login
                return $this->redirect(['controller' => 'Inicio','action' => 'fail']);
        }
        else{
            $rolActual = $this->Solicitudes->getRol($username);  //obtiene el rol de usuario actualmente logueado
            $connect = ConnectionManager::get('default');
            $consulta = "select estado from posee where roles_id = ".$rolActual[0]." and permisos_id = 13;";
            $permiso = $connect->execute($consulta)->fetchAll();
            if ($permiso[0][0] != 1){
                return $this->redirect(['controller' => 'Inicio','action' => 'fail']);
            }
        }
        //Cierra seguridad por URL
             
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
               
        //Inicio seguridad por URL
        if ($username == ''){//En caso de lo haber hecho login
                return $this->redirect(['controller' => 'Inicio','action' => 'fail']);
        }
        else{
            $rolActual = $this->Solicitudes->getRol($username);  //obtiene el rol de usuario actualmente logueado
            $connect = ConnectionManager::get('default');
            $consulta = "select estado from posee where roles_id = ".$rolActual[0]." and permisos_id = 13;";
            $permiso = $connect->execute($consulta)->fetchAll();
            if ($permiso[0][0] != 1){
                return $this->redirect(['controller' => 'Inicio','action' => 'fail']);
            }
        }
        //Cierra seguridad por URL
             
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
    
                if ($solicitude['estado'] == 'Aceptada - Profesor (Inopia)' or $solicitude['estado'] == 'Aceptada - Profesor'){
                    $this->Solicitudes->setAceptados($solicitude['id'],$data['aceptados_cantidad_horas'], $data['aceptados_tipo_horas']);
                }
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
        
        //Inicia seguridad
        if (null != $username){ //Si hubo login
            //Rol de quien hizo login
            $rolActual = $this->Solicitudes->getRol($username); //obtiene el rol de usuario actualmente logueado
            //idActual es el id de quien hizo login
            $idActual = $this->Solicitudes->getIDUsuario($username); //Lo devuelve en string, se pasa a int para comparar
            $connect = ConnectionManager::get('default');
            $consulta = "select estado from posee where roles_id = ".$rolActual[0]." and permisos_id = 13;";
            $permiso = $connect->execute($consulta)->fetchAll();
            if ($permiso[0][0] != 1){//Lo primero es preguntar por el permiso de consulta
                return $this->redirect(['controller' => 'Inicio','action' => 'fail']);
            }
            if (4 == $rolActual[0]){ //Si el estudiante está tratando de ver su solicitud
                
                $connect = ConnectionManager::get('default');
                $consulta = "select usuarios_id from solicitudes where id = ".$id.";";
                $idSolicitud = $connect->execute($consulta)->fetchAll();
                //El id correspondiente a la solicitud que se quiere ver
                $idEstudianteSolicitud = $idSolicitud[0][0];
                //Se compara si el estudiante que hizo login está viendo uno solicitud suya o no
                if ($idActual[0][0] != $idEstudianteSolicitud){
                    return $this->redirect(['controller' => 'Inicio','action' => 'fail']);
                }
            }
            //Si el profesor quiere ver las solicitudes que le llegan
            else if(3 == $rolActual[0]){
                $connect = ConnectionManager::get('default');
                $idActual = $this->Solicitudes->getIDUsuario($username); 
                $idProfe = $idActual[0][0]; //Retorna el id del profesor que está logeado
                
                $consulta = "select us.id , us.nombre
                            from grupos as gr join solicitudes on grupos_id = gr.id
                                              join usuarios as us on gr.usuarios_id = us.id
                             where solicitudes.id = ".$id.";";
                $resultado =  $connect->execute($consulta)->fetchAll();
                //La consulta devuelve el id del profesor asociado al grupo de la solicitud 
                $idProfeSolicitud = $resultado[0][0];
                if ($idProfeSolicitud != $idProfe){ //Tratar de acceder a consultas de otros profes
                    return $this->redirect(['controller' => 'Inicio','action' => 'fail']);
                }
            }
        }
        else{
            return $this->redirect(['controller' => 'Inicio','action' => 'fail']);
        }
        //Cierra seguridad
        $solicitude = $this->Solicitudes->get($id, [
            'contain' => ['Usuarios', 'Grupos']
        ]);
        
        $idActual = $this->Solicitudes->getIDUsuario($username); //obtiene el id de usuario actualmente logueado
        $todo = $this->Solicitudes->getViewValuesUsuario($id);//obtiene los datos de la solicitud para la vista
        $this->set('todo',$todo);
        $this->set('solicitude', $solicitude);
    }
    public function imprimir($id = null){
        $this->layout = 'None';
        $solicitude = $this->Solicitudes->get($id, [
            'contain' => ['Usuarios', 'Grupos']
        ]);
      /*  debug($solicitude);
        die(); */
        $curso = $this->Solicitudes->getCurso($solicitude->id);
        $this->set('solicitude', $solicitude);
        $this->set('curso', $curso);
    }
    public function get_round()
    {
      return $this->Solicitudes->getRonda(); //En realidad deberia llamar a la controladora de ronda, la cual luego ejecuta esta instruccion
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
       
        //Inicio de seguridad
        $username = $this->getRequest()->getSession()->read('id');
        if ($username != null){
            $rolActual = $this->Solicitudes->getRol($username); 
            $estado = $this->get_estado_ronda();
            $connect = ConnectionManager::get('default');
            $consulta = "select pos.estado
                        from posee as pos join permisos as per on pos.permisos_id =  per.id
                         where per.id = 15 and roles_id = ".$rolActual[0][0].";";
                         //15 = Insertar Solicitud
            $tupla =  $connect->execute($consulta)->fetchAll(); 
 
            if(1 != $tupla[0][0] || !$estado){
                return $this->redirect(['controller' => 'Inicio','action' => 'fail']);
            }
        }
        else{
            return $this->redirect(['controller' => 'Inicio','action' => 'fail']);
        }
        //Cierre de Seguridad
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
     * Edit method
     *
     * @param string|null $id Solicitude id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $solicitude = $this->Solicitudes->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $solicitude = $this->Solicitudes->patchEntity($solicitude, $this->request->getData());
            if ($this->Solicitudes->save($solicitude)) {
                $this->Flash->success(__('La solicitud ha sido modificado.'));
                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('La solicitud no se ha podido modificar. Por favor intente de nuevo.'));
        }
        $usuarios = $this->Solicitudes->Usuarios->find('list', ['limit' => 200]);
        $grupos = $this->Solicitudes->Grupos->find('list', ['limit' => 200]);
        $this->set(compact('solicitude', 'usuarios', 'grupos'));
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
    private function viewFile($filename) {
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
        $semestre = $this->get_semester(); //obtiene el semestre actual
        $año = $this->get_year(); //obtiene el año actual
        $tabla = $this->Solicitudes->getGruposSinAsignar($semestre,$año); //Grupos sin asistente asignado
        $this->set(compact('tabla'));
    }

    //Asignación de un asistente a un grupo
    public function asignarAsistente($grupoId){


    }
        /***********************************************************************************************************/

    public function genera($id = null){
        $solicitude = $this->Solicitudes->newEntity();
        if ($this->request->is('post')) {
            $solicitude = $this->Solicitudes->patchEntity($solicitude, $this->request->getData());
            $info = $this->Solicitudes->getHistorialExcelEstudiante($id);
            //debug($info);
            //die();

            /*Ruta de donde se genera el archivo. La carpeta Excel tiene que existir desde antes*/
            $ruta="C:\Users\B54548\Desktop\Excel\librotest.xlsx"; 

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

            $writer = new Xlsx($spreadsheet);

            try{
                $writer->save($ruta/*.'librotest.xlsx'*/);
                echo "Archivo Creado";
            }
            catch(Exception $e){
                echo $e->getMessage();
            }
            
        }
    
        $todo = $this->Solicitudes->getHistorialExcelEstudiante($id);
        $this->set(compact('todo', 'solicitude'));
    }

}