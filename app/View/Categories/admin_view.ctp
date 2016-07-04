<div class="categories view">
<h2><?php echo __('Categoria'); ?></h2>
	<dl>
		<dt><?php echo __('ID'); ?></dt>
		<dd><?php echo $category['Category']['id']; ?>&nbsp;</dd>
		<dt><?php echo __('Nome'); ?></dt>
		<dd><?php echo $category['Category']['name']; ?>&nbsp;</dd>
		<dt><?php echo __('Descrição'); ?></dt>
		<dd><?php echo $category['Category']['description']; ?>&nbsp;</dd>
		<dt><?php echo __('Seção'); ?></dt>
		<dd><?php echo $this->Html->link($category['Section']['name'], array('controller' => 'sections', 'action' => 'view', $category['Section']['id'])); ?>&nbsp;</dd>
	</dl>
</div>
<div class="actions">
	<?php echo $this->Html->link(__('Editar Categoria'), array('action' => 'edit', $category['Category']['id'])); ?>
	<?php echo $this->Form->postLink(__('Deletar Categoria'), array('action' => 'delete', $category['Category']['id']), array('confirm' => __('Are you sure you want to delete # %s?', $category['Category']['id']))); ?>
	<?php echo $this->Html->link(__('Listar Categorias'), array('action' => 'index')); ?>
</div>
<legend></legend>
<div class="related">
	<h3><?php echo __('Produtos Relacionados'); ?></h3>
	<?php if (!empty($category['Product'])): ?>
	<table class="table table-striped table-bordered table-hover" id="dataTables">
		<thead>

			<tr>
				<th>#</th>
				<th>Nome</th>
				<th>Descrição</th>
				<th>Fabricante</th>
				<th>Ações</th>
			</tr>
		</thead>
		<tbody>
			<?php foreach ($category['Product'] as $product): ?>
			<tr>
				<td><?php echo $product['id']; ?></td>
				<td><?php echo $product['name']; ?></td>
				<td><?php echo $product['description']; ?></td>
				<td><?php echo $product['manufacturer_id']; ?></td>
				<td>
					<?php echo $this->Html->link('<i class="fa fa-eye"></i>', array('controller' => 'products', 'action' => 'view', $product['id']), array('escape' => false, 'title' => 'ver')); ?>
					&nbsp;
					<?php echo $this->Html->link('<i class="fa fa-pencil"></i>', array('controller' => 'products', 'action' => 'edit', $product['id']), array('escape' => false, 'title' => 'editar')); ?>
					&nbsp;
					<?php echo $this->Form->postLink('<i class="fa fa-trash"></i>', array('controller' => 'products', 'action' => 'delete', $product['id']), array('confirm' => __('Are you sure you want to delete # %s?', $product['id']), 'escape' => false, 'title' => 'deletar')); ?>
				</td>
			</tr>
			<?php endforeach; ?>
		</tbody>
	</table>
<?php endif; ?>
</div>
