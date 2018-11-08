<?php
namespace App\Controller;

use App\Controller\AppController;
use Dompdf\Dompdf;
use Cake\Datasource\ConnectionManager;
use Cake\Chronos\Date;
use Cake\ORM\TableRegistry;
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
        $todo = $this->Solicitudes->getIndexValuesEstudiante($idActual[0][0]); //carga el index con solo los datos del estudiante actualmente logueado
        }else if(3==$rolActual[0]){ //si el usuario es un profesor 
                $todo = $this->Solicitudes->getIndexValuesProfesor($idActual[0][0]); //carga el index con solo los datos del profesor actualmente logueado
        }else if(1==$rolActual[0]||2==$rolActual[0]){ //si el usuario es un admin o asistente de admin 
                $todo = $this->Solicitudes->getIndexValues(); //carga el index con todas las solicitudes
            }
      
        $this->paginate = [
            'contain' => ['Usuarios', 'Grupos']
        ];
        $solicitudes = $this->paginate($this->Solicitudes);
        $estado = $this->get_estado_ronda();
        $this->set(compact('solicitudes','todo','estado'));
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

            foreach ($datosRequisitosSolicitud as $requisitosSolicitud):
                if ($data[$requisitosSolicitud['requisito_id']] == '0') {
                    $data[$requisitosSolicitud['requisito_id']] = 'Sí';
                } else if ($data[$requisitosSolicitud['requisito_id']] == '1') {
                    $data[$requisitosSolicitud['requisito_id']] = 'No';
                } else if ($data[$requisitosSolicitud['requisito_id']] == '2') {
                    $data[$requisitosSolicitud['requisito_id']] = 'Inopia';
                } else {
                    $data[$requisitosSolicitud['requisito_id']] = 'Sin verificar';
                }
                $this->Solicitudes->setCondicionTiene($solicitude['id'], $requisitosSolicitud['requisito_id'], $data[$requisitosSolicitud['requisito_id']]);
            endforeach;



            if ($solicitude['estado'] == '0') {
                $solicitude['estado'] = 'Elegible';
            } else if ($solicitude['estado'] == '1') {
                $solicitude['estado'] = 'Rechazada - Profesor';
            } else if ($solicitude['estado'] == '2') {
                $solicitude['estado'] = 'Aceptada - Profesor';
            } else if ($solicitude['estado'] == '3'){
                $solicitude['estado'] = 'Aceptada - Profesor (Inopia)';
            } else {
                $solicitude['estado'] = 'Anulada';
            }

            if ($this->Solicitudes->save($solicitude)) {
                $this->Flash->success(__('Si sirvió.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('No sirvío'));
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
                $this->Flash->success(__('La solicitud ha sido agregada.'));
                return $this->redirect(['action' => 'index']);
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

   public function generate($id = null)
    {
        // se crea una entidad para luego poder hacer los validadores
        $solicitudPDF = $this->Solicitudes->get($id);
        // linea para marcar el desecho como descargado, haciendo que ya no se pueda borrar
           // $technicalReport->descargado = true;
            // Actualizo el desecho, guardando el valor de descargado como true
             //y de paso se validan los campos para mayor seguridad del PDF
            $this->solicitudPDF->save($solicitudPDF);
        
            // Actualizo el reporte técnico, guardando el valor de descargado como true
            //$this->TechnicalReports->save($technicalReport);
            /***** NOTA: NO HAGA ALGO COMO ESTO AQUI XD, LAS CONSULTAS DEBEN IR EN EL MODELO **/
            /** saca los datos del activo*/
            // $conn = ConnectionManager::get('default');
            //$stmt = $conn->execute("select a.plaque, a.description, b.name as brand, m.name as model, a.series, a.state
           $SolicitudPDF = $this->SolicitudPDF->patchEntity($SolicitudPDF, $this->request->getData());  
            //from assets a
            //inner join brands b on  b.id=a.brand
            //inner join models m on m.id=a.models_id
            //where a.plaque in('" . $technicalReport->assets_id. "');");
            $results = $stmt ->fetchAll('assoc');
            // Se carga lo necesario del dompdf, se crea el objeto y luego se va contruyendo el html
            require_once 'dompdf/autoload.inc.php';
            //initialize dompdf class
            $document = new Dompdf();
            $html = '';
          $document->loadHtml('<!DOCTYPE html> <html xmlns="http://www.w3.org/1999/xhtml"> <head> <meta charset="utf-8"/>  <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1"/> <link rel="stylesheet" href="base.min.css"/><link rel="stylesheet" href="fancy.min.css"/> <link rel="stylesheet" href="main.css"/> <script src="compatibility.min.js"></script> <script src="theViewer.min.js"></script><script>  try{  theViewer.defaultViewer = new theViewer.Viewer({}); }catch(e){} </script> <title></title</head><body>
            <div id="sidebar">
            <div id="outline">
            </div>
            </div>
            <div id="page-container">
            <div id="pf1" class="pf w0 h0" data-page-no="1">
            <div class="pc pc1 w0 h0">
            <img class="bi x0 y0 w0 h0" alt="" src="bg1.png"/>
            <div class="c x0 y1 w0 h1">
            <div class="t m0 x1 h2 y2 ff1 fs0 fc0 sc0 ls0 ws0"> </div></div>
            <div class="c x2 y3 w1 h3"><div class="t m0 x3 h2 y4 ff1 fs0 fc0 sc0 ls0 ws0"> </div>
            <div class="t m0 x3 h2 y5 ff1 fs0 fc0 sc0 ls0 ws0"> </div>
            <div class="t m0 x3 h2 y6 ff1 fs0 fc0 sc0 ls0 ws0"> </div>
            <div class="t m0 x3 h2 y7 ff1 fs0 fc0 sc0 ls0 ws0"> </div>
            <div class="t m0 x3 h2 y8 ff1 fs0 fc0 sc0 ls0 ws0"> </div>
            </div>
            <div class="c x4 y9 w2 h4"><div class="t m0 x5 h5 ya ff2 fs0 fc1 sc0 ls0 ws0"></div></div>
            <div class="c x6 yb w3 h6"><div class="t m0 x3 h2 yc ff1 fs0 fc0 sc0 ls0 ws0"> </div></div>
            <div class="c x0 y1 w0 h1"><div class="t m0 x1 h2 yd ff1 fs0 fc0 sc0 ls0 ws0"> </div>
            <div class="t m0 x7 h7 ye ff3 fs0 fc0 sc0 ls0 ws0">Solicitud de concurso para asistencias </div>
            <div class="t m0 x8 h8 yf ff4 fs1 fc0 sc0 ls0 ws0">(Un formulario por cada curso y grupo solicitado) </div>
            <div class="t m0 x9 h2 y10 ff1 fs0 fc0 sc0 ls0 ws0"> </div><div class="t m0 x1 h9 y11 ff3 fs1 fc0 sc0 ls0 ws0">Datos del estudiante &#58 </div>
            <div class="t m0 x1 h8 y12 ff4 fs1 fc0 sc0 ls0 ws0"> </div><div class="t m0 x1 h8 y13 ff4 fs1 fc0 sc0 ls0 ws0">____________________           _____________________          ______________________ </div>
            <div class="t m0 x1 h8 y14 ff4 fs1 fc0 sc0 ls0 ws0">Primer Apellido<span class="_ _0"> </span>Segundo Apellido<span class="_ _1"> </span>Nombre </div><div class="t m0 x1 h8 y15 ff4 fs1 fc0 sc0 ls0 ws0"> </div>
            <div class="t m0 x1 h9 y16 ff3 fs1 fc0 sc0 ls0 ws0">_____________       __________    ____________      ______________________________ </div>
            <div class="t m0 x1 h8 y17 ff4 fs1 fc0 sc0 ls0 ws0">Cédula <span class="_ _2"> </span>       Carné<span class="_ _3"> </span>      Teléfono<span class="_ _4"> </span>          Correo electrónico </div>
            <div class="t m0 x1 h8 y18 ff4 fs1 fc0 sc0 ls0 ws0"> </div><div class="t m0 x1 h8 y19 ff4 fs1 fc0 sc0 ls0 ws0">_________________________ <span class="_ _5"> </span>Solicita horas 
            <span class="_ _6"> </span>HE<span class="_ _7"> </span>HA          (Puede marcar ambas opciones) </div>
            <div class="t m0 x1 h2 y1a ff1 fs0 fc0 sc0 ls0 ws0">Carrera  </div><div class="t m0 x1 ha y1b ff4 fs0 fc0 sc0 ls0 ws0"> </div><div class="t m0 x1 hb y1c ff4 fs2 fc0 sc0 ls0 ws0">Documentos que debe adjuntar al entregar el formulario en la ECCI</div>
            <div class="t m0 xa hb y1d ff4 fs2 fc0 sc0 ls0 ws0">1. Entregar este formulario debidamente en la Secretaria de la ECCI, sin la firma del docente. </div>
            <div class="t m0 xa hb y1e ff4 fs2 fc0 sc0 ls0 ws0">2. Sí es su primera asistencia en la UCR debe traer además una carta de un Banco Público en la </div>
            <div class="t m0 xa hb y1f ff4 fs2 fc0 sc0 ls0 ws0">certifique su número de cuenta de ahorro o cuenta corriente y copia de su documento de identificación.  </div><div class="t m0 x1 h2 y20 ff1 fs0 fc0 sc0 ls0 ws0"> </div>
            <div class="t m0 x1 h8 y21 ff4 fs1 fc0 sc0 ls0 ws0">Información sobre otras asistencias </div>
            <div class="t m0 x1 h8 y22 ff4 fs1 fc0 sc0 ls0 ws0">1.¿Tiene o va a solicitar asistencia en otra Unidad Académica u oficina de la Universidad? </div>
            <div class="t m0 xb h2 y23 ff1 fs0 fc0 sc0 ls0 ws0">  No                Sí            Cantidad          HA                   HE  </div>
            <div class="t m0 x1 h2 y24 ff1 fs0 fc0 sc0 ls0 ws0"> </div><div class="t m0 x1 h2 y25 ff5 fs0 fc0 sc0 ls0 ws0">Curso solicitado </div></div>
            <div class="c x2 y26 w4 h4"><div class="t m0 x3 h2 ya ff1 fs0 fc0 sc0 ls0 ws0">Sigla </div></div><div class="c xc y26 w5 h4"><div class="t m0 x3 h2 ya ff1 fs0 fc0 sc0 ls0 ws0">Grupo </div></div>
            <div class="c xd y26 w6 h4"><div class="t m0 x3 h2 ya ff1 fs0 fc0 sc0 ls0 ws0">Nombre del Curso </div></div>
            <div class="c xe y26 w7 h4"><div class="t m0 x3 h2 ya ff1 fs0 fc0 sc0 ls0 ws0">Nombre del Docente </div></div>
            <div class="c x2 y27 w4 h4"><div class="t m0 x3 h2 ya ff1 fs0 fc0 sc0 ls0 ws0"> </div></div><div class="c xc y27 w5 h4"><div class="t m0 x3 h2 ya ff1 fs0 fc0 sc0 ls0 ws0"> </div></div>
            <div class="c xd y27 w6 h4"><div class="t m0 x3 h2 ya ff1 fs0 fc0 sc0 ls0 ws0"> </div></div><div class="c xe y27 w7 h4"><div class="t m0 x3 h2 ya ff1 fs0 fc0 sc0 ls0 ws0"> </div></div>
            <div class="c x0 y1 w0 h1"><div class="t m0 x1 h2 y28 ff1 fs0 fc0 sc0 ls0 ws0"> </div><div class="t m0 xf hc y29 ff3 fs3 fc0 sc0 ls0 ws0">     Firma del </div><div class="t m0 x1 h2 y2a ff3 fs3 fc0 sc0 ls0 ws0">estudiante &#58 <span class="ff6"><span class="ff1 fs0">
            _________________________ </span></span></div><div class="t m0 x1 hd y2b ff5 fs1 fc0 sc0 ls0 ws0">Uso exclusivo del Docente &#58 </div>
            <div class="t m0 x1 hd y2c ff5 fs1 fc0 sc0 ls0 ws0">Justificación <span class="ff7"></span><span class="fs2">(en ambos casos: aceptado o </span></div><div class="t m0 x1 h2 y2d ff1 fs0 fc0 sc0 ls0 ws0"> </div></div>
            <div class="c x2 y2e w3 he"><div class="t m0 x3 hf y2f ff8 fs4 fc0 sc0 ls0 ws0"></div><div class="t m0 x3 hf y30 ff8 fs4 fc0 sc0 ls0 ws0">Teléfono &#58 (506) 2511-8000 </div><div class="t m0 x3 hf y31 ff8 fs4 fc0 sc0 ls0 ws0">Fax &#58 (506) 2511-5527</div>
            <div class="t m0 x3 hf y32 ff8 fs4 fc0 sc0 ls0 ws0">http&#58//www.ecci.ucr.ac.cr</div></div><div class="c x10 y33 w3 h4"><div class="t m0 x3 h2 y34 ff1 fs0 fc0 sc0 ls0 ws0"> </div></div>
            <div class="c x6 y35 w3 h10"><div class="t m0 x11 hf y36 ff8 fs4 fc0 sc0 ls0 ws0"></div><div class="t m0 x3 hf y37 ff8 fs4 fc0 sc0 ls0 ws0"></div></div><div class="c x0 y1 w0 h1"><div class="t m0 x1 h2 y38 ff1 fs0 fc0 sc0 ls0 ws0"> </div></div></div>
          <div class="pi" data-data="{"ctm":[1.000000,0.000000,0.000000,1.000000,0.000000,0.000000]}"></div></div>
            <div id="pf2" class="pf w0 h0" data-page-no="2"><div class="pc pc2 w0 h0"><img class="bi x0 y0 w0 h0" alt="" src="bg2.png"/><div class="c x0 y1 w0 h1"><div class="t m0 x1 h2 y2 ff1 fs0 fc0 sc0 ls0 ws0"> </div></div><div class="c x2 y3 w1 h3"><div class="t m0 x3 h2 y4 ff1 fs0 fc0 sc0 ls0 ws0"> </div><div class="t m0 x3 h2 y5 ff1 fs0 fc0 sc0 ls0 ws0"> </div><div class="t m0 x3 h2 y6 ff1 fs0 fc0 sc0 ls0 ws0"> </div><div class="t m0 x3 h2 y7 ff1 fs0 fc0 sc0 ls0 ws0"> </div><div class="t m0 x3 h2 y8 ff1 fs0 fc0 sc0 ls0 ws0"> </div></div><div class="c x4 y9 w2 h4"><div class="t m0 x5 h5 ya ff2 fs0 fc1 sc0 ls0 ws0"></div></div><div class="c x6 yb w3 h6"><div class="t m0 x3 h2 yc ff1 fs0 fc0 sc0 ls0 ws0"> </div></div><div class="c x0 y1 w0 h1"><div class="t m0 x1 h2 yd ff1 fs0 fc0 sc0 ls0 ws0"> </div><div class="t m0 x1 h2 ye ff5 fs2 fc0 sc0 ls0 ws0">rechazado)<span class="ff9"></span><span class="fs1">:<span class="ff7"><span class="ff1">___</span><span class="ff1 fs0">________________________________ </span></span></span></div><div class="t m0 x1 h2 y39 ff1 fs0 fc0 sc0 ls0 ws0">___________________________________________________________________</div><div class="t m0 x1 h2 y3a ff1 fs0 fc0 sc0 ls0 ws0">_______ </div><div class="t m0 x1 h2 y3b ff1 fs0 fc0 sc0 ls0 ws0">___________________________________________________________________</div><div class="t m0 x1 h2 y3c ff1 fs0 fc0 sc0 ls0 ws0">_______ </div><div class="t m0 x1 h2 y3d ff1 fs0 fc0 sc0 ls0 ws0">___________________________________________________________________</div><div class="t m0 x1 h2 y3e ff1 fs0 fc0 sc0 ls0 ws0">_______ </div><div class="t m0 x1 h2 y3f ff5 fs0 fc0 sc0 ls0 ws0">  Px:_______<span class="_ _8"> </span>        Aceptado   Horas asignadas ________<span class="_ _9"> </span><span class="ff1"> <span class="ffa"></span></span>Rechazado <span class="_ _a"> </span><span class="ff1"> </span></div><div class="t m0 x1 h11 y40 ff5 fs2 fc0 sc0 ls0 ws0"> </div><div class="t m0 x1 h11 y41 ff5 fs2 fc0 sc0 ls0 ws0"> </div><div class="t m0 x1 h2 y42 ff3 fs3 fc0 sc0 ls0 ws0">Firma del Docente:<span class="ff6"><span class="ff5 fs2">____________________________(en ambos casos: aceptado o rechazado)<span class="ff1 fs0"> </span></span></span></div><div class="t m0 x1 h2 y2d ff1 fs0 fc0 sc0 ls0 ws0"> </div></div><div class="c x2 y2e w3 he"><div class="t m0 x3 hf y2f ff8 fs4 fc0 sc0 ls0 ws0"></div><div class="t m0 x3 hf y30 ff8 fs4 fc0 sc0 ls0 ws0">Teléfono: (506) 2511-8000 </div><div class="t m0 x3 hf y31 ff8 fs4 fc0 sc0 ls0 ws0">Fax: (506) 2511-5527</div><div class="t m0 x3 hf y32 ff8 fs4 fc0 sc0 ls0 ws0">http://www.ecci.ucr.ac.cr</div></div><div class="c x10 y33 w3 h4"><div class="t m0 x3 h2 y34 ff1 fs0 fc0 sc0 ls0 ws0"> </div></div><div class="c x6 y35 w3 h10"><div class="t m0 x11 hf y36 ff8 fs4 fc0 sc0 ls0 ws0"></div><div class="t m0 x3 hf y37 ff8 fs4 fc0 sc0 ls0 ws0"></div></div><div class="c x0 y1 w0 h1"><div class="t m0 x1 h2 y38 ff1 fs0 fc0 sc0 ls0 ws0"> </div></div></div><div class="pi" data-data="{"ctm":[1.000000,0.000000,0.000000,1.000000,0.000000,0.000000]}"></div></div>
            </div>
            <div class="loading-indicator">
            </div>
            </body>
            </html>
            '); 
            //set page size and orientation
            $document->setPaper('A3', 'portrait');
            //Render the HTML as PDF
            $document->render();
            //Get output of generated pdf in Browser
            // Cuando se descarga el pdf inmediatamente se corta el flujo en el controlador, es como si hubiera un return
            $document->stream("Informe Tecnico-".$technicalReport->technical_report_id, array("Attachment"=>1));
            //1  = Download
            //0 = Preview 
    }
}