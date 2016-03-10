<p id='latest-id'>Latest: 2015-2016, 1st Semester</p> ^<<= fix this
<p> Help: Create Evaluation - archives the previous evaluation entries and creates a new one</p>
<p> Help: Open Evaluation - allows or disallows users to evaluate</p>
<form id='annual-create' onsubmit='return createAnnual();'>
	School Year and Semester:<br>
	<select name='setting[]'>
		<?php for ($i = 15; $i < 25; $i++) echo "<option value=20$i>20$i</option>"; ?>
	</select>
	to
	<select name='setting[]'>
		<?php for ($i = 16; $i < 26; $i++) echo "<option value=20$i>20$i</option>"; ?>
	</select>
	<select name='setting[]'>
		<option value=2>2nd Sem</option>
	</select>
	<br>
	<input name='submit' type='submit' value='Create Evaluation'>
	<p id='status'></p>
</form>
<br>
<p id='faculty-evaluation-status'>Faculty evaluations are closed</p>
<a href='/admin/open/faculty'><button id='evaluation-control-button' type='button' >Open</button></a>
<p id='student-evaluation-status'>Student to teacher evaluations are closed</p>
<a href='/admin/open/student'><button id='evaluation-control-button' type='button' >Open</button></a>

