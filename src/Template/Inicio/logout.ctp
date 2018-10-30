<?= 
$this->request->getSession()->write('id','');?>
<h4>
<div class = "text-center" style="width: 70%; border-style: solid; border-width: 1px; border-color: black; margin: auto; padding: 10px; border-radius: 25px">
<b>Sesión Cerrada</b> <br>
<br>
Usted ha cerrado sesión correctamente
</h4>
<br>
<?php echo "<center>";?>
        <td class="Opciones">
                <?= $this->html->link(__('Volver al Inicio'), ['controller' => 'Inicio', 'action' => 'inicio']) ?> <br>
        </td>
<?php echo "</center>";?>