<div class="sections form form-group">
<?php echo $this->Form->create('Section', array('url' => 'edit')); ?>
	<fieldset>
		<legend><?php echo __('Editar Seção'); ?></legend>
	<?php
		echo $this->Form->input('id');
		echo $this->Form->input('name', array('label' => 'Nome', 'class' => 'form-control'));
		echo $this->Form->input('description', array('label' => 'Descrição', 'class' => 'form-control'));
		echo $this->Form->input('department_id', array('label' => 'Departamento', 'class' => 'form-control'));
	?>
	</fieldset>
</div>
<div class="actions">
	<?php echo $this->Form->end(array('label' => 'Salvar', 'div' => false)); ?>
	<?php echo $this->Html->link(__('Listar Seções'), array('action' => 'index')); ?>
	<?php echo $this->Form->postLink(__('Deletar'), array('action' => 'delete', $this->Form->value('Section.id')), array('confirm' => __('Are you sure you want to delete # %s?', $this->Form->value('Section.id')))); ?>
</div>
