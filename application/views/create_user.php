	<form onsubmit="return saveUser();">
		<br>Full Name<br><input id='uname' name='uname' type='text' autofocus>
		<br>Login ID<br><input id='adminlogid' name='logid' type='text' >
		<br>Password<br><input id='adminpassword' name='password' type='password' >
		<br>User Type<br><select id='usertype'>
			<option value='student'>Student</option>
			<option value='faculty'>Faculty</option>
			<option value='admin'>Admin</option>
		</select>
		<hr>
		<br>Subject Area<br><input id='sat' name='sat' type='text' placeholder='Science, Math...'readonly>
		<br>Grade & Section<br><input id='section' name='section' type='text' placeholder='Grade # Section #' readonly>
		<br>If Supervisor:<br><select id='position' name='position' disabled>
			<option value='none'>None</option>
			<option value='principal'>Principal</option>
			<option value='api'>API</option>
			<option value='cc'>CC</option>
			<option value='ll'>LL</option>
			<option value='satl'>SATL</option>
		</select>
		<br>Level<br><input id='level' name='level' type='text' placeholder='for Level Leader'readonly>
		<br>Cluster<br><input id='cluster' name='cluster' type='text' placeholder='for Cluster Coordinator'readonly>
		
		<br><input type='submit' name='submit' value='Submit'>
	</form>
	<p id='status'></p>
