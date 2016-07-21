<div class="sections view">
<h2><?php echo __('Seção'); ?></h2>
	<dl>
		<dt><?php echo __('ID'); ?></dt>
		<dd><?php echo $section['Section']['id']; ?>&nbsp;</dd>
		<dt><?php echo __('Nome'); ?></dt>
		<dd><?php echo $section['Section']['name']; ?>&nbsp;</dd>
		<dt><?php echo __('Descrição'); ?></dt>
		<dd><?php echo $section['Section']['description']; ?>&nbsp;</dd>
	</dl>
</div>
<div class="actions">
	<?php echo $this->Html->link(__('Editar Seção'), array('action' => 'edit', $section['Section']['id'])); ?>
	<?php echo $this->Form->postLink(__('Deletar Seção'), array('action' => 'delete', $section['Section']['id']), array('confirm' => __('Are you sure you want to delete # %s?', $section['Section']['id']))); ?>
	<?php echo $this->Html->link(__('Listar Seções'), array('action' => 'index')); ?>
</div>
<legend></legend>
<div class="related">
	<h3><?php echo __('Categorias Relacionadas'); ?></h3>
	<?php if (!empty($section['Category'])): ?>
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
			<?php foreach ($section['Category'] as $category): ?>
			<tr>
				<td><?php echo $category['id']; ?></td>
				<td><?php echo $category['name']; ?></td>
				<td><?php echo $category['description']; ?></td>
				<td>
					<?php echo $this->Html->link('<i class="fa fa-eye"></i>', array('controller' => 'categories', 'action' => 'view', $category['id']), array('escape' => false, 'title' => 'ver')); ?>
					&nbsp;
					<?php echo $this->Html->link('<i class="fa fa-pencil"></i>', array('controller' => 'categories', 'action' => 'edit', $category['id']), array('escape' => false, 'title' => 'editar')); ?>
					&nbsp;
					<?php echo $this->Form->postLink('<i class="fa fa-trash"></i>', array('controller' => 'categories', 'action' => 'delete', $category['id']), array('confirm' => __('Are you sure you want to delete # %s?', $category['id']), 'escape' => false, 'title' => 'deletar')); ?>
				</td>
			</tr>
			<?php endforeach; ?>
		</tbody>
	</table>
<?php endif; ?>
</div>
