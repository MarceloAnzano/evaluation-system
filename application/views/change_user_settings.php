	<ul id='protectedInfo'></ul>
	<form onsubmit="return editUser();">
		<br>Full Name<br><input id='uname' name='uname' type='text' autofocus>
		<br>Password<br><input id='adminpassword' name='password' type='password' <?php if ( ! $this->logged_as_admin())echo "readonly"?>>
		<br>User Type<br><input id='usertype' name='usertype' <?php if ( ! $this->logged_as_admin())echo "readonly"?>>
		<hr>
		<br>Subject Area<br><input id='sat' name='sat' type='text' placeholder='Science, Math...'>
		<br>Grade & Section<br><input id='section' name='section' type='text' placeholder='Grade # Section #' >
		<br>If Supervisor:<br><select id='position' name='position' >
			<option value='none'>None</option>
			<option value='principal'>Principal</option>
			<option value='api'>API</option>
			<option value='cc'>CC</option>
			<option value='ll'>LL</option>
			<option value='satl'>SATL</option>
		</select>
		<br>Level<br><input id='level' name='level' type='text' placeholder='for Level Leader'>
		<br>Cluster<br><input id='cluster' name='cluster' type='text' placeholder='for Cluster Coordinator'>
		<?php echo "<input type='hidden' id='targetid' name='targetid' value='".$data."'><br>"; ?>
		<br><input type='submit' name='submit' value='Submit'>
	</form>
	<p id='status'></p>
