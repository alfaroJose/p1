<div class = "float-right">   
         <?= $this->Html->image('ucrLogo.png', ['alt' => 'CakePHP']);?>     
</div>
 <div class = "float-left">
         <?= $this->html->image('ecciLogo.png',['alt' => 'CakePHP']);?>
 </div>
<br><br>
<br><br>
<br><br>
<br><br>
<h4>
<div class = "text-center">
 Bienvenido al Sistema de Asistencias de la                 <br>
 Escuela de Ciencias de la Computación e Informática        <br>
</h4>
<br>
<?php echo "<center>";?>
        <td class="Opciones">
                <?= $this->html->link(__('Continuar'), ['controller' => 'Inicio', 'action' => 'login']) ?> <br>
        </td>
<?php echo "</center>";?>