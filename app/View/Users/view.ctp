<div class="users view">
<h2><?php echo __($user['User']['name']); ?></h2>
	<dl>
		<dt><?php echo 'Usuário'; ?></dt>
		<dd><?php echo $user['User']['username']; ?>&nbsp;</dd>
		<?php if ($this->Session->read('Auth.User.role_id') == '3'): ?>
			<dt><?php echo 'CPF'; ?></dt>
			<dd><?php echo $user['User']['cpf']; ?>&nbsp;</dd>
		<?php endif; ?>
		<dt><?php echo 'Email'; ?></dt>
		<dd><?php echo $user['User']['email']; ?>&nbsp;</dd>
		<dt><?php echo 'Criado em'; ?></dt>
		<dd><?php echo $user['User']['created']; ?>&nbsp;</dd>
		<dt><?php echo 'Modificado em'; ?></dt>
		<dd><?php echo $user['User']['modified']; ?>&nbsp;</dd>
		<dt><?php echo 'Último acesso'; ?></dt>
		<dd><?php echo $user['User']['last_login']; ?>&nbsp;</dd>
	</dl>
</div>
<div class="actions">
	<?php echo $this->Html->link(__('Editar Usuário'), array('action' => 'edit', $user['User']['id'])); ?>
	<?php echo $this->Html->link(__('Trocar Senha'), array('action' => 'changePassword', $user['User']['id'])); ?>
	<?php if($this->Session->read('Auth.User.role_id') == '3') echo $this->Form->postLink(__('Deletar Usuário'), array('action' => 'delete', $user['User']['id']), array('confirm' => __('Are you sure you want to delete # %s?', $user['User']['id']))); ?>
	<?php if ($this->Session->read('Auth.User.role_id') == '3'): ?>
		<hr>
	<?php endif; ?>
</div>
<?php if ($this->Session->read('Auth.User.role_id') == '3'): ?>
	<div class="related">
		<h3><?php echo __('Endereços Cadastrados'); ?></h3>
		<?php if (!empty($user['Address'])): ?>
		<table class="table table-striped table-bordered table-hover datatable">
			<thead>
				<tr>
					<th>#</th>
					<th>CEP</th>
					<th>Endereço</th>
					<th>Bairro</th>
					<th>Cidade</th>
					<th>Estado</th>
					<th>Ações</th>
				</tr>
			</thead>
			<tbody>
				<?php foreach ($user['Address'] as $address): ?>
					<tr>
						<td><?php echo $address['id']; ?></td>
						<td><?php echo $address['cep']; ?></td>
						<td><?php echo $address['address']; ?></td>
						<td><?php echo $address['neighborhood']; ?></td>
						<td><?php echo $address['city']; ?></td>
						<td><?php echo $address['state']; ?></td>
						<td class="actions">
							<?php echo $this->Html->link('<i class="fa fa-pencil"></i>', array('controller' => 'addresses', 'action' => 'edit', $address['id']), array('escape' => false, 'title' => 'editar')); ?>
							&nbsp;
							<?php echo $this->Form->postLink('<i class="fa fa-trash"></i>', array('controller' => 'addresses', 'action' => 'delete', $address['id']), array('confirm' => __('Are you sure you want to delete # %s?', $address['id']), 'escape' => false, 'title' => 'excluir')); ?>
						</td>
					</tr>
				<?php endforeach; ?>
			</tbody>
		</table>
	<?php endif; ?>

		<div class="actions">
			<?php echo $this->Html->link(__('Novo Endereço'), array('controller' => 'addresses', 'action' => 'add')); ?>
			<hr>
		</div>
	</div>
	<div class="related">
		<h3><?php echo __('Histórico de Pedidos'); ?></h3>
		<?php if (!empty($user['Order'])): ?>
		<table class="table table-striped table-bordered table-hover datatable">
			<thead>
				<tr>
					<th>Nº</th>
					<th>Criado em</th>
					<th>Modificado em</th>
					<th>Situação</th>
					<th>Valor Total</th>
					<th>Ações</th>
				</tr>
			</thead>
			<tbody>
				<?php foreach ($user['Order'] as $order): ?>
					<tr>
						<td><?php echo $order['id']; ?></td>
						<td><?php echo $order['created']; ?></td>
						<td><?php echo $order['modified']; ?></td>
						<td><?php echo $situations[$order['situation_id']]; ?></td>
						<td><?php echo $order['total_price']; ?></td>
						<td class="actions">
							<?php echo $this->Html->link('<i class="fa fa-eye"></i>', array('controller' => 'orders', 'action' => 'view', $order['id']), array('escape' => false, 'title' => 'ver')); ?>
							&nbsp;
							<?php echo $this->Html->link('<i class="fa fa-pencil"></i>', array('controller' => 'orders', 'action' => 'edit', $order['id']), array('escape' => false, 'title' => 'editar')); ?>
							&nbsp;
							<?php echo $this->Form->postLink('<i class="fa fa-trash"></i>', array('controller' => 'orders', 'action' => 'delete', $order['id']), array('confirm' => __('Are you sure you want to delete # %s?', $order['id']), 'escape' => false, 'title' => 'cancelar')); ?>
						</td>
					</tr>
				<?php endforeach; ?>
			</tbody>
		</table>
	<?php endif; ?>
	</div>
<?php endif; ?>
