<h4>

<div class = "text-center" style="width: 70%; border-style: solid; border-width: 1px; border-color: black; margin: auto; padding: 10px; border-radius: 25px">
<b>Error</b> <br>
<br>
Usted no se ha registrado en el sistema o<br>
no tiene suficientes permisos para acceder a la pantalla <br>
Por favor regístrese y vuelva a intentarlo<br>
</h4>
<br>
<?php echo "<center>";?>
        <td class="Opciones">
                <?= $this->html->link(__('Continuar'), ['controller' => 'Inicio', 'action' => 'login']) ?> <br>
        </td>
<?php echo "</center>";?>