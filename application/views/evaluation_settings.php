<main>
	<div class="container">
	<div class="row" style="margin: 0px; width: 100%">
		<div class="col l12 m12 s12">
		<form id='semestral-create' onsubmit='return createEvaluations();'>
			<div class="row" style="margin: 0px; width: 100%">
				<h5>School Year:</h5>
			</div>
			<div class="row" style="margin: 0px; width: 100%">
				<div class="col l1 m1 s10">				
				<!-- <div class="input-field col l2 m2 s10 offset-l2"> -->
					<select name='setting[]' class="browser-default">
						<?php for ($i = 15; $i < 25; $i++) echo "<option value=20$i>20$i</option>"; ?>
					</select>
				</div>
				<div class="col">
			 		<h6>to</h6>
			 	</div>
			 	<div class="col l1 m1 s10">
					<select name='setting[]' class="browser-default">
						<?php for ($i = 16; $i < 26; $i++) echo "<option value=20$i>20$i</option>"; ?>
					</select>
				</div>
			</div>
			<div class="row" style="margin: 0px; width: 100%">
				<h5>Semester:</h5>
			</div>
			<div class="row" style="margin: 0px; width: 100%">
				<div class="col l2 m2 s10 offset-s1">
					<select name='setting[]' class="browser-default">
						<option value=1>1st Sem</option>
						<option value=2>2nd Sem</option>
					</select>
				</div>
			</div>
		<!--	<br>
			Type
			<select name='create-type'>
				<option value='faculty'>Faculty</option>
				<option value='student'>Student</option>
			</select>
			<br>
			<input name='submit' type='submit' value='Create Evaluation'>
			<p id='status'></p> -->
		</form>
	</div>
	</div>
	</div>
<!-- 
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
<button id='' type='button' onclick='<?php echo "return archiveEvaluation();";?>'>Archive</button> -->
</main>