 
<br>
<br>
<br>

<h4>
<div class = "text-center">
 Bienvenido al Sistema de Asistencias de la                 <br>
 Escuela de Ciencias de la Computación e Informática        <br>
</h4>
<br>
        <?php echo "<center>";?>
                <td class="Opciones">
                    <?= $this->html->link(__('Continuar'), ['controller' => 'Inicio', 'action' => 'login']) ?> <br>
                    <?= $this->html->link(__('Main'), ['controller' => 'Main', 'action' => 'index']) ?>
                </td>
        <?php echo "</center>";?>        

<h6>
    <div class = "text-center">
        <button type = "submit" onclick="google.como"<?php
            ?> >
            Ingresar
            
        </button>
        <button>
            Salir
        </button>
    </div>   
</h6>


