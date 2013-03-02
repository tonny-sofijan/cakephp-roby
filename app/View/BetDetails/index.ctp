<div class="betDetails index">
	<h2><?php echo __('Bet Details'); ?></h2>
	<table cellpadding="0" cellspacing="0">
	<tr>
			<th><?php echo $this->Paginator->sort('id'); ?></th>
			<th><?php echo $this->Paginator->sort('bet_id'); ?></th>
			<th><?php echo $this->Paginator->sort('person_id'); ?></th>
			<th><?php echo $this->Paginator->sort('club_to_bet'); ?></th>
			<th><?php echo $this->Paginator->sort('amount_of_bet'); ?></th>
			<th><?php echo $this->Paginator->sort('win_loss'); ?></th>
			<th class="actions"><?php echo __('Actions'); ?></th>
	</tr>
	<?php
	foreach ($betDetails as $betDetail): ?>
	<tr>
		<td><?php echo h($betDetail['BetDetail']['id']); ?>&nbsp;</td>
		<td>
			<?php echo $this->Html->link($betDetail['Bet']['id'], array('controller' => 'bets', 'action' => 'view', $betDetail['Bet']['id'])); ?>
		</td>
		<td>
			<?php echo $this->Html->link($betDetail['Person']['id'], array('controller' => 'people', 'action' => 'view', $betDetail['Person']['id'])); ?>
		</td>
		<td><?php echo h($betDetail['BetDetail']['club_to_bet']); ?>&nbsp;</td>
		<td><?php echo h($betDetail['BetDetail']['amount_of_bet']); ?>&nbsp;</td>
		<td><?php echo h($betDetail['BetDetail']['win_loss']); ?>&nbsp;</td>
		<td class="actions">
			<?php echo $this->Html->link(__('View'), array('action' => 'view', $betDetail['BetDetail']['id'])); ?>
			<?php echo $this->Html->link(__('Edit'), array('action' => 'edit', $betDetail['BetDetail']['id'])); ?>
			<?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $betDetail['BetDetail']['id']), null, __('Are you sure you want to delete # %s?', $betDetail['BetDetail']['id'])); ?>
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
