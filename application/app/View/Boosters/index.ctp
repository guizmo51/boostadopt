<div class="boosters index">
	<h2><?php echo __('Boosters'); ?></h2>
	<table cellpadding="0" cellspacing="0">
	<tr>
			<th><?php echo $this->Paginator->sort('id'); ?></th>
			<th><?php echo $this->Paginator->sort('date_debut'); ?></th>
			<th><?php echo $this->Paginator->sort('date_fin'); ?></th>
			<th><?php echo $this->Paginator->sort('nb_profiles'); ?></th>
			<th><?php echo $this->Paginator->sort('users_id'); ?></th>
			<th class="actions"><?php echo __('Actions'); ?></th>
	</tr>
	<?php foreach ($boosters as $booster): ?>
	<tr>
		<td><?php echo h($booster['Booster']['id']); ?>&nbsp;</td>
		<td><?php echo h($booster['Booster']['date_debut']); ?>&nbsp;</td>
		<td><?php echo h($booster['Booster']['date_fin']); ?>&nbsp;</td>
		<td><?php echo h($booster['Booster']['nb_profiles']); ?>&nbsp;</td>
		<td>
			<?php echo $this->Html->link($booster['Users']['id'], array('controller' => 'users', 'action' => 'view', $booster['Users']['id'])); ?>
		</td>
		<td class="actions">
			<?php echo $this->Html->link(__('View'), array('action' => 'view', $booster['Booster']['id'])); ?>
			<?php echo $this->Html->link(__('Edit'), array('action' => 'edit', $booster['Booster']['id'])); ?>
			<?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $booster['Booster']['id']), null, __('Are you sure you want to delete # %s?', $booster['Booster']['id'])); ?>
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
		<li><?php echo $this->Html->link(__('New Booster'), array('action' => 'add')); ?></li>
		<li><?php echo $this->Html->link(__('List Users'), array('controller' => 'users', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Users'), array('controller' => 'users', 'action' => 'add')); ?> </li>
	</ul>
</div>
