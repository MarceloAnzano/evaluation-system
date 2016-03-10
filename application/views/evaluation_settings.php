<form id='semestral-create' onsubmit='return createEvaluations();'>
	School Year and Semester:<br>
	<select name='setting[]'>
		<?php for ($i = 15; $i < 25; $i++) echo "<option value=20$i>20$i</option>"; ?>
	</select>
	to
	<select name='setting[]'>
		<?php for ($i = 16; $i < 26; $i++) echo "<option value=20$i>20$i</option>"; ?>
	</select>
	<select name='setting[]'>
		<option value=1>1st Sem</option>
		<option value=2>2nd Sem</option>
	</select>
	<br>
	Type
	<select name='create-type'>
		<option value='faculty'>Faculty</option>
		<option value='student'>Student</option>
	</select>
	<br>
	<input name='submit' type='submit' value='Create Evaluation'>
	<p id='status'></p>
</form>
<br>
<p id='faculty-1st-status'>Not available</p>
<button id='' type='button' onclick='<?php echo "return openEvaluation(1)";?>'>Toggle</button>
<button id='' type='button' onclick='<?php echo "return deleteEvaluation(1)";?>'>Delete</button>

<p id='faculty-2nd-status'>Not available</p>
<button id='' type='button' onclick='<?php echo "return openEvaluation(2)";?>'>Toggle</button>
<button id='' type='button' onclick='<?php echo "return deleteEvaluation(2)";?>'>Delete</button>

<p id='student-status'>Not available</p>
<button id='' type='button' onclick='<?php echo "return openEvaluation(3)";?>'>Toggle</button>
<button id='' type='button' onclick='<?php echo "return deleteEvaluation(3)";?>'>Delete</button>

<p>Archive all results</p>
<button id='' type='button' onclick='<?php echo "return archiveEvaluation();";?>'>Archive</button>
