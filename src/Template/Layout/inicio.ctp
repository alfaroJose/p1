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
        <main role="main" class="col-md-9 col-lg-12 px-4 pt-5">
        <!-- Linea que permite mostrar los msjs generados -->
        <?= $this->Flash->render() ?>
            <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3">
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
