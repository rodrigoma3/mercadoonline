<div class="users form form-group">
<?php echo $this->Form->create('User'); ?>
	<fieldset>
		<legend><?php echo __('Trocar Senha'); ?></legend>
	<?php
		echo $this->Form->input('id');
		echo $this->Form->input('currentPassword', array('label' => 'Senha Atual', 'type' => 'password', 'class' => 'form-control'));
		echo $this->Form->input('password', array('label' => 'Nova Senha', 'class' => 'form-control'));
		echo $this->Form->input('confirmPassword', array('label' => 'Confirme a Nova Senha', 'type' => 'password', 'class' => 'form-control'));
	?>
	</fieldset>
</div>
<div class="actions">
	<?php echo $this->Form->end(array('label' => 'Salvar', 'div' => false)); ?>
</div>
