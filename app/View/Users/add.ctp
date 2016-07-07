<div class="users form form-group div-centered">
<?php echo $this->Form->create('User'); ?>
	<fieldset>
		<legend><?php echo __('Cadastro de Cliente'); ?></legend>
	<?php
	echo $this->Form->input('name', array('label' => 'Nome', 'class' => 'form-control'));
	echo $this->Form->input('username', array('label' => 'Usuário', 'class' => 'form-control'));
	echo $this->Form->input('cpf', array('label' => 'CPF', 'class' => 'form-control'));
	echo $this->Form->input('email', array('label' => 'Email', 'class' => 'form-control'));
	echo $this->Form->input('password', array('label' => 'Senha', 'class' => 'form-control'));
	echo $this->Form->input('confirmPassword', array('label' => 'Confirme a Senha', 'type' => 'password', 'class' => 'form-control'));
	?>
	</fieldset>
</div>
<div class="actions div-centered">
	<?php echo $this->Form->end(array('label' => 'Salvar', 'div' => false)); ?>
</div>
