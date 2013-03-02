<?php $this->Paginator->options(array('url' => array('?' => $params))); ?>
<div class="bets index">
	<h2><?php echo __('Bets'); ?></h2>
	<div class="search">
		<?php echo $this->Form->create('Bet'); ?>
		<div>
			<?php echo $this->Form->input('fdate', array('type' => 'date', 'label' => false, 'div' => false)); ?>
			&nbsp;s/d&nbsp;
			<?php echo $this->Form->input('tdate', array('type' => 'date', 'label' => false, 'div' => false)); ?>
			<?php echo $this->Form->button('cari', array('type' => 'submit', 'class' => 'submit')); ?>
			<?php echo $this->Form->end(); ?>
		</div>
	</div>
	<table cellpadding="0" cellspacing="0">
		<tr>
			<th><?php echo $this->Paginator->sort('created_date', 'Tanggal'); ?></th>
			<th><?php echo $this->Paginator->sort('home'); ?></th>
			<th><?php echo $this->Paginator->sort('handicap1', 'P'); ?></th>
			<th><?php echo $this->Paginator->sort('loss1', 'K'); ?></th>
			<th><?php echo $this->Paginator->sort('result1', 'Gol'); ?></th>
			<th><?php echo $this->Paginator->sort('away'); ?></th>
			<th><?php echo $this->Paginator->sort('handicap2', 'P'); ?></th>
			<th><?php echo $this->Paginator->sort('loss2', 'K'); ?></th>
			<th><?php echo $this->Paginator->sort('result2', 'Gol'); ?></th>
			<th><?php echo $this->Paginator->sort('over_under', 'O/U'); ?></th>
			<th><?php echo $this->Paginator->sort('ou_over_loss', 'KO'); ?></th>
			<th><?php echo $this->Paginator->sort('ou_under_loss', 'KU'); ?></th>
			<th class="actions"><?php echo __('Actions'); ?></th>
		</tr>
		<?php foreach ($bets as $bet): ?>
			<tr>
				<td class="nowrap"><?php echo h($bet['Bet']['created_date']); ?>&nbsp;</td>
				<td><?php echo $this->Html->link($bet['Home']['club_name'], array('controller' => 'clubs', 'action' => 'view', $bet['Home']['id'])); ?>&nbsp;</td>
				<td><?php echo h($bet['Bet']['handicap1']); ?>&nbsp;</td>
				<td><?php echo h($bet['Bet']['loss1']); ?>&nbsp;</td>
				<td><?php echo h($bet['Bet']['result1']); ?>&nbsp;</td>
				<td><?php echo $this->Html->link($bet['Away']['club_name'], array('controller' => 'clubs', 'action' => 'view', $bet['Away']['id'])); ?>&nbsp;</td>
				<td><?php echo h($bet['Bet']['handicap2']); ?>&nbsp;</td>
				<td><?php echo h($bet['Bet']['loss2']); ?>&nbsp;</td>
				<td><?php echo h($bet['Bet']['result2']); ?>&nbsp;</td>
				<td><?php echo h($bet['Bet']['over_under']); ?>&nbsp;</td>
				<td><?php echo h($bet['Bet']['ou_over_loss']); ?>&nbsp;</td>
				<td><?php echo h($bet['Bet']['ou_under_loss']); ?>&nbsp;</td>
				<td class="actions">
					<?php echo $this->Html->link(__('View'), array('controller' => 'bets', 'action' => 'view', $bet['Bet']['id'])); ?>
					<?php echo $this->Html->link(__('Unclear!'), array('controller' => 'bets', 'action' => 'unclear', $bet['Bet']['id']), null, __('Are you sure this bet #%s is clear?', $bet['Bet']['id'])); ?>
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
