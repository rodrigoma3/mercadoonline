<div class="users view">
<h2><?php echo __('Usuário'); ?></h2>
	<dl>
		<dt><?php echo __('ID'); ?></dt>
		<dd><?php echo $user['User']['id']; ?>&nbsp;</dd>
		<dt><?php echo __('Nome'); ?></dt>
		<dd><?php echo $user['User']['name']; ?>&nbsp;</dd>
		<dt><?php echo __('Usuário'); ?></dt>
		<dd><?php echo $user['User']['username']; ?>&nbsp;</dd>
		<dt><?php echo __('Email'); ?></dt>
		<dd><?php echo $user['User']['email']; ?>&nbsp;</dd>
		<dt><?php echo __('Criado em'); ?></dt>
		<dd><?php echo $user['User']['created']; ?>&nbsp;</dd>
		<dt><?php echo __('Modificado em'); ?></dt>
		<dd><?php echo $user['User']['modified']; ?>&nbsp;</dd>
		<dt><?php echo __('Função'); ?></dt>
		<dd><?php echo $this->Html->link($user['Role']['name'], array('controller' => 'departments', 'action' => 'view', $user['Role']['id'])); ?>&nbsp;</dd>
		<dt><?php echo __('Último Acesso'); ?></dt>
		<dd><?php echo $user['User']['last_login']; ?>&nbsp;</dd>
	</dl>
</div>
<div class="actions">
	<?php echo $this->Html->link(__('Editar Usuário'), array('action' => 'edit', $user['User']['id'])); ?>
	<?php echo $this->Html->link(__('Trocar Senha do Usuário'), array('action' => 'changePassword', $user['User']['id'])); ?>
	<?php echo $this->Form->postLink(__('Deletar Usuário'), array('action' => 'delete', $user['User']['id']), array('confirm' => __('Are you sure you want to delete # %s?', $user['User']['id']))); ?>
	<?php echo $this->Html->link(__('Listar Usuários'), array('action' => 'index')); ?>
</div>
