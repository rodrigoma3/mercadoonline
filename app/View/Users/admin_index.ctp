<div class="users index">
	<h2><?php echo __('Usuários'); ?></h2>
	<table class="table table-striped table-bordered table-hover" id="dataTables">
		<thead>
			<tr>
				<th>#</th>
				<th>Nome</th>
				<th>Usuário</th>
				<th>Email</th>
				<th>Função</th>
				<th>Último Acesso</th>
				<th>Ações</th>
			</tr>
		</thead>
		<tbody>
			<?php foreach ($users as $user): ?>
			<tr>
				<td><?php echo $user['User']['id']; ?></td>
				<td><?php echo $user['User']['name']; ?></td>
				<td><?php echo $user['User']['username']; ?></td>
				<td><?php echo $user['User']['email']; ?></td>
				<td>
					<?php echo $this->Html->link($user['Role']['name'], array('controller' => 'roles', 'action' => 'view', $user['Role']['id'])); ?>
				</td>
				<td><?php echo $user['User']['last_login']; ?></td>
				<td class="actions">
					<?php echo $this->Html->link('<i class="fa fa-eye"></i>', array('action' => 'view', $user['User']['id']), array('escape' => false, 'title' => 'ver')); ?>
					&nbsp;
					<?php echo $this->Html->link('<i class="fa fa-pencil"></i>', array('action' => 'edit', $user['User']['id']), array('escape' => false, 'title' => 'editar')); ?>
					&nbsp;
					<?php echo $this->Form->postLink('<i class="fa fa-trash"></i>', array('action' => 'delete', $user['User']['id']), array('confirm' => __('Are you sure you want to delete # %s?', $user['User']['id']), 'escape' => false, 'title' => 'deletar')); ?>
				</td>
			</tr>
			<?php endforeach; ?>
		</tbody>
	</table>
</div>
<div class="actions">
	<?php echo $this->Html->link(__('Novo Usuário'), array('action' => 'add')); ?>
</div>
