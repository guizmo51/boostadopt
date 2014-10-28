<div class="affiliates view">
<h2><?php echo __('Affiliate'); ?></h2>
	<dl>
		<dt><?php echo __('Parrain'); ?></dt>
		<dd>
			<?php echo $this->Html->link($affiliate['Parrain']['id'], array('controller' => 'users', 'action' => 'view', $affiliate['Parrain']['id'])); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Filleul'); ?></dt>
		<dd>
			<?php echo $this->Html->link($affiliate['Filleul']['id'], array('controller' => 'users', 'action' => 'view', $affiliate['Filleul']['id'])); ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Edit Affiliate'), array('action' => 'edit', $affiliate['Affiliate']['parrain_id'])); ?> </li>
		<li><?php echo $this->Form->postLink(__('Delete Affiliate'), array('action' => 'delete', $affiliate['Affiliate']['parrain_id']), null, __('Are you sure you want to delete # %s?', $affiliate['Affiliate']['parrain_id'])); ?> </li>
		<li><?php echo $this->Html->link(__('List Affiliates'), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Affiliate'), array('action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Users'), array('controller' => 'users', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Parrain'), array('controller' => 'users', 'action' => 'add')); ?> </li>
	</ul>
</div>
