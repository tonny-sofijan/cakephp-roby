<div class="bets form">
<?php echo $this->Form->create('Bet'); ?>
<?php echo $this->Form->input('id'); ?>
	<fieldset>
		<legend><?php echo __('Edit Bet'); ?></legend>
		<table>
			<tr>
				<td><?php echo $this->Form->input('home', array('type' => 'select', 'options' => $clubs)); ?></td>
				<td><?php echo $this->Form->input('away', array('type' => 'select', 'options' => $clubs)); ?></td>
			</tr>
			<tr>
				<td><?php echo $this->Form->input('handicap1', array('label' => 'Pur1')); ?></td>
				<td><?php echo $this->Form->input('handicap2', array('label' => 'Pur2')); ?></td>
			</tr>
			<tr>
				<td><?php echo $this->Form->input('loss1', array('label' => 'K1 (%)')); ?></td>
				<td><?php echo $this->Form->input('loss2', array('label' => 'K2 (%)')); ?></td>
			</tr>
			<tr>
				<td><?php echo $this->Form->input('over_under', array('label' => 'Over/Under')); ?></td>
				<td>&nbsp;</td>
			</tr>
			<tr>
				<td><?php echo $this->Form->input('ou_over_loss', array('label' => 'K Over')); ?></td>
				<td><?php echo $this->Form->input('ou_under_loss', array('label' => 'K Under')); ?></td>
			</tr>
			<tr>
				<td colspan="2"><?php echo $this->Form->input('bet_note'); ?></td>
			</tr>
			<tr>
				<td colspan="2"><?php echo $this->Form->end(__('Submit')); ?></td>
			</tr>
		</table>
	</fieldset>
</div>
