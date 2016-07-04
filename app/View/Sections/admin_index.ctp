<div class="sections index">
	<h2><?php echo __('Seções'); ?></h2>
	<table class="table table-striped table-bordered table-hover" id="dataTables">
		<thead>
			<tr>
				<th>#</th>
				<th>Nome</th>
				<th>Descrição</th>
				<th>Departamento</th>
				<th>Ações</th>
			</tr>
		</thead>
		<tbody>
			<?php foreach ($sections as $section): ?>
			<tr>
				<td><?php echo $section['Section']['id']; ?></td>
				<td><?php echo $section['Section']['name']; ?></td>
				<td><?php echo $section['Section']['description']; ?></td>
				<td>
					<?php echo $this->Html->link($section['Department']['name'], array('controller' => 'departments', 'action' => 'view', $section['Department']['id'])); ?>
				</td>
				<td>
					<?php echo $this->Html->link('<i class="fa fa-eye"></i>', array('action' => 'view', $section['Section']['id']), array('escape' => false, 'title' => 'ver')); ?>
					&nbsp;
					<?php echo $this->Html->link('<i class="fa fa-pencil"></i>', array('action' => 'edit', $section['Section']['id']), array('escape' => false, 'title' => 'editar')); ?>
					&nbsp;
					<?php echo $this->Form->postLink('<i class="fa fa-trash"></i>', array('action' => 'delete', $section['Section']['id']), array('confirm' => __('Are you sure you want to delete # %s?', $section['Section']['id']), 'escape' => false, 'title' => 'deletar')); ?>
				</td>
			</tr>
			<?php endforeach; ?>
		</tbody>
	</table>
</div>
<div class="actions">
	<?php echo $this->Html->link(__('Nova Seção'), array('action' => 'add')); ?>
</div>
