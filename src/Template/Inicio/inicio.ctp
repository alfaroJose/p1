 
<?= $this->Html->image('ucrLogo.png', ['alt' => 'CakePHP']);?><?= $this->html->image('ecciLogo.png',['alt' => 'CakePHP']);?>

<h4>
<div class = "text-center">
 Bienvenido al Sistema de Asistencias de la                 <br>
 Escuela de Ciencias de la Computación e Informática        <br>
</h4>
<br>
        <?php echo "<center>";?>
                <td class="Opciones">
                    <?= $this->html->link(__('Continuar'), ['controller' => 'Inicio', 'action' => 'login']) ?> <br>
                    <?= $this->html->link(__('Saltar-a-Users'), ['controller' => 'Users', 'action' => 'index']) ?>
                </td>
        <?php echo "</center>";?>        

