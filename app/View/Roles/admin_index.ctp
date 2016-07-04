<div class="roles index">
	<h2><?php echo __('Funções'); ?></h2>
	<table class="table table-striped table-bordered table-hover" id="dataTables">
		<thead>
			<tr>
				<th>#</th>
				<th>Nome</th>
				<th>Descrição</th>
				<th>Ações</th>
			</tr>
		</thead>
		<tbody>
			<?php foreach ($roles as $role): ?>
			<tr>
				<td><?php echo $role['Role']['id']; ?></td>
				<td><?php echo $role['Role']['name']; ?></td>
				<td><?php echo $role['Role']['description']; ?></td>
				<td class="actions">
					<?php echo $this->Html->link('<i class="fa fa-eye"></i>', array('action' => 'view', $role['Role']['id']), array('escape' => false, 'title' => 'ver')); ?>
					&nbsp;
					<?php echo $this->Html->link('<i class="fa fa-pencil"></i>', array('action' => 'edit', $role['Role']['id']), array('escape' => false, 'title' => 'editar')); ?>
					&nbsp;
					<?php echo $this->Form->postLink('<i class="fa fa-trash"></i>', array('action' => 'delete', $role['Role']['id']), array('confirm' => __('Are you sure you want to delete # %s?', $role['Role']['id']), 'escape' => false, 'title' => 'deletar')); ?>
				</td>
			</tr>
			<?php endforeach; ?>
		</tbody>
	</table>
</div>
<div class="actions">
		<?php echo $this->Html->link(__('Nova Função'), array('action' => 'add')); ?>
</div>
