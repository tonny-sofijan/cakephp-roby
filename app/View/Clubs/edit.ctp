<div class="clubs form">
<?php echo $this->Form->create('Club'); ?>
	<fieldset>
		<legend><?php echo __('Edit Club'); ?></legend>
	<?php
		echo $this->Form->input('id');
		echo $this->Form->input('club_name', array('label' => 'Nama Klub'));
		echo $this->Form->input('league', array('label' => 'Liga'));
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit')); ?>
</div>
