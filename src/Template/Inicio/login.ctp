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
<?php echo "<center>";?>
<div class="login form large-9 medium-8 columns content">
	<div class="panel">
		<h2 class="text-center">Autenticación</h2>
		<?= $this->Form->create(null,['url' => ['action'=>'login']]); ?>
			<?= $this->Form->input('Usuario', ['templates'=> ['inputContainer'=>'<div class="row col-xs-4 col-sm-4 col-md-4 col-lg-4">{{content}}</div><br>']]); ?>
			<?= $this->Form->input('Contraseña',['type'=> 'password','templates'=> ['inputContainer'=>'<div class="row col-xs-4 col-sm-4 col-md-4 col-lg-4">{{content}}</div><br>']] ); ?>
			<div class="btn-group mr-3" role="group">
				<?= $this->Form->submit('Iniciar Sesión',['class'=>'btn btn-info'], array('class' => 'button','onclick' => 'inicio')); ?>
	 	 	</div>
	 	 	<?= $this->html->link(__('Recuperar Contraseña'), ['controller' => 'Inicio', 'action' => 'contrasena'], ['class'=> 'btn btn-info']) ?> <br>
		<?= $this->Form->end(); ?>
	</div>
</div>
<?php echo "</center>";?>