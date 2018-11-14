<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Solicitude[]|\Cake\Collection\CollectionInterface $solicitudes
 */
?>
<div class="imprimir">
<head> 
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
<br>
<table>
  <tbody>
    <br>
    <br>
    <tr style="height: 10px;">
<td style="border-bottom: 1pt solid black;"><?= h($solicitude->usuario->primer_apellido) ?> </td>
<td></td>
<td style="border-bottom: 1pt solid black;"><?= h($solicitude->usuario->segundo_apellido) ?> </td>
<td></td>
  <td style="border-bottom: 1pt solid black;"><?= h($solicitude->usuario->nombre) ?> </td>
  </tr>
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
<td style="border-bottom: 1pt solid black;"><?= h($solicitude->usuario->identificacion) ?> </td>
<td></td>
<td style="border-bottom: 1pt solid black;"><?= h($solicitude->usuario->nombre_usuario) ?> </td>
<td></td>
  <td style="border-bottom: 1pt solid black;"><?= h($solicitude->usuario->telefono) ?> </td>
  <td></td>
  <td style="border-bottom: 1pt solid black;"><?= h($solicitude->usuario->correo) ?> </td>
  </tr>
  </tbody>
  </table>
       
</body>
 </div>