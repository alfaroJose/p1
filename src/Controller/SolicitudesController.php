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
     * Index method
     *
     * @return \Cake\Http\Response|void
     */
    public function indexestudiante()
    {
        $username = $this->request->getSession()->read('id');
        $idActual = $this->Solicitudes->getIDEstudiante($username);   
        //debug($idActual[0][0]);
        //die();          
        $todo = $this->Solicitudes->getIndexValuesEstudiante($idActual[0][0]);
        //debug($todo);
        //die();
        $this->paginate = [
            'contain' => ['Usuarios', 'Grupos']
        ];
        $solicitudes = $this->paginate($this->Solicitudes);
        $this->set(compact('solicitudes','todo'));
    }

    public function revisar($id = null)
    {
        $solicitude = $this->Solicitudes->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $solicitude = $this->Solicitudes->patchEntity($solicitude, $this->request->getData());
            if ($this->Solicitudes->save($solicitude)) {
                $this->Flash->success(__('Si sirvió.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('No sirvío'));
        }
        $datosSolicitud = $this->Solicitudes->getSolicitudCompleta($id);
        $datosRequisitosAsistente = $this->Solicitudes->getRequisitosAsistente($id);
        $datosRequisitosEstudiante = $this->Solicitudes->getRequisitosEstudiante($id);
        $datosRequisitosGeneral = $this->Solicitudes->getRequisitosAmbos($id);
        $this->set(compact('solicitude','datosSolicitud','datosRequisitosAsistente','datosRequisitosEstudiante','datosRequisitosGeneral'));
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
     * View method
     *
     * @param string|null $id Solicitude id.
     * @return \Cake\Http\Response|void
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function viewestudiante($id = null)
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