<div class="orders form form-group">
<?php echo $this->Form->create('Order'); ?>
	<fieldset>
		<legend><?php echo __('Adicionar Pedido'); ?></legend>
	<?php
		echo $this->Form->input('total_price', array('label' => 'Total', 'class' => 'form-control', 'disabled' => true));
		echo $this->Form->checkbox('deliver').'&nbsp;'.$this->Form->label('deliver', 'Entregar');
		echo $this->Form->input('address_to_deliver', array('label' => 'Endereço de Entrega', 'class' => 'form-control'));
		echo $this->Form->label('deliver_on', 'Entregar em');
		echo '<br/>';
		echo $this->Form->datetime('deliver_on', 'DMY', '24', array('class' => 'form-control date'));
	?>
	</fieldset>
</div>
<div class="actions">
	<?php echo $this->Form->end(array('label' => 'Salvar', 'div' => false)); ?>
</div>
