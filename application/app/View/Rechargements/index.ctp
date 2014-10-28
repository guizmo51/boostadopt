<div class="rechargements index">
	<h2><?php echo __('Rechargements'); ?></h2>
	<table cellpadding="0" cellspacing="0">
	<tr>
			<th><?php echo $this->Paginator->sort('id'); ?></th>
			<th><?php echo $this->Paginator->sort('date'); ?></th>
			<th><?php echo $this->Paginator->sort('credit_value'); ?></th>
			<th><?php echo $this->Paginator->sort('credit_before'); ?></th>
			<th><?php echo $this->Paginator->sort('credit_after'); ?></th>
			<th><?php echo $this->Paginator->sort('id_transaction'); ?></th>
			<th><?php echo $this->Paginator->sort('users_id'); ?></th>
			<th><?php echo $this->Paginator->sort('coupons_id'); ?></th>
			<th class="actions"><?php echo __('Actions'); ?></th>
	</tr>
	<?php foreach ($rechargements as $rechargement): ?>
	<tr>
		<td><?php echo h($rechargement['Rechargement']['id']); ?>&nbsp;</td>
		<td><?php echo h($rechargement['Rechargement']['date']); ?>&nbsp;</td>
		<td><?php echo h($rechargement['Rechargement']['credit_value']); ?>&nbsp;</td>
		<td><?php echo h($rechargement['Rechargement']['credit_before']); ?>&nbsp;</td>
		<td><?php echo h($rechargement['Rechargement']['credit_after']); ?>&nbsp;</td>
		<td><?php echo h($rechargement['Rechargement']['id_transaction']); ?>&nbsp;</td>
		<td>
			<?php echo $this->Html->link($rechargement['Users']['id'], array('controller' => 'users', 'action' => 'view', $rechargement['Users']['id'])); ?>
		</td>
		<td>
			<?php echo $this->Html->link($rechargement['Coupons']['id'], array('controller' => 'coupons', 'action' => 'view', $rechargement['Coupons']['id'])); ?>
		</td>
		<td class="actions">
			<?php echo $this->Html->link(__('View'), array('action' => 'view', $rechargement['Rechargement']['id'])); ?>
			<?php echo $this->Html->link(__('Edit'), array('action' => 'edit', $rechargement['Rechargement']['id'])); ?>
			<?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $rechargement['Rechargement']['id']), null, __('Are you sure you want to delete # %s?', $rechargement['Rechargement']['id'])); ?>
		</td>
	</tr>
<?php endforeach; ?>
	</table>
	<p>
	<?php
	echo $this->Paginator->counter(array(
	'format' => __('Page {:page} of {:pages}, showing {:current} records out of {:count} total, starting on record {:start}, ending on {:end}')
	));
	?>	</p>
	<div class="paging">
	<?php
		echo $this->Paginator->prev('< ' . __('previous'), array(), null, array('class' => 'prev disabled'));
		echo $this->Paginator->numbers(array('separator' => ''));
		echo $this->Paginator->next(__('next') . ' >', array(), null, array('class' => 'next disabled'));
	?>
	</div>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('New Rechargement'), array('action' => 'add')); ?></li>
		<li><?php echo $this->Html->link(__('List Users'), array('controller' => 'users', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Users'), array('controller' => 'users', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Coupons'), array('controller' => 'coupons', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Coupons'), array('controller' => 'coupons', 'action' => 'add')); ?> </li>
	</ul>
</div>
