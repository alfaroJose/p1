<br>
<div class="index large-4 medium-4 medium-offset-4 medium-offset-4 columns">
	<div class="panel">
		<h2 class="text-center">Autenticación</h2>
		<?= $this->Form->create(null,['url' => ['action'=>'login']]); ?>
			<?= $this->Form->input('Usuario'); ?>
			<?= $this->Form->input('Contraseña', array('type' => 'password')); ?>
			<?= $this->Form->submit('Entrar', array('class' => 'button','onclick' => 'inicio')); ?>
		<?= $this->Form->end(); ?>
	</div>
</div>
