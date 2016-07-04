<div class="departments index">
	<h2><?php echo __('Departamentos'); ?></h2>
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
			<?php foreach ($departments as $department): ?>
			<tr>
				<td><?php echo $department['Department']['id']; ?></td>
				<td><?php echo $department['Department']['name']; ?></td>
				<td><?php echo $department['Department']['description']; ?></td>
				<td>
					<?php echo $this->Html->link('<i class="fa fa-eye"></i>', array('action' => 'view', $department['Department']['id']), array('escape' => false, 'title' => 'ver')); ?>
					&nbsp;
					<?php echo $this->Html->link('<i class="fa fa-pencil"></i>', array('action' => 'edit', $department['Department']['id']), array('escape' => false, 'title' => 'editar')); ?>
					&nbsp;
					<?php echo $this->Form->postLink('<i class="fa fa-trash"></i>', array('action' => 'delete', $department['Department']['id']), array('confirm' => __('Are you sure you want to delete # %s?', $department['Department']['id']), 'escape' => false, 'title' => 'deletar')); ?>
				</td>
			</tr>
		<?php endforeach; ?>
		</tbody>
	</table>
</div>
<div class="actions">
	<?php echo $this->Html->link(__('Novo Departamento'), array('action' => 'add')); ?>
</div>
