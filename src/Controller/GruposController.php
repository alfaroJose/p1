<?php
namespace App\Controller;

use App\Controller\AppController;
use Cake\Datasource\ConnectionManager;
use Cake\ORM\TableRegistry;

use PhpOffice\PhpSpreadsheet\IOFactory;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Helper;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use Cake\Filesystem\Folder;
use Cake\Filesystem\File;
use Cake\Database\Exception;
require ROOT.DS.'vendor' .DS. 'phpoffice/phpspreadsheet/src/Bootstrap.php';


/**
 * Cursos/Grupos Controller
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
     * Función que agrega un curso nuevo y un grupo a este curso recíen agregado
     * de lo contrario informa que el curso no se ha podido agregar.
     * @param string|null $id Grupo id.
     * @param string|null $idCurso Curso id.
     * @param string|null $idProfesor Profesor id.
     *
     * @return \Cake\Http\Response|null Redirects on successful add.
     */
    public function addCurso()
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

        $profesores = $this->Grupos->seleccionarProfesoresNombres();
        $profesoresCorreos= array(0 => "");
        $profesoresIds=array(0 => "");

        foreach ($profesores as $key => $value) {
          
            array_push($profesoresCorreos, $value[0]);
            array_push($profesoresIds, $value[1]);
        }

    
        $grupo = $this->Grupos->newEntity();
        if ($this->request->is('post')) {
            $cursoModel = $this->loadModel('Cursos');

            $grupo = $this->Grupos->patchEntity($grupo, $this->request->getData());
            $curso = $cursoModel->newEntity();
            $curso = $cursoModel->patchEntity($curso, $this->request->getData());
            $semestreSeleccionado = $this->request->getData('Semestre');
            $grupo->semestre = $opcionesSemestre[$semestreSeleccionado];
            $profesorSeleccionado = $this->request->getData('Profesor');
            $grupo->usuarios_id = $profesoresIds[$profesorSeleccionado];

            debug($curso);
            if ($cursoModel->save($curso)) {
                $this->Flash->success(__('El curso ha sido agregado.'));
                $grupo->cursos_id = $this->Grupos->obtenerCursoId($curso->sigla);
                if($this->Grupos->save($grupo)){
                    
                }
                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('El curso no se ha podido agregar. Por favor intente de nuevo.'));
        }
        
        $this->set('opcionesSemestre', $opcionesSemestre);
        $this->set('correos',$profesoresCorreos);
        $this->set('defaultSelectProfesor',$defaultSelectProfesor);
        $this->set('defaultSelectSemestre',$defaultSelectSemestre);
        $this->set(compact('grupo', 'profesores'));
    }


    /**
     * Función que agrega un grupo a un curso ya existente, de lo contrario 
     * informa que no se ha podido agregar el grupo.
     * @param string|null $id Grupo id.
     * @param string|null $idCurso Curso id.
     * @param string|null $idProfesor Profesor id.
     *
     * @return \Cake\Http\Response|null Redirects on successful add.
     */
    public function add($id = null, $idCurso = null, $idProfesor = null)
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
            if(!$siglaEncontrado){ 
                if($siglaIds[$itSigla]==$idCurso){
                    $siglaEncontrado=true;
                }
                else{
                    $itSigla++;
                }
            }
        }

        $profesores = $this->Grupos->seleccionarProfesoresNombres();
        $profesoresCorreos= array(0 => "");
        $profesoresIds=array(0 => "");
        $grupo = $this->Grupos->get($id, [
            'contain' => []
        ]);
        foreach ($profesores as $key => $value) {
            array_push($profesoresCorreos, $value[0]);
            array_push($profesoresIds, $value[1]);
            if(!$profesorEncontrado){ //busca el profesor actual del grupo
                if($profesoresIds[$itProfesor]==$idProfesor){
                    $profesorEncontrado=true;
                }
                else{
                    $itProfesor++;
                }
            }
        }

        while(!$semestreEncontrado){ //busca el semestre actual del grupo
            if($opcionesSemestre[$itSemestre]==$grupo->semestre){
                $semestreEncontrado=true;
            }
            else{
                $itSemestre++;
            }
         }
    
        $grupo = $this->Grupos->newEntity();
        if ($this->request->is('post')) {
            $grupo = $this->Grupos->patchEntity($grupo, $this->request->getData());
            $semestreSeleccionado = $this->request->getData('Semestre');
            $grupo->semestre = $opcionesSemestre[$semestreSeleccionado];
            $profesorSeleccionado = $this->request->getData('Profesor');
            $grupo->usuarios_id = $profesoresIds[$profesorSeleccionado];
            $siglaSeleccionada = $this->request->getData('Sigla');
            $grupo->cursos_id = $siglaIds[$siglaSeleccionada];
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
     * Función que permite editar los campos de un grupo.
     *
     * @param string|null $id Grupo id.
     * @param string|null $idCurso Curso id.
     * @param string|null $idProfesor Profesor id.
     * @return \Cake\Http\Response|null Redirects on successful edit.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
     public function edit($id = null, $idCurso = null, $idProfesor = null)
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

        $opcionesSemestre=[1,2,3]; //vector de semestres
        $semestreEncontrado=false; //controla la busqueda
        $itSemestre=0; //iterador para recorresr el vector de semestres
        $defaultSelectSemestre=0; //semestre del grupo actual
        $profesorEncontrado=false; //controla la busqueda
        $itProfesor=0; //iterador para recorresr el vector de profesores
        $defaultSelectProfesor=0; //profesor del grupo actual

        $profesores = $this->Grupos->seleccionarProfesoresNombres(); //obtiene el nombre, apellido y id de los profesores
        $profesoresCorreos= array(0 => "");
        $profesoresIds=array(0 => "");
        $grupo = $this->Grupos->get($id, [
            'contain' => []
        ]);
        $cursos = $this->Grupos->obtenerCursos($idCurso); //obtiene la sigla del curso segun el id
        foreach ($profesores as $key => $value) {
            array_push($profesoresCorreos, $value[0]);
            array_push($profesoresIds, $value[1]);
            if(!$profesorEncontrado){ //busca el profesor actual del grupo
                if($profesoresIds[$itProfesor]==$idProfesor){
                    $profesorEncontrado=true;
                }
                else{
                    $itProfesor++;
                }
            }
        }
         $defaultSelectProfesor=$itProfesor; 
        while(!$semestreEncontrado){ //busca el semestre actual del grupo
            if($opcionesSemestre[$itSemestre]==$grupo->semestre){
                $semestreEncontrado=true;
            }
            else{
                $itSemestre++;
            }
         }
         $defaultSelectSemestre=$itSemestre;
        if ($this->request->is(['patch', 'post', 'put'])) {
            $grupo = $this->Grupos->patchEntity($grupo, $this->request->getData());
            $semestreSeleccionado = $this->request->getData('Semestre');
           
            $grupo->semestre = $opcionesSemestre[$semestreSeleccionado];
            $profesorSeleccionado = $this->request->getData('Profesor');
           
            $grupo->usuarios_id = $profesoresIds[$profesorSeleccionado];
            if ($this->Grupos->save($grupo)) {
                $this->Flash->success(__('El grupo ha sido modificado.'));
                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('El grupo no se ha podido modificar. Por favor intente de nuevo.'));
        }
        $usuarios = $this->Grupos->Usuarios->find('list', ['limit' => 200]);
        $this->set('correos',$profesoresCorreos);
        $this->set('opcionesSemestre', $opcionesSemestre);
        $this->set('defaultSelectProfesor',$defaultSelectProfesor);
        $this->set('defaultSelectSemestre',$defaultSelectSemestre);
        $this->set(compact('grupo', /*'usuarios', */'cursos'/*,'correo'*/));
    }

    /**
     * Función que borra un grupo existente.
     *
     * @param string|null $id Grupo id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post']);
        if($this->Grupos->existenSolicitudes($id)){
            $this->Flash->error(__('No se puede eliminar un grupo con solicitudes asociadas.'));
        } else {
            $grupo = $this->Grupos->get($id);
            if ($this->Grupos->delete($grupo)) {
                $this->Flash->success(__('El grupo ha sido eliminado.'));
            } else {
                $this->Flash->error(__('El grupo no se ha podido eliminar. Por favor intente de nuevo.'));
            }
        }
        return $this->redirect(['action' => 'index']);
    }

    //Método encargado de leer el archivo de excel y mostrar la vista previa
    public function importExcelfile (){
        $this->loadModel('Grupos');
        $usuariosTable = $this->loadmodel('Usuarios');
        $coursesClassesVw = $this->Grupos->newEntity();
        $UserController = new UsuariosController;
        //Quita el límite de la memoria, ya que los archivos la pueden gastar
        ini_set('memory_limit', '-1');

        //Obtiene la carpeta y el nombre del archivo guardado en la base de datos
        $fileDir = $this->getDir();
        //Con los datos obtenidos indica el directorio del archivo
        $inputFileName = WWW_ROOT. 'files'. DS. 'files'. DS. 'file'. DS. $fileDir[1]. DS. $fileDir[0];

        //Identifica el tipo de archivo
        $inputFileType = \PhpOffice\PhpSpreadsheet\IOFactory::identify($inputFileName);
        //Crea un nuevo reader para el tipo de archivo
        $reader = \PhpOffice\PhpSpreadsheet\IOFactory::createReader($inputFileType);
        //Hace que el reader sólo lea archivos con datos
        $reader->setReadDataOnly(true);
        //Carga el archivo a un spreadsheet
        $spreadsheet = $reader->load($inputFileName);

        $worksheet = $spreadsheet->getActiveSheet();
        //Consigue la posición de la última fila
        $highestRow = $worksheet->getHighestRow(null);
        //Consigue la posición de la última columna
        $highestColumn = $worksheet->getHighestDataColumn();
        //Transforma la última fila a un index. Ejemplo C = 3
        $highestColumnIndex = \PhpOffice\PhpSpreadsheet\Cell\Coordinate::columnIndexFromString($highestColumn);

        //Contiene una matriz con las filas del archivo
        $table = [];
        //Contiene las filas del archivo
        $rows = [];

        $profIds = [];

        //Los profesores que deben ser agregados antes
        $errorProf = [];

        //Indica si se pueden agregar cursos
        $canContinue = true;

        //Se llena la matriz
        for ($row = 5; $row <= $highestRow; ++$row) {
            for ($col = 1; $col <= 4; ++$col) {
                $value = $worksheet->getCellByColumnAndRow($col, $row)->getValue();
                $rows[$col -1] = $value;

                //Revisa si el profe existe
                if($col == 4){
                    if($value != null){
                        //Divide el profesor en nombre y apellido
                        $prof = preg_split('/\s+/', $value);
                        //Consigue el id del profesor
                        //$id = $UserController->getId($prof[count($prof)-1], $prof[0]);
                        //debug($prof[count($prof)-1]);
                        //debug($prof);
                        //die();
                        $id = $usuariosTable->getID($prof[count($prof)-1], $prof[0]);
                        
                        if($id == null){                            
                            $canContinue = false;
                            array_push($errorProf, $value);
                        
                        }else{
                            array_push($profIds, $id);
                        }
                    }else{
                        array_push($profIds, null);
                    }
                    
                }

            }
            $table[$row -5] = $rows;
            unset($rows); //resetea el array rows
        }

        //En caso de que un profesor no exista
        if(!$canContinue){
            $message = "Los siguientes profesores no están en el sistema : \n";

            for($i = 0; $i < count($errorProf); $i++){
                $message = $message . $errorProf[$i] . ",\n";
            }

            //Se borra el archivo
            $this->deleteFiles();
            $this->Flash->error($message);
            return $this->redirect(['controller' => 'Grupos', 'action' => 'index']);
        }

        //Se cambia el nombre de las llaves del array si no es post ya que es para la vista previa
        if(!$this->request->is('post')){
            $table = array_map(function($tag) {
                /*Se le agrega el guión a las siglas de los cursos porque el archivo no las incluye*/
                $name = $tag['1'];
                $len =  strlen($name);
                if ($len != 0){     
                    $tag['1'] = substr($name,0,2).'-'.substr($name,2,$len-2);
                }
                //debug($tag['1']);
                //debug($len);
                //die();
                return array(
                    'Curso' => $tag['0'],
                    'Sigla' => $tag['1'],
                    'Grupo' => $tag['2'],
                    'Profesor' => $tag['3']
                );

            }, $table);
    
        }
        /* //sirve*/
        
        //Hace que table sea visible para el template
        $this->set('table', $table);

        //Cuando se da aceptar
        if ($this->request->is('post')) {
            //Borra todos los grupos
            $classesModel = $this->loadmodel('Grupos');
            //$classesModel->deleteAllClasses();

            //Llama al método addFromFile con cada fila
            for ($row = 0; $row < count($table); ++$row) {
                $this->addFromFile($table[$row], $profIds[$row]);
            }

            //Se borra el archivo
            $this->deleteFiles();

            $this->Flash->success(__('Se agregaron los cursos correctamente.'));
            return $this->redirect(['controller' => 'Grupos', 'action' => 'index']);
        }
        $this->set(compact('coursesClassesVw'));
    }

    //Este método se usa para agregar cada fila del archivo una vez se preciona aceptar
    public function addFromFile ($parameters, $profId){
        
        if($parameters[0] != null){
            $courseTable = $this->loadmodel('Cursos');
            $classTable = $this->loadmodel('Grupos');
            $SolicitudController = new SolicitudesController;

            //Se incluye el guión en la sigla de los cursos
            $len =  strlen($parameters[1]);
            $name = substr($parameters[1],0,2).'-'.substr($parameters[1],2,$len-2); //sirve
            
            //Agrega el curso
            $courseTable->addCourse($name, $parameters[0]);

            //Recupera el semestre y año de las funciones ya hechas anteriormente en el controlador de Solicitudes           
            $semester = $SolicitudController->get_semester();
            $year = $SolicitudController->get_year();
            //debug($year);
            //die();
            //Para agregra el grupo, primero tenemos que encontrar el id según la sigla
            $idCurso = $this->Grupos->obtenerCursoId($name);
            
            $classTable->addClass($parameters[2], $semester, $year, $idCurso, $profId);
            
        }
    }

    //Se llama al precionar el botón cancelar.
    //Es necesario ya que hay que eliminar los archivos del sistema
    public function cancelExcel(){
        $this->deleteFiles();
        return $this->redirect(['controller' => 'Grupos', 'action' => 'index']);
    }

    //Metodo encargado de subir el archivo
    public function uploadFile()
    {
        //El modelo files tiene una única tupla con el nombre y la carpeta del archivo
        $this->loadmodel('Files');
        //Si en la vista previa se preciona la flecha para regresar del navegador, los archivos se mantienen cargados, por lo que es necesario llamar a este método
        $this->deleteFiles();
        $file = $this->Files->newEntity();
        if ($this->request->is('post')) {
            //Recupera el nombre del archivo
            $file = $this->Files->patchEntity($file, $this->request->getData());
            //debug($file);
            //die();            //Se sube el archivo
            if ($this->Files->save($file)) {
                //Una vez subido, llama el método importExcelFile
                return $this->redirect(['controller' => 'Grupos', 'action' => 'importExcelfile']);
            }
            //En caso de error, es importante redireccionar al index, ya que este método no tiene vista
            $this->Flash->error(__('Error subiendo el archivo'));
            return $this->redirect(['controller' => 'Grupos', 'action' => 'index']);
        }
        $this->set(compact('file'));
        //Si se logra entrar a este método sin ser post, simplemente redirecciona al index
        return $this->redirect(['controller' => 'Grupos', 'action' => 'index']);
    }
    //Retorna el directorio de el archivo subido (nombre y carpeta). Retorna nulo si no existe
    public function getDir(){
        $fileTable = $this->loadmodel('Files');
        return $fileTable->getDir();
    }

    //Borra el archivo subido, tanto del sistema como de la base
    public function deleteFiles(){
        //Obtiene las direcciones
        $fileDir = $this->getDir();
        //Revisa si el directorio existe antes de borrar
        if($fileDir != null){
            //Borra el folder
            $path = WWW_ROOT. 'files'. DS. 'files'. DS. 'file'. DS. $fileDir[1];
            $folder = new Folder($path);
            $folder->delete();
            $fileTable = $this->loadmodel('Files');
            $fileTable->deleteFiles();
        } 
    }

}
