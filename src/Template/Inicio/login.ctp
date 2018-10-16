<br>
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