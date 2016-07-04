<div class="departments view">
<h2><?php echo __('Departamento'); ?></h2>
	<dl>
		<dt><?php echo __('ID'); ?></dt>
		<dd><?php echo $department['Department']['id']; ?>&nbsp;</dd>
		<dt><?php echo __('Nome'); ?></dt>
		<dd><?php echo $department['Department']['name']; ?>&nbsp;</dd>
		<dt><?php echo __('Descrição'); ?></dt>
		<dd><?php echo $department['Department']['description']; ?>&nbsp;</dd>
	</dl>
</div>
<div class="actions">
	<?php echo $this->Html->link(__('Editar Departamento'), array('action' => 'edit', $department['Department']['id'])); ?>
	<?php echo $this->Form->postLink(__('Deletar Departamento'), array('action' => 'delete', $department['Department']['id']), array('confirm' => __('Are you sure you want to delete # %s?', $department['Department']['id']))); ?>
	<?php echo $this->Html->link(__('Listar Departamentos'), array('action' => 'index')); ?>
</div>
<legend></legend>
<div class="related">
	<h3><?php echo __('Seções Relacionadas'); ?></h3>
	<?php if (!empty($department['Section'])): ?>
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
			<?php foreach ($department['Section'] as $section): ?>
			<tr>
				<td><?php echo $section['id']; ?></td>
				<td><?php echo $section['name']; ?></td>
				<td><?php echo $section['description']; ?></td>
				<td>
					<?php echo $this->Html->link('<i class="fa fa-eye"></i>', array('controller' => 'sections', 'action' => 'view', $section['id']), array('escape' => false, 'title' => 'ver')); ?>
					&nbsp;
					<?php echo $this->Html->link('<i class="fa fa-pencil"></i>', array('controller' => 'sections', 'action' => 'edit', $section['id']), array('escape' => false, 'title' => 'editar')); ?>
					&nbsp;
					<?php echo $this->Form->postLink('<i class="fa fa-trash"></i>', array('controller' => 'sections', 'action' => 'delete', $section['id']), array('confirm' => __('Are you sure you want to delete # %s?', $section['id']), 'escape' => false, 'title' => 'deletar')); ?>
				</td>
			</tr>
			<?php endforeach; ?>
		</tbody>
	</table>
<?php endif; ?>
</div>
