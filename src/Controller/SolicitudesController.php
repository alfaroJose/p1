<?php
namespace App\Controller;

use App\Controller\AppController;
use Dompdf\Dompdf;
use Cake\Datasource\ConnectionManager;

/**
 * Solicitudes Controller
 *
 * @property \App\Model\Table\SolicitudesTable $Solicitudes
 *
 * @method \App\Model\Entity\Solicitude[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class SolicitudesController extends AppController
{
    public function asignar(){//Viene el id de un grupo
        $connect = ConnectionManager::get('default');
        $id = 1;
        $consulta = "select cursos.id, grupos.numero, grupos.semestre, grupos.año, cursos.nombre from grupos join cursos on cursos.id = grupos.cursos_id where grupos.id = ".$id.";" ;
        $tupla = $connect->execute($consulta)->fetchAll();
        $sigla = $tupla[0][0];
        $numGrupo = $tupla[0][1];
        $semestre = $tupla[0][2];
        $anno = $tupla[0][3];
        $nombreCurso = $tupla[0][4]; 
        $this->set('opciones', ["hoLA", "HOA"]);
        $this->set('sigla', $sigla);
        $this->set('numGrupo', $numGrupo);
        $this->set('semestre', $semestre);
        $this->set('anno', $anno);
        $this->set('nombreCurso', $nombreCurso);
    }

    /**
     * Index method
     *
     * @return \Cake\Http\Response|void
     */
    public function index()
    {
        $todo = $this->Solicitudes->getIndexValues();
        $this->paginate = [
            'contain' => ['Usuarios', 'Grupos']
        ];
        $solicitudes = $this->paginate($this->Solicitudes);
        $this->set(compact('solicitudes','todo'));
    }

    /**
     * View method
     *
     * @param string|null $id Solicitude id.
     * @return \Cake\Http\Response|void
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $solicitude = $this->Solicitudes->get($id, [
            'contain' => ['Usuarios', 'Grupos']
        ]);

        $this->set('solicitude', $solicitude);
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $solicitude = $this->Solicitudes->newEntity();
        if ($this->request->is('post')) {
            $solicitude = $this->Solicitudes->patchEntity($solicitude, $this->request->getData());
            if ($this->Solicitudes->save($solicitude)) {
                $this->Flash->success(__('La solicitud ha sido agregada.'));
                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('La solicitud no se ha podido agregar. Por favor intente de nuevo.'));
        }
        $usuarios = $this->Solicitudes->Usuarios->find('list', ['limit' => 200]);
        $grupos = $this->Solicitudes->Grupos->find('list', ['limit' => 200]);
        $this->set(compact('solicitude', 'usuarios', 'grupos'));
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

    public function viewFile($filename) {
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
            $document->loadHtml('C:\xampp\htdocs\p1\src\Controller');
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
