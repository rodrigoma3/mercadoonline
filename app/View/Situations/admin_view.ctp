<div class="situations view">
<h2><?php echo __('Situação'); ?></h2>
	<dl>
		<dt><?php echo __('ID'); ?></dt>
		<dd><?php echo $situation['Situation']['id']; ?>&nbsp;</dd>
		<dt><?php echo __('Nome'); ?></dt>
		<dd><?php echo $situation['Situation']['name']; ?>&nbsp;</dd>
		<dt><?php echo __('Descrição'); ?></dt>
		<dd><?php echo $situation['Situation']['description']; ?>&nbsp;</dd>
	</dl>
</div>
<div class="actions">
	<?php echo $this->Html->link(__('Editar Situação'), array('action' => 'edit', $situation['Situation']['id'])); ?>
	<?php echo $this->Form->postLink(__('Deletar Situação'), array('action' => 'delete', $situation['Situation']['id']), array('confirm' => __('Are you sure you want to delete # %s?', $situation['Situation']['id']))); ?>
	<?php echo $this->Html->link(__('Listar Situações'), array('action' => 'index')); ?>
</div>
