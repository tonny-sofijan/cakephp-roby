<div class="people form">
<?php echo $this->Form->create('Person'); ?>
	<fieldset>
		<legend><?php echo __('Add Person'); ?></legend>
	<?php
		echo $this->Form->input('person_first_name');
		echo $this->Form->input('person_last_name');
		echo $this->Form->input('person_downline');
		echo $this->Form->input('person_email');
		echo $this->Form->input('person_mobile_phone');
		echo $this->Form->input('person_note');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit')); ?>
</div>
