<div class="roles view">
<h2><?php echo __('Função'); ?></h2>
	<dl>
		<dt><?php echo __('ID'); ?></dt>
		<dd><?php echo $role['Role']['id']; ?>&nbsp;</dd>
		<dt><?php echo __('Nome'); ?></dt>
		<dd><?php echo $role['Role']['name']; ?>&nbsp;</dd>
		<dt><?php echo __('Descrição'); ?></dt>
		<dd><?php echo $role['Role']['description']; ?>&nbsp;</dd>
	</dl>
</div>
<div class="actions">
	<?php echo $this->Html->link(__('Editar Função'), array('action' => 'edit', $role['Role']['id'])); ?>
	<?php echo $this->Form->postLink(__('Deletar Função'), array('action' => 'delete', $role['Role']['id']), array('confirm' => __('Are you sure you want to delete # %s?', $role['Role']['id']))); ?>
	<?php echo $this->Html->link(__('Listar Funções'), array('action' => 'index')); ?>
</div>
<legend></legend>
<div class="related">
	<h3><?php echo __('Usuários Relacionados'); ?></h3>
	<?php if (!empty($role['User'])): ?>
	<table class="table table-striped table-bordered table-hover" id="dataTables">
		<thead>
			<tr>
				<th>#</th>
				<th>Nome</th>
				<th>Usuário</th>
				<th>Email</th>
				<th>Último Acesso</th>
				<th>Ações</th>
			</tr>
		</thead>
		<tbody>
			<?php foreach ($role['User'] as $user): ?>
			<tr>
				<td><?php echo $user['id']; ?></td>
				<td><?php echo $user['name']; ?></td>
				<td><?php echo $user['username']; ?></td>
				<td><?php echo $user['email']; ?></td>
				<td><?php echo $user['last_login']; ?></td>
				<td class="actions">
					<?php echo $this->Html->link('<i class="fa fa-eye"></i>', array('controller' => 'users', 'action' => 'view', $user['id']), array('escape' => false, 'title' => 'ver')); ?>
					&nbsp;
					<?php echo $this->Html->link('<i class="fa fa-pencil"></i>', array('controller' => 'users', 'action' => 'edit', $user['id']), array('escape' => false, 'title' => 'editar')); ?>
					&nbsp;
					<?php echo $this->Form->postLink('<i class="fa fa-trash"></i>', array('controller' => 'users', 'action' => 'delete', $user['id']), array('confirm' => __('Are you sure you want to delete # %s?', $user['id']), 'escape' => false, 'title' => 'deletar')); ?>
				</td>
			</tr>
			<?php endforeach; ?>
		</tbody>
	</table>
<?php endif; ?>
</div>
