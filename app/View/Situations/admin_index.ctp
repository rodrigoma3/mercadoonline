<div class="situations index">
	<h2><?php echo __('Situações'); ?></h2>
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
			<?php foreach ($situations as $situation): ?>
			<tr>
				<td><?php echo $situation['Situation']['id']; ?></td>
				<td><?php echo $situation['Situation']['name']; ?></td>
				<td><?php echo $situation['Situation']['description']; ?></td>
				<td class="actions">
					<?php echo $this->Html->link('<i class="fa fa-eye"></i>', array('action' => 'view', $situation['Situation']['id']), array('escape' => false, 'title' => 'ver')); ?>
					&nbsp;
					<?php echo $this->Html->link('<i class="fa fa-pencil"></i>', array('action' => 'edit', $situation['Situation']['id']), array('escape' => false, 'title' => 'editar')); ?>
					&nbsp;
					<?php echo $this->Form->postLink('<i class="fa fa-trash"></i>', array('action' => 'delete', $situation['Situation']['id']), array('confirm' => __('Are you sure you want to delete # %s?', $situation['Situation']['id']), 'escape' => false, 'title' => 'deletar')); ?>
				</td>
			</tr>
			<?php endforeach; ?>
		</tbody>
	</table>
</div>
<div class="actions">
		<?php echo $this->Html->link(__('Nova Situação'), array('action' => 'add')); ?>
</div>
