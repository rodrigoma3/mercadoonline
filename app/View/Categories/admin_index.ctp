<div class="categories index">
	<h2><?php echo __('Categorias'); ?></h2>
	<table class="table table-striped table-bordered table-hover" id="dataTables">
		<thead>
			<tr>
				<th>#</th>
				<th>Nome</th>
				<th>Descrição</th>
				<th>Seção</th>
				<th>Ações</th>
			</tr>
		</thead>
		<tbody>
			<?php foreach ($categories as $category): ?>
			<tr>
				<td><?php echo $category['Category']['id']; ?></td>
				<td><?php echo $category['Category']['name']; ?></td>
				<td><?php echo $category['Category']['description']; ?></td>
				<td>
					<?php echo $this->Html->link($category['Section']['name'], array('controller' => 'sections', 'action' => 'view', $category['Section']['id'])); ?>
				</td>
				<td class="actions">
					<?php echo $this->Html->link('<i class="fa fa-eye"></i>', array('action' => 'view', $category['Category']['id']), array('escape' => false, 'title' => 'ver')); ?>
					&nbsp;
					<?php echo $this->Html->link('<i class="fa fa-pencil"></i>', array('action' => 'edit', $category['Category']['id']), array('escape' => false, 'title' => 'editar')); ?>
					&nbsp;
					<?php echo $this->Form->postLink('<i class="fa fa-trash"></i>', array('action' => 'delete', $category['Category']['id']), array('confirm' => __('Are you sure you want to delete # %s?', $category['Category']['id']), 'escape' => false, 'title' => 'deletar')); ?>
				</td>
			</tr>
			<?php endforeach; ?>
		</tbody>
	</table>
</div>
<div class="actions">
	<?php echo $this->Html->link(__('Nova Categoria'), array('action' => 'add')); ?>
</div>
