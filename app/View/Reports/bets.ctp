<?php #pr($this->Paginator->params); ?>
<?php $this->Paginator->options(array('url' => array('?' => $params))); ?>
<div class="players index">
	<h2><?php echo __('Player'); ?></h2>
	<div class="search">
		<?php echo $this->Form->create('BetDetail', array('type' => 'POST')); ?>
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
			<th><?php echo $this->Paginator->sort('person_id'); ?></th>
			<th><?php echo $this->Paginator->sort('club_to_bet', 'Klub'); ?></th>
			<th><?php echo $this->Paginator->sort('amount_of_bet', 'Jumlah'); ?></th>
			<th><?php echo $this->Paginator->sort('status'); ?></th>
			<th><?php echo $this->Paginator->sort('win_loss', 'W / L'); ?></th>
		</tr>
		<?php $twin = $tloss = 0; ?>
		<?php foreach ($betDetails as $betDetail): ?>
			<?php 
			$wlClass = '';
			if (strpos($betDetail['BetDetail']['status'], 'Menang') === false) {
				$wlClass = 'loss';
				$tloss += $betDetail['BetDetail']['win_loss'];
			} else {
				$wlClass = 'win';
				$twin += $betDetail['BetDetail']['win_loss'];
			}
			?>
			<tr>
				<td>
					<?php echo $this->Html->link($betDetail['Bet']['created_date'], array('controller' => 'bets', 'action' => 'view', $betDetail['Bet']['id'])); ?>
				</td>
				<td>
					<?php echo $this->Html->link($betDetail['Person']['person_first_name'] . ' ' . $betDetail['Person']['person_last_name'], array('controller' => 'people', 'action' => 'view', $betDetail['Person']['id'], '?' => $params)); ?>
				</td>
				<td>
					<?php echo isset($betDetail['Club']['club_name']) ? $this->Html->link($betDetail['Club']['club_name'], array('controller' => 'clubs', 'action' => 'view', $betDetail['BetDetail']['club_to_bet'])) : $this->Converter->overUnder($betDetail['BetDetail']['ou_bet']) . ' ' . $betDetail['Home']['Club']['club_name']; ?>
				</td>
				<td><?php echo number_format($betDetail['BetDetail']['amount_of_bet'], 1, ',', '.'); ?>&nbsp;</td>
				<td class="<?php echo $wlClass; ?>"><?php echo h($betDetail['BetDetail']['status']); ?>&nbsp;</td>
				<td class="<?php echo $wlClass; ?>"><?php echo number_format($betDetail['BetDetail']['win_loss'], 1, ',', '.'); ?>&nbsp;</td>
			</tr>
		<?php endforeach; ?>
			<tr>
				<td colspan="4" class="right bold">Total</td>
				<td>&nbsp;</td>
				<?php $twl = $twin - $tloss; ?>
				<td class="right bold <?php echo ($twl > 0) ? 'win' : 'loss' ?>"><?php echo ($twl > 0) ? '+ ' . number_format($twl, 1, ',', '.') : number_format($twl, 0, ',', '.'); ?>&nbsp;</td>
			</tr>
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
