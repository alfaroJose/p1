<?php
/**
 * CakePHP(tm) : Rapid Development Framework (https://cakephp.org)
 * Copyright (c) Cake Software Foundation, Inc. (https://cakefoundation.org)
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright (c) Cake Software Foundation, Inc. (https://cakefoundation.org)
 * @link          https://cakephp.org CakePHP(tm) Project
 * @since         0.10.0
 * @license       https://opensource.org/licenses/mit-license.php MIT License
 */

$cakeDescription = 'CakePHP: the rapid development php framework';
?>
<!DOCTYPE html>
<html>
<head>
    <?= $this->Html->charset() ?>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>
        <?= $cakeDescription ?>:
        <?= $this->fetch('title') ?>
    </title>
    <?= $this->Html->meta('icon')    ?>

    <!-- Espacio donde se cargan los archivos pertinentes a bootstrap -->
    <?= $this->Html->css(['bootstrap.min','jquery.dataTables.min'])?>

    <!-- Aqui agregegué "a mano"   los iconos de typicons por que con el helper no me funcionaba-->
    <link rel="stylesheet" href="plugins/font/typicons.min.css"/></head><body><div class="page-header">
    	
    <?= $this->Html->script(['jquery-3.3.1.min', 'bootstrap.min','jquery.dataTables.min']) ?>

    <?= $this->fetch('meta') ?>
    <?= $this->fetch('css') ?>
    <?= $this->fetch('script') ?>
</head>
<body>

    <nav class="navbar navbar-dark fixed-top flex-md-nowrap p-0 shadow" style="background-color: rgb(65, 173, 231);">     

      <div class = "float-left px-1">   
        <?= $this->Html->image('ucrLogoBlanco.png', ['alt' => 'CakePHP', 'width'=>"245", 'height' => '85']);?>     
      </div>
      <!-- Espacio para el nombre del proyecto. Además se definen columnas-->
      <a class="navbar-brand col-sm-3 col-md-2 mr-0" href="#">Sistema de Asistencias ECCI</a>

      <div class = "float-right px-1">
        <?= $this->html->image('ecciLogo.png',['alt' => 'CakePHP', 'width'=>"250", 'height' => '75']);?>
      </div>


      <!-- Barra de la derecha. Aqui está el sing out y editar perfil-->
      <?php 
        $username = $this->request->getSession()->read('id');
        $idActual = $this->Usuario->getUser($username);
      ?>

      <div class="navbar-nav px-3">
        <?php 
          if ($idActual[0] != null) { //Cuando el usuario se está registrando no hay opción de editar perfil todavía         
            echo ( '<a class="nav-link" href="http://localhost/p1/usuarios/edit/'.$idActual[0].'">Editar perfil</a>'); 
          }
        ?>
      </div>

      <div class="navbar-nav px-3">      
        <a class="nav-link" href="http://localhost/p1/inicio/login">Cerrar Sesión</a>   
      </div>
      
    </nav>
    
    <!-- Div para el contenido de debajo de la página-->
    <br>
    <br>
    
    <!-- barra azul -->
    <br>
    <br>
    <div class = "float-center">   
      <?= $this->Html->image('barra.gif', ['alt' => 'CakePHP', 'width'=>"40%", 'height' => '85']);?>     
    </div>
    
    <div class="container-fluid">

      <div class="row">

        <!-- Barra lateral-->
        <nav class="col-md-2 d-none d-md-block bg-light sidebar">
          <div class="sidebar-sticky pt-5">
            <div style = "padding-left: 5px;border-style: solid; border-color: red; border-width: 0.75px">
        <?php $rondaActual = $this->Ronda->getFila()?>
        <p style = "color:red"><?=$rondaActual[0]?><br><?=$rondaActual[1]?><br><?=$rondaActual[2]?></p>
        </div>
            <ul class="nav flex-column">
              <li class="nav-item">
                <?= $this->Html->link('Roles',['controller'=>'Posee','action'=>'index'],['class'=>'nav-link']) ?>
              </li>                            
              <li class="nav-item">
                <?= $this->Html->link('Usuarios',['controller'=>'Usuarios','action'=>'index'],['class'=>'nav-link']) ?>
              </li> 
              <li class="nav-item">
                <?= $this->Html->link('Cursos',['controller'=>'Grupos','action'=>'index'],['class'=>'nav-link']) ?>
              </li>
              <li class="nav-item">
                <?= $this->Html->link('Requisitos',['controller'=>'Requisitos','action'=>'index'],['class'=>'nav-link']) ?>
              </li>
              <li class="nav-item">
                <?= $this->Html->link('Rondas',['controller'=>'Rondas','action'=>'index'],['class'=>'nav-link']) ?>
              </li>         
            </ul>

          </div>
        </nav>
        <main role="main" class="col-md-9 ml-sm-auto col-lg-10 px-4 pt-5">
          <!-- Linea que permite mostrar los msjs generados -->
          <?= $this->Flash->render() ?>
            <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
                

                <!-- Div que encapsula las vistas de los módulos-->
                <div class="container clearfix">
                    <?= $this->fetch('content') ?>
                </div>
            </div>
        </main>
    <footer>
    </footer>
</body>
</html>
