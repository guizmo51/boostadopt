<div class="rechargements view">
<h2><?php echo __('Rechargement'); ?></h2>
	<dl>
		<dt><?php echo __('Id'); ?></dt>
		<dd>
			<?php echo h($rechargement['Rechargement']['id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Date'); ?></dt>
		<dd>
			<?php echo h($rechargement['Rechargement']['date']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Credit Value'); ?></dt>
		<dd>
			<?php echo h($rechargement['Rechargement']['credit_value']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Credit Before'); ?></dt>
		<dd>
			<?php echo h($rechargement['Rechargement']['credit_before']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Credit After'); ?></dt>
		<dd>
			<?php echo h($rechargement['Rechargement']['credit_after']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Id Transaction'); ?></dt>
		<dd>
			<?php echo h($rechargement['Rechargement']['id_transaction']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Users'); ?></dt>
		<dd>
			<?php echo $this->Html->link($rechargement['Users']['id'], array('controller' => 'users', 'action' => 'view', $rechargement['Users']['id'])); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Coupons'); ?></dt>
		<dd>
			<?php echo $this->Html->link($rechargement['Coupons']['id'], array('controller' => 'coupons', 'action' => 'view', $rechargement['Coupons']['id'])); ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Edit Rechargement'), array('action' => 'edit', $rechargement['Rechargement']['id'])); ?> </li>
		<li><?php echo $this->Form->postLink(__('Delete Rechargement'), array('action' => 'delete', $rechargement['Rechargement']['id']), null, __('Are you sure you want to delete # %s?', $rechargement['Rechargement']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('List Rechargements'), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Rechargement'), array('action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Users'), array('controller' => 'users', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Users'), array('controller' => 'users', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Coupons'), array('controller' => 'coupons', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Coupons'), array('controller' => 'coupons', 'action' => 'add')); ?> </li>
	</ul>
</div>
