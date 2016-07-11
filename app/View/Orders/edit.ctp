<div class="orders form form-group">
<?php echo $this->Form->create('Order'); ?>
	<fieldset>
		<legend><?php echo __('Editar Pedido'); ?></legend>
	<?php
		echo $this->Form->input('id');
		echo $this->Form->checkbox('deliver').'&nbsp;'.$this->Form->label('deliver', 'Entregar');
		echo $this->Form->input('address_to_deliver', array('label' => 'Endereço de Entrega', 'class' => 'form-control'));
		echo $this->Form->label('deliver_on', 'Entregar em');
		echo '<br/>';
		echo $this->Form->datetime('deliver_on', 'DMY', '24', array('class' => 'form-control'));
	?>
	</fieldset>
</div>
<div class="actions">
	<?php echo $this->Form->end(array('label' => 'Salvar', 'div' => false)); ?>
	<?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $this->Form->value('Order.id')), array('confirm' => __('Are you sure you want to delete # %s?', $this->Form->value('Order.id')))); ?>
</div>
