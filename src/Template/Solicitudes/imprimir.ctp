<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Solicitude[]|\Cake\Collection\CollectionInterface $solicitudes
 */
?>
<script type="text/javascript">
$(document).ready( function () {
     if()
    } );
  </script>
<div class="imprimir">
<head> 
<style>
input[type=checkbox] + label {
    display: inline-block;
    position: relative;
    padding: 8px;
    background-color: #000000;
    border: 5px solid #FFFFFF;
    border-radius: 2px;
    width: 8px;
    height: 6px;
}
</style>
<meta charset="utf-8"/>  <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1"/> <link rel="stylesheet" href="base.min.css"/><link rel="stylesheet" href="fancy.min.css"/> <link rel="stylesheet"/> 

<script>  
  try{ 
    theViewer.defaultViewer = new theViewer.Viewer({});
  }catch(e){} 
</script> 
<?= $this->Html->image('logoUniversidadDeCostaRica.png');?> <td></td><td></td> <td></td> <td></td>  <?= $this->Html->image('logoECCI.jpg');?>  
<title> Solicitud de  asistencia</title>
</head>

<body>
<h1>Solicitud de  asistencias </h1>
<br>
<h2> Datos del estudiante</h2>
<p> (Un formulario por cada curso y grupo solicitado)</p>
<table style="border-collapse:separate;
    border-spacing:10px 0px;">
  <tbody>
    <tr style="height: 10px;">
<td style="border-bottom: 1pt solid black;"><?= h($solicitude->usuario->primer_apellido) ?> </td>
<td></td>
<td style="border-bottom: 1pt solid black;"><?= h($solicitude->usuario->segundo_apellido) ?> </td>
<td></td>
  <td style="border-bottom: 1pt solid black;"><?= h($solicitude->usuario->nombre) ?> </td>
  </tr>
  <tr style="height : 5px";>
<tr style="height :10px;">
  <td>
  Primer Apellido
  </td>
  <td></td>
  <td>
    Segundo Apellido
  </td>
  <td></td>
  <td> Nombre </td>
  </tr>
  <br>
  <br>
  <tr style="height: 10px;">
  <tr style="height: 10px;"></tr>
<td style="border-bottom: 1pt solid black;"><?= h($solicitude->usuario->identificacion) ?> </td>
<td></td>
<td style="border-bottom: 1pt solid black;"><?= h($solicitude->usuario->nombre_usuario) ?> </td>
<td></td>
  <td style="border-bottom: 1pt solid black;"><?= h($solicitude->usuario->telefono) ?> </td>
  <td></td>
  <td style="border-bottom: 1pt solid black;"><?= h($solicitude->usuario->correo) ?> </td>
  </tr>
  <tr style="height : 5px";>
<tr style="height :10px;">
  <td>
 Cedula
  </td>
  <td></td>
  <td>
    Carné
  </td>
  <td></td>
  <td> Telefono </td>
  <td></td>
  <td> Correo electronico </td>
  </tr>
  <tr style="height: 10px;">
  <tr style="height: 10px;"></tr>
<td style="border-bottom: 1pt solid black;"><?= h($solicitude->carrera) ?> </td>
<td></td>
<td> Solicita horas : </td>
<td></td>
<td> Horas Estudiante <?= $this->Form->checkbox("checkboxHE", ["disabled" => true, "class" => "checkbox", "id" => "checkboxHE"]); ?></td>
<td></td>
<td> Horas Asistente <?= $this->Form->checkbox("checkboxHA", ["disabled" => true, "class" => "checkbox", "id" => "checkboxHA"]); ?></td>
<tr style="height :10px;">
<td>Carrera</td>
</tr>
</tr>
<tr style="height: 10px;"></tr>
  </tbody>
  </table>
  <div class="mensaje" style="font-size: 0.875em;">
<p> Documentos que debe adjuntar al entregar el formulario en la ECCI: </p>
<ol>  <li>          Entregar este formulario debidamente en la Secretaria de la ECCI, sin la firma del docente. </li>
<li>                Sí es su primera asistencia en la UCR debe traer además una carta de un Banco Público en la certifique su número de cuenta de ahorro o cuenta corriente y copia de su documento de identificación. 
 </li>
</ol>
</div> 
<div class="asistencias externas" style="font-size: 0.875em;">
<p> Informacion sobre otras asistencias </p>
<ol> <li>¿Tiene o va a solicitar asistencia en otra Unidad Académica u oficina de la Universidad? <p><?= h($solicitude->asistencia_externa) ?></p></ol>
 </li>
 <p style="text-indent: 40px;">                     Tipo </p>
 <p style="text-indent: 40px;">                     Estudiante <?= $this->Form->checkbox("checkboxHEExt", ["disabled" => true, "class" => "checkboxParaHEExt", "id" => "checkboxEstudiante Externa"]);?>  Asistente <?= $this->Form->checkbox("checkboxHAExt", ["disabled" => true, "class" => "checkboxParaHAExternas", "id" => "checkboxHAExtern"]);?></p>
</div>    
  <h3><b>Curso solicitado </b> </h3>
  <table border="1">
  <tr> <td>Sigla</td><td>Grupo</td><td>Nombre del curso</td><td>Nombre del docente</td> </tr>
  <tr> <td><?= h($curso[0][0])?> </td><td><?= h($solicitude->grupo->numero) ?></td><td> <?=h($curso[0][1])?></td> <td><?= h($curso[0][2]) ?></td></tr>
  </table>
  <br>
  <p style="text-indent: 40px;"><b>Firma del estudiante  &nbsp; </b> <u style="width: 90px;">&nbsp; &nbsp;  &nbsp;    &nbsp;    &nbsp; &nbsp;  &nbsp;  &nbsp;   &nbsp;   &nbsp;  &nbsp;  &nbsp;  &nbsp;  &nbsp;  &nbsp;  
  &nbsp;  &nbsp;  &nbsp;  &nbsp;  &nbsp;  &nbsp;  &nbsp; &nbsp;&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; </u></p>
<p style="text-align: center;"><b><h3>Uso exclusivo del docente</h3></b></p>
<p style="text-indent: 40px;"><b>Justificacion (en ambos casos aceptado o rechazado) &nbsp; </b>  <u style="width: 90px;">&nbsp; &nbsp;  &nbsp;    &nbsp;    &nbsp; &nbsp;  &nbsp;  &nbsp;   &nbsp;   &nbsp;  &nbsp;  &nbsp;  &nbsp;  &nbsp;  &nbsp;  
  &nbsp;  &nbsp;  &nbsp;  &nbsp;  &nbsp;  &nbsp;  &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; 
  &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;       </u></p>
  <p style="text-indent: 40px;"> <u style="width: 90px;">&nbsp; &nbsp;  &nbsp;    &nbsp;    &nbsp; &nbsp;  &nbsp;  &nbsp;   &nbsp;   &nbsp;  &nbsp;  &nbsp;  &nbsp;  &nbsp;  &nbsp;  
  &nbsp;  &nbsp;  &nbsp;  &nbsp;  &nbsp;  &nbsp;  &nbsp; &nbsp;&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; 
  &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; 
  &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; 
  &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; 
  &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; 
  &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; 
  &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; 
  &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;  &nbsp; &nbsp;  </u></p>
  <p style="text-indent: 40px;"> <u style="width: 90px;">&nbsp; &nbsp;  &nbsp;    &nbsp;    &nbsp; &nbsp;  &nbsp;  &nbsp;   &nbsp;   &nbsp;  &nbsp;  &nbsp;  &nbsp;  &nbsp;  &nbsp;  
  &nbsp;  &nbsp;  &nbsp;  &nbsp;  &nbsp;  &nbsp;  &nbsp; &nbsp;&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; 
  &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; 
  &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; 
  &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; 
  &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; 
  &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; 
  &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; 
  &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;  &nbsp; &nbsp;  </u></p>
  <p style="text-indent: 40px;"> <u style="width: 90px;">&nbsp; &nbsp;  &nbsp;    &nbsp;    &nbsp; &nbsp;  &nbsp;  &nbsp;   &nbsp;   &nbsp;  &nbsp;  &nbsp;  &nbsp;  &nbsp;  &nbsp;  
  &nbsp;  &nbsp;  &nbsp;  &nbsp;  &nbsp;  &nbsp;  &nbsp; &nbsp;&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; 
  &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; 
  &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; 
  &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; 
  &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; 
  &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; 
  &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; 
  &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;  &nbsp; &nbsp;  </u></p>
  <p style="text-indent: 40px;"> <u style="width: 90px;">&nbsp; &nbsp;  &nbsp;    &nbsp;    &nbsp; &nbsp;  &nbsp;  &nbsp;   &nbsp;   &nbsp;  &nbsp;  &nbsp;  &nbsp;  &nbsp;  &nbsp;  
  &nbsp;  &nbsp;  &nbsp;  &nbsp;  &nbsp;  &nbsp;  &nbsp; &nbsp;&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; 
  &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; 
  &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; 
  &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; 
  &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; 
  &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; 
  &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; 
  &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;  &nbsp; &nbsp;  </u></p>
  <p style="text-indent: 40px;"> <u style="width: 90px;">&nbsp; &nbsp;  &nbsp;    &nbsp;    &nbsp; &nbsp;  &nbsp;  &nbsp;   &nbsp;   &nbsp;  &nbsp;  &nbsp;  &nbsp;  &nbsp;  &nbsp;  
  &nbsp;  &nbsp;  &nbsp;  &nbsp;  &nbsp;  &nbsp;  &nbsp; &nbsp;&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; 
  &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; 
  &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; 
  &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; 
  &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; 
  &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; 
  &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; 
  &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;  &nbsp; &nbsp;  </u></p>
  <p style="text-indent: 40px;"> <u style="width: 90px;">&nbsp; &nbsp;  &nbsp;    &nbsp;    &nbsp; &nbsp;  &nbsp;  &nbsp;   &nbsp;   &nbsp;  &nbsp;  &nbsp;  &nbsp;  &nbsp;  &nbsp;  
  &nbsp;  &nbsp;  &nbsp;  &nbsp;  &nbsp;  &nbsp;  &nbsp; &nbsp;&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; 
  &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; 
  &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; 
  &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; 
  &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; 
  &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; 
  &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; 
  &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;  &nbsp; &nbsp;  </u></p>
  <p style="text-indent: 40px;"> <u style="width: 90px;">&nbsp; &nbsp;  &nbsp;    &nbsp;    &nbsp; &nbsp;  &nbsp;  &nbsp;   &nbsp;   &nbsp;  &nbsp;  &nbsp;  &nbsp;  &nbsp;  &nbsp;  
  &nbsp;  &nbsp;  &nbsp;  &nbsp;  &nbsp;  &nbsp;  &nbsp; &nbsp;&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; 
  &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; 
  &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; 
  &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; 
  &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; 
  &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; 
  &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; 
  &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;  &nbsp; &nbsp;  </u></p>
  <br>
  <p style="text-indent: 40px;">Aceptado <?= $this->Form->checkbox("checkboxHEExt", ["disabled" => true, "class" => "checkboxParaHEExt", "id" => "checkboxEstudiante Externa"]);?> &nbsp; Rechazado <?= $this->Form->checkbox("checkboxHEExt", ["disabled" => true, "class" => "checkboxParaHEExt", "id" => "checkboxEstudiante Externa"]);?>   Horas Asignadas &nbsp;<u>&nbsp; &nbsp; &nbsp; &nbsp; </u> </p>
  <br>
  <p style="text-indent: 40px;"><b>Firma del docente (en ambos casos aceptado o rechazado)  &nbsp; </b> <u style="width: 90px;">&nbsp; &nbsp;  &nbsp;    &nbsp;    &nbsp; &nbsp;  &nbsp;  &nbsp;   &nbsp;   &nbsp;  &nbsp;  &nbsp;  &nbsp;  &nbsp;  &nbsp;  
  &nbsp;  &nbsp;  &nbsp;  &nbsp;  &nbsp;  &nbsp;  &nbsp; &nbsp;&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; </u></p>
</body>
 </div>