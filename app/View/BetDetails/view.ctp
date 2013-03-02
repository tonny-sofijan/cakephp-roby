<div class="betDetails view">
<h2><?php  echo __('Bet Detail'); ?></h2>
	<dl>
		<dt><?php echo __('Id'); ?></dt>
		<dd>
			<?php echo h($betDetail['BetDetail']['id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Bet'); ?></dt>
		<dd>
			<?php echo $this->Html->link($betDetail['Bet']['id'], array('controller' => 'bets', 'action' => 'view', $betDetail['Bet']['id'])); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Person'); ?></dt>
		<dd>
			<?php echo $this->Html->link($betDetail['Person']['id'], array('controller' => 'people', 'action' => 'view', $betDetail['Person']['id'])); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Club To Bet'); ?></dt>
		<dd>
			<?php echo h($betDetail['BetDetail']['club_to_bet']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Amount Of Bets'); ?></dt>
		<dd>
			<?php echo h($betDetail['BetDetail']['amount_of_bet']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Win Loss'); ?></dt>
		<dd>
			<?php echo h($betDetail['BetDetail']['win_loss']); ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Edit Bet Detail'), array('action' => 'edit', $betDetail['BetDetail']['id'])); ?> </li>
		<li><?php echo $this->Form->postLink(__('Delete Bet Detail'), array('action' => 'delete', $betDetail['BetDetail']['id']), null, __('Are you sure you want to delete # %s?', $betDetail['BetDetail']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('List Bet Details'), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Bet Detail'), array('action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Bets'), array('controller' => 'bets', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Bet'), array('controller' => 'bets', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List People'), array('controller' => 'people', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Person'), array('controller' => 'people', 'action' => 'add')); ?> </li>
	</ul>
</div>
