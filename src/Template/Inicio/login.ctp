<br>
<?php echo "<center>";?>
<div class="login form large-9 medium-8 columns content">
	<div class="panel">
		<h2 class="text-center">Autenticación</h2>
		<?= $this->Form->create(null,['url' => ['action'=>'login']]); ?>
			<?= $this->Form->input('Usuario', ['templates'=> ['inputContainer'=>'<div class="row col-xs-4 col-sm-4 col-md-4 col-lg-4">{{content}}</div><br>']]); ?>
			<?= $this->Form->input('Contraseña', ['templates'=> ['inputContainer'=>'<div class="row col-xs-4 col-sm-4 col-md-4 col-lg-4">{{content}}</div><br>']],array('type' => 'password')); ?>
			<?= $this->Form->submit('Entrar',['class'=>'btn btn-info float-center'], array('class' => 'button','onclick' => 'inicio')); ?>
		<?= $this->Form->end(); ?>
	</div>
</div>
<?php echo "</center>";?>
