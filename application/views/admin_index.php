<!--
BECAUSE WLA SI HEADER
-->
<body>
<?php 
/**
 * ERASE MO TONG COMMENT PAGKATAPOS
 * Evaluation Control Panel
 * **/
?>
[[[EVALUATION CONTROL PANEL]]]
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
	</div>
	</div>
	</div>

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
</main>

<?php 
/**
 * ERASE MO TONG COMMENT PAGKATAPOS
 * Create Users (FOR APP ADMIN ONLY, no access ang principal)
 * **/
?>
[[[CREATE USER]]]
	<form id='createUserForm' onsubmit="return saveUser();">
		<br>Full Name<br><input name='createUname' type='text' autofocus>
		<br>Login ID<br><input name='createLogid' type='text' >
		<br>Password<br><input name='createPassword' type='password' >
		<br>User Type<br><select name='createUsertype'>
			<option value='student'>Student</option>
			<option value='faculty'>Faculty</option>
			<option value='admin'>Admin</option>
		</select>
		<br>Subject Area<br><input name='createUserSubject' type='text' placeholder='subject'readonly>
		<br>Grade & Section<br><input name='createUserGradelevel' type='text' placeholder='grade level' readonly>
		<input name='createUserSection' type='text' placeholder='section' readonly>
		<br>If Supervisor:<br><select name='createPosition' disabled>
			<option value='none'>None</option>
			<option value='principal'>Principal</option>
			<option value='api'>Asst. for Instruction</option>
			<option value='apsd'>Asst. for Student Development</option>
			<option value='cc'>Cluster Coordinator</option>
			<option value='ll'>Level Leader</option>
			<option value='satl'>Subject Area Team Leader</option>
		</select>
		<br>Level<br><input name='createUserLevel' type='text' placeholder='level'readonly>
		<br>Cluster<br><input name='createUserCluster' type='text' placeholder='cluster number'readonly>
		
		<br><input type='submit' name='submit' value='Submit'>
	</form>
	<p id='createUserStatus'></p>

<?php 
/**
 * ERASE MO TONG COMMENT PAGKATAPOS
 * Create Sections
 * **/
?>
[[[CREATE SECTIONS]]]
<!--
	<form id='createSectionForm' action='/admin/save_section' method='post'>
-->
	<form id='createSectionForm' onsubmit='return saveSection();'>
		<table>
			<thead>
				<tr>
					<td>Subject:</td>
					<td>Adviser:</td>
				</tr>
				</tr>
			</thead>
			<tbody>
				<?php 
					for ($i = 0; $i < 15; $i++)
					{
						echo "<tr>";
						echo "<td>".($i+1).".<input name='createSubjects[]' placeholder='Subject' autofocus></td>";
						echo "<td><select name='createAssignTeachers[]'></select></td>";
						echo "</tr>";
					}
				?>
			</tbody>
		</table>
		<br>*leave subject field blank if not needed
		<br>
		Grade & Section:<br>
		<input name='createSectionGradelevel' placeholder='Grade level'>
		<input name='createSectionSection' placeholder='Section'><br>
		<input name='submit' type='submit' value='Submit Section'>
	</form>
	<p id='createSectionStatus'></p>
	
<?php 
/**
 * ERASE MO TONG COMMENT PAGKATAPOS
 * Search Users
 * **/
?>
[[[SEARCH USERS]]]
	<form id='searchUserForm' onsubmit="return searchUser();">
		Search: <input name='searchString' type='text' autofocus>
		<br>
		Search for users:
		<br>
		<label for='searchUsername'><input type='radio' id='searchUsername' name='searchtype' value='username' checked>By name</label>
		<br>
		<label for='searchSection'><input type='radio' id='searchSection' name='searchtype' value='section'>By section</label>
		<br>
		<label for='searchStudents'><input type='radio' id='searchStudents' name='searchtype' value='students'>All students</label>
		<br>
		<label for='searchCluster'><input type='radio' id='searchCluster' name='searchtype' value='cluster'>By cluster</label>
		<br>
		<label for='searchSat'><input type='radio' id='searchSat' name='searchtype' value='sat'>By subject area</label>
		<br>
		<label for='searchLevel'><input type='radio' id='searchLevel' name='searchtype' value='level'>By level</label>
		<br>
		<label for='searchFaculty'><input type='radio' id='searchFaculty' name='searchtype' value='faculty'>All faculty</label>
		<br>
		
		<label for='searchAll'><input type='radio' id='searchAll' name='searchtype' value='all'>Display all users</label>
		<br><input type='submit' name='submit' value='Submit'>
	</form>
	<table id='linkSpace'>
	</table>

<?php 
/**
 * ERASE MO TONG COMMENT PAGKATAPOS
 * Percentage Settings
 * **/
?>
[[[PERCENTAGE SETTINGS]]]
<form id='percentageTable' onsubmit='return editPercentages();'>
	Teaching Competencies
	<br>
	SATL%:<input id='tc_satl' name='percent[]' type='number' min='1' max='100' step='1'>
	<br>
	CC%:<input id='tc_cc' name='percent[]' type='number' min='1' max='100' step='1'>
	<br>
	API%:<input id='tc_api' name='percent[]' type='number' min='1' max='100' step='1'>
	<br>
	Principal%:<input id='tc_principal' name='percent[]' type='number' min='1' max='100' step='1'>
	<br>
	Self%:<input id='tc_self' name='percent[]' type='number' min='1' max='100' step='1'>
	<br>
	<br>
	
	Efficiency and Attitude
	<br>
	SATL%:<input id='ea_satl' name='percent[]' type='number' min='1' max='100' step='1'>
	<br>
	LL%:<input id='ea_cc' name='percent[]' type='number' min='1' max='100' step='1'>
	<br>
	API%:<input id='ea_api' name='percent[]' type='number' min='1' max='100' step='1'>
	<br>
	Principal%:<input id='ea_principal' name='percent[]' type='number' min='1' max='100' step='1'>
	<br>
	Self%:<input id='ea_self' name='percent[]' type='number' min='1' max='100' step='1'>
	<br>
	<br>
	
	Attendance and Punctuality
	<br>
	SATL%:<input id='ap_satl' name='percent[]' type='number' min='1' max='100' step='1'>
	<br>
	LL%:<input id='ap_cc' name='percent[]' type='number' min='1' max='100' step='1'>
	<br>
	API%:<input id='ap_api' name='percent[]' type='number' min='1' max='100' step='1'>
	<br>
	Principal%:<input id='ap_principal' name='percent[]' type='number' min='1' max='100' step='1'>
	<br>
	Self%:<input id='ap_self' name='percent[]' type='number' min='1' max='100' step='1'>
	<br>
	<br>
	
	Category Percentage
	<br>
	Teaching Competencies%:<input id='tc_per' name='percent[]' type='number' min='1' max='100' step='1'>
	<br>
	Efficiency and Attitude%:<input id='ea_per' name='percent[]' type='number' min='1' max='100' step='1'>
	<br>
	Attendance and Punctuality%:<input id='ap_per' name='percent[]' type='number' min='1' max='100' step='1'>
	<br>
	<br>
	
	Instrument Percentage
	<br>
	Faculty%:<input id='faculty_per' name='percent[]' type='number' min='1' max='100' step='1'>
	<br>
	Student%:<input id='student_per' name='percent[]' type='number' min='1' max='100' step='1'>
	<br>
	<input type='submit' value='Submit'>
</form>
<p id='percentageTableStatus'></p>


<?php 
/**
 * ERASE MO TONG COMMENT PAGKATAPOS
 * Questionnaire
 * **/
?>
[[[QUESTIONNAIRE]]]
<form id='questionnaireForm' enctype="multipart/form-data" action="/admin/process_csv" method="POST">
    <input type="hidden" name="MAX_FILE_SIZE" value="5000000" />
    Upload this CSV: <input name="questionFile" type="file" />
    <br>
    Questionnaire <select name='questionnaire'>
		<option value='student_questionnaire'>Student Questionnaire</option>
		<option value='teaching_competencies'>Teaching Competencies</option>
		<option value='efficiency_and_attitude'>Efficiency and Attitude</option>
		<option value='attendance_and_punctuality'>Attendance and Punctuality</option>
    </select>
    <br>
    <input type="submit" value="Upload Questionnaire" />
</form>

<?php 
/**
 * ERASE MO TONG COMMENT PAGKATAPOS
 * Upload Faculty Photo
 * **/
?>

[[[UPLOAD FACULTY PHOTO]]]
<form id='facultyPhotoForm' enctype="multipart/form-data" action="/admin/upload_photo" method="POST">
    <input type="hidden" name="MAX_FILE_SIZE" value="5000000" />
    Upload this photo: <input name="facultyPhoto" type="file" />
    <br>
    User: <select name='userPhotoId'>
    </select>
    <br>
    <input type="submit" value="Upload Photo" />
</form>

<!--
BECAUSE DI-INCLUDED SI FOOTER
-->
</body>
<script type="text/javascript" src="<?php echo htmlspecialchars(STATICPATH."js/jquery-1.11.3.js");?>"></script>
<script type="text/javascript" src="<?php echo htmlspecialchars(STATICPATH."js/jquery-ui.min.js");?>"></script>
<script type="text/javascript" src="<?php echo htmlspecialchars(STATICPATH."js/materialize.js");?>"></script>
<!--<script type="text/javascript" src="<?php echo htmlspecialchars(STATICPATH."js/main.js");?>"></script>-->
<script type="text/javascript" src="<?php echo htmlspecialchars(STATICPATH."js/marci.js");?>"></script>
<script type="text/javascript" src="<?php echo htmlspecialchars(STATICPATH."js/script.js");?>"></script>
<?php if ($this->logged_as_admin() OR $this->logged_as_principal()) echo "<script type='text/javascript' src='".htmlspecialchars(STATICPATH."js/admin.js")."'></script>";?>
<?php if ($this->logged_as_admin()) echo "<script type='text/javascript' src='".htmlspecialchars(STATICPATH."js/evaluation.js")."'></script>";?>
