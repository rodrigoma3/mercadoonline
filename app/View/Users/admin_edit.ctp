<div class="users form form-group">
<?php echo $this->Form->create('User', array('url' => 'edit')); ?>
	<fieldset>
		<legend><?php echo __('Editar Usuário'); ?></legend>
	<?php
		echo $this->Form->input('id');
		echo $this->Form->input('name', array('label' => 'Nome', 'class' => 'form-control'));
		echo $this->Form->input('username', array('label' => 'Usuário', 'class' => 'form-control'));
		echo $this->Form->input('cpf', array('label' => 'CPF', 'class' => 'form-control'));
		echo $this->Form->input('email', array('label' => 'Email', 'class' => 'form-control'));
		echo $this->Form->input('password', array('label' => 'Senha', 'class' => 'form-control'));
		echo $this->Form->input('confirmPassword', array('label' => 'Confirme a Senha', 'type' => 'password', 'class' => 'form-control'));
		echo $this->Form->input('role_id', array('label' => 'Função', 'class' => 'form-control'));
	?>
	</fieldset>
</div>
<div class="actions">
	<?php echo $this->Form->end(array('label' => 'Salvar', 'div' => false)); ?>
	<?php echo $this->Html->link(__('Listar Usuários'), array('action' => 'index')); ?>
	<?php echo $this->Form->postLink(__('Deletar'), array('action' => 'delete', $this->Form->value('User.id')), array('confirm' => __('Are you sure you want to delete # %s?', $this->Form->value('User.id')))); ?>
</div>
