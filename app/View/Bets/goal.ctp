<div class="bets form">
<?php echo $this->Form->create('Bet'); ?>
<?php echo $this->Form->input('id'); ?>
	<fieldset>
		<legend><?php echo __('Edit Bet'); ?></legend>
		<table>
			<tr>
				<td><?php echo $this->Form->input('result1', array('label' => 'Gol1 (%)')); ?></td>
				<td><?php echo $this->Form->input('result2', array('label' => 'Gol2 (%)')); ?></td>
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
