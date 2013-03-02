<div class="login form">
	<table>
	  <?php echo $this->Form->create('User'); ?>
		<tr>
			<td>Username</td>
			<td><input name="data[User][username]" maxlength="32" type="text"/></td>
		</tr>
		<tr>
			<td>Password</td>
			<td><input name="data[User][password]" maxlength="32" type="password"/></td>
		</tr>
		<tr>
			<td colspan="2" class="submit"><input type="submit" value="Login" /></td>
		</tr>
	</table>
</div>
