<?php
include BASEPATH.'views/templates/header.php';
?>

<body>
<?php 
/**
 * ERASE MO TONG COMMENT PAGKATAPOS
 * Evaluation Control Panel
 * **/
?>
<main>
	<div class="container-admin">
		<div class="nav-wrapper subNav">
			<span class="brand-logo" style="text-transform: none !important;">Evaluation Control Panel</span>
		</div>
		<div class="row">
			<div class="col l2 m5 hide-on-small-only " id="sidebar">
				<ul class="section table-of-contents">
					<li><a href="#create-eval">Create Evaluation</a></li>
					<li><a href="#activate-eval">Evalution Control Panel</a></li>
					<li><a href="#create-user">Create User</a></li>
					<li><a href="#create-sections">Create Section</a></li>
					<li><a href="#search-users">Search Users</a></li>
					<li><a href="#percentage-settings">Percentage Settings</a></li>
					<li><a href="#manage-questionnaire">Manage Questionnaire</a></li>
					<li><a href="#upload-photo">Upload Photo</a></li>
				</ul>
			</div>
			<div class="col l10 m7 s7 offset-l2 offset-m5 offset-s5" id="maincontent">
				<div class="row eval-division section scrollspy" id="create-eval">
					<div class="col l12 m12 s12">
						<h4>Create Evaluation</h4>
							<div class="row">
								<div class="col l12 m12 s12">
								<form id='semestral-create' onsubmit='return createEvaluations();'>							
									<div class="row">
										<div class="col">
											<h5>School Year:</h5>
										</div>
										<div class="col l2 m2 s3">				
										<!-- <div class="input-field col l2 m2 s10 offset-l2"> -->
											<select name='setting[]'>
												<?php for ($i = 15; $i < 25; $i++) echo "<option value='20".$i."20".($i+1)."'>20$i-20".($i+1)."</option>"; ?>
											</select>
										</div>
<!--
										<div class="col">
									 		<h6 style="font-size: 1.2em;">to</h6>
									 	</div>

									 	<div class="col l2 m2 s3">
											<select name='setting[]'>
												<?php for ($i = 16; $i < 26; $i++) echo "<option value=20$i>20$i</option>"; ?>
											</select>
										</div>
-->
									</div>
									<div class="row">
										<div class="col">
											<h5>Semester:</h5>
										</div>
										<div class="col l2 m2 s10">
											<select name='setting[]'>
												<option value=1>1st Semester</option>
												<option value=2>2nd Semester</option>
											</select>
										</div>
									</div>
<!--
									<div class="row">
										<div class="col">
											<h5>Type:</h5>
										</div>
										<div class="col l4 m4 s8">
											<select name='create-type'>
												<option value='faculty'>Faculty</option>
												<option value='student'>Student</option>
											</select>
										</div>
									</div>
-->
									<div class="row">
										<div class="col">
											<button name='submit' class="waves-effect waves-light btn" type='submit'>Submit</button>
										</div>
									</div>
									<div class="row">
										<div class="col">
											<h6 class="error-message" id='status'></h6>
										</div>
									</div>
								</form>
							</div>
						</div>
					</div>
				</div>
				<div class="row eval-division section scrollspy" id="activate-eval">
					<div class="col l12 m12 s12">
						<h4>Evaluation Control Panel</h4>
						<div class="row">
							<div class="col l5">
								<h5 id='faculty-1st-status'>Information not available</h5>
							</div>
							<div class="col">
								<button id='' class="waves-effect waves-light btn" type='button' onclick='<?php echo "return openEvaluation(1)";?>'>Toggle</button>
							</div>
							<div class="col">
								<button id='' class="waves-effect waves-light btn" type='button' onclick='<?php echo "return deleteEvaluation(1)";?>'>Delete</button>
							</div>
						</div>
						<div class="row">
							<div class="col l5">
								<h5 id='faculty-2nd-status'>Information not available</h5>
							</div>
							<div class="col">
								<button id='' class="waves-effect waves-light btn" type='button' onclick='<?php echo "return openEvaluation(2)";?>'>Toggle</button>
							</div>
							<div class="col">
								<button id='' class="waves-effect waves-light btn" type='button' onclick='<?php echo "return deleteEvaluation(2)";?>'>Delete</button>
							</div>
						</div>
<!--
						<div class="row">
							<div class="col l5">
								<h5 id='student-status'>Not available</h5>
							</div>
							<div class="col">
								<button id='' class="waves-effect waves-light btn" type='button' onclick='<?php echo "return openEvaluation(3)";?>'>Toggle</button>
							</div>
							<div class="col">
								<button id='' class="waves-effect waves-light btn" type='button' onclick='<?php echo "return deleteEvaluation(3)";?>'>Delete</button>
							</div>
						</div>
-->
						<div class="row">
							<div class="col l5">
								<h5>Archive All Results</h5>
							</div>
							<div class="col">
								<button id='' class="waves-effect waves-light btn" type='button' onclick='<?php echo "return archiveEvaluation();";?>'>Archive</button>
							</div>
						</div>
					</div>
				</div>
				<div class="row eval-division section scrollspy" id="create-user">
					<div class="col l12 m12 s12">
						<h4>CREATE USER</h4>
						<div class="row">
							<div class="col l12 m12 s12">
								<form id='createUserForm' onsubmit="return saveUser();">
									<div class="row">
										<div class="input-field col l6 m6 s12">
											<input id="eval-create-uname" name='createUname' type='text'>
											<label for="eval-create-uname">Full Name</label>
										</div>
									</div>
									<div class="row">
										<div class="input-field col l6 m6 s12">
											<input id="eval-create-logid" name='createLogid' type='text'>
											<label for="eval-create-logid">Login ID</label>
										</div>
									</div>
									<div class="row">
										<div class="input-field col l6 m6 s12">
											<input id="eval-create-pass" name='createPassword' type='password' readonly onfocus="this.removeAttribute('readonly');">
											<label for="eval-create-pass">Password</label>
										</div>
									</div>
									<div class="row">
										<div class="col l6 m6 s12">
											<select name='createUsertype'>
												<option value='' disabled selected>User Type</option>
												<option value='student'>Student</option>
												<option value='faculty'>Faculty</option>
												<option value='admin'>Admin</option>
											</select>
										</div>
									</div>
									<div class="row">
										<div class="input-field col l3 m3 s6">
											<input id="eval-create-grade" name='createUserGradelevel' type='text' disabled>
											<label for="eval-create-grade">Grade</label>
										</div>
										<div class="input-field col l3 m3 s6">
											<input id="eval-create-section" name='createUserSection' type='text' disabled>
											<label for="eval-create-section">Section</label>
										</div>
									</div>
									<div class="row">
										<div class="input-field col l6 m6 s12">
											<input id="eval-create-subject" name='createUserSubject' type='text' disabled>
											<label for="eval-create-subject">Subject Area</label>
										</div>
									</div>
									<div class="row">
										<div class="col l12 m12 s12">
											<h6 style="font-weight: 700">If Supervisor:</h6>
											<div class="row">
												<div class="col l6 m6 s12" id="supervisor-position-div">
													<select name='createPosition' disabled>
														<option value="" disabled>Position</option>
														<option value='none'>None</option>
														<option value='principal'>Principal</option>
														<option value='api'>Asst. Principal for Instruction</option>
														<option value='cc'>Cluster Coordinator</option>
														<option value='ll'>Level Leader</option>
														<option value='satl'>Subject Area Team Leader</option>
													</select>
												</div>
											</div>
											<div class="row">
												<div class="input-field col l3 m3 s6">
													<input id="eval-create-level" name='createUserLevel' type='text' disabled>
													<label for="eval-create-level">Level</label>
												</div>
												<div class="input-field col l3 m3 s6">
													<input id="eval-create-cluster" name='createUserCluster' type='text' disabled>
													<label for="eval-create-cluster">Cluster</label>
												</div>
											</div>
										</div>
									</div>
									<div class="row">
										<div class="col">
											<button class="waves-effect waves-light btn" type='submit' name='submit'>Submit</button>
										</div>
									</div>
									<div class="row">
										<div class="col">
											<h6 class="error-message" id='createUserStatus'></h6>
										</div>
									</div>
								</form>
							</div>
						</div>
					</div>
				</div>
				<?php 
				/**
				 * ERASE MO TONG COMMENT PAGKATAPOS
				 * Create Sections
				 * **/
				?>				
				<div class="row eval-division section scrollspy" id="create-sections">
					<div class="col l12 m12 s12">
						<h4>CREATE SECTION</h4>
						<!--
						<form id='createSectionForm' action='/admin/save_section' method='post'>
						-->
						<div class="row">
							<div class="col l12 m12 s12">
								<form id='createSectionForm' onsubmit='return saveSection();'>
									<div class="row">
										<div class="col l10 m10 s12">
											<table style="margin-bottom: 0px">
												<thead>
													<tr>
														<th>Subject</th>
														<th>Adviser</th>
													</tr>
												</thead>
												<tbody>
													<?php 
														for ($i = 0; $i < 15; $i++)
														{
															echo "<tr>";
															echo "<td><input name='createSubjects[]'></td>";
															echo "<td><select class='load-select' name='createAssignTeachers[]'></select></td>";
															echo "</tr>";
														}
													?>
												</tbody>
											</table>
										</div>
									</div>
									<div class="row">
										<div class="col">
											<h6>*leave subject field blank if not needed</h6>
										</div>
									</div>
									<div class="row">
										<div class="col">
											<h5>Grade  Section</h5>
										</div>
									</div>
									<div class="row">
										<div class="col l4 m5 s6">
											<input name='createSectionGradelevel' placeholder='Grade level'>
										</div>
										<div class="col l4 m5 s6">
											<input name='createSectionSection' placeholder='Section'>
										</div>
									</div>
									<div class="row">
										<div class="col">
											<button class="waves-effect waves-light btn" name='submit' type='submit'>Submit Section</button>
										</div>
									</div>
								</form>						
							</div>
							<div class="row">
								<div class="col">
									<h6 class="error-message" id='createSectionStatus'></h6>
								</div>
							</div>
						</div>
					</div>
				</div>
				<?php 
				/**
				 * ERASE MO TONG COMMENT PAGKATAPOS
				 * Search Users
				 * **/
				?>
				<div class="row eval-division section scrollspy" id="search-users">
					<div class="col l12 m12 s12">
						<h4>SEARCH USERS</h4>
						<div class="row">
							<div class="col l12 m12 s12">
								<form id='searchUserForm' onsubmit="return searchUser();">
									<div class="row">
										<div class="input-field col l6 m6 s12">
											<input id="eval-search-user" name='searchString' type='text'>
											<label for="eval-search-user">Search</label>
										</div>
									</div>
									<div class="row">
										<div class="col l12 m12 s12">
											<h6>Filter:</h6>
											<div class="row">
												<div class="col l12 m12 s12">
													<div class="row">
														<input type='radio' id='searchUsername' name='searchtype' value='username' checked>
														<label for='searchUsername'>Name</label>
													</div>
													<div class="row">
														<input type='radio' id='searchSection' name='searchtype' value='section'>
														<label for='searchSection'>Section Number</label>
													</div>
													<div class="row">
														<input type='radio' id='searchSat' name='searchtype' value='sat'>
														<label for='searchSat'>Subject area</label>
													</div>
													<div class="row">
														<input type='radio' id='searchLevel' name='searchtype' value='level'>
														<label for='searchLevel'>Teaching level</label>
													</div>
													<div class="row">
														<input type='radio' id='searchCluster' name='searchtype' value='cluster'>
														<label for='searchCluster'>Cluster Number</label>
													</div>
												</div>
											</div>
											<h6>Display All:</h6>
											<div class="row">
												<div class="col l12 m12 s12">
													<div class="row">
														<input type='radio' id='searchStudents' name='searchtype' value='students'>
														<label for='searchStudents'>All Student</label>
													</div>
													<div class="row">
														<input type='radio' id='searchFaculty' name='searchtype' value='faculty'>
														<label for='searchFaculty'>All Faculty</label>
													</div>
													<div class="row">										
														<input type='radio' id='searchAll' name='searchtype' value='all'>
														<label for='searchAll'>All Users</label>
													</div>
												</div>
											</div>
										</div>
									</div>
									<div class="row" style="margin-top:20px;">
										<div class="col">
											<button type='submit' name='submit' class="waves-effect waves-light btn">Search</button>
										</div>
									</div>
								</form>
							</div>
						</div>
						<div class="row" style="padding-top: 20px;" id="search-result">
							<div class="col l12 m12 s12">
								<h5>Search Results:</h5>
								<div class="row">
									<div class="col l12 m12 s12">
										<table id='linkSpace' class="highlight">
											<thead></thead>
											<tbody>
												<!-- <tr><td>None</td></tr> -->
											</tbody>
										</table>
									</div>
								</div>
								<!-- <button class="modal-trigger" href="#modal1">Hey</button> -->
								<div id="modal1" class="modal col l3 m3 s8 offset-l2 offset-m">
									<center class="model-content">
										<h5>Delete Success</h5>
									</center>
									<div class="modal-footer">
										<a href="#search-result" class="modal-action modal-close waves-effect waves-green btn-flat">OK</a>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
				<?php 
				/**
				 * ERASE MO TONG COMMENT PAGKATAPOS
				 * Percentage Settings
				 * **/
				?>
				<div class="row eval-division section scrollspy" id="percentage-settings">
					<div class="col l12 m12 s12">
						<h4>PERCENTAGE SETTINGS</h4>
						<div class="row">
							<div class="col l12 m12 s12">
								<form id='percentageTable' onsubmit='return editPercentages();'>
									<div class="row" style="margin-top: 20px;">
										<h5 style="margin-bottom: 0px;">Teaching Competencies</h5>
									</div>
									<div class="row">
										<div class="input-field col l2 m2 s2">
											<input id='tc_satl' name='percent[]' type='number' min='1' max='100' step='1'>
											<label for="tc_satl">SATL %</label>
										</div>
										<div class="input-field col l2 m2 s2">
											<input id='tc_cc' name='percent[]' type='number' min='1' max='100' step='1'>
											<label for="tc_cc">CC %</label>
										</div>
										<div class="input-field col l2 m2 s2">
											<input id='tc_api' name='percent[]' type='number' min='1' max='100' step='1'>
											<label for="tc_api">API %</label>
										</div>
										<div class="input-field col l2 m2 s2">
											<input id='tc_principal' name='percent[]' type='number' min='1' max='100' step='1'>
											<label for="tc_principal">Principal %</label>
										</div>
										<div class="input-field col l2 m2 s2">
											<input id='tc_self' name='percent[]' type='number' min='1' max='100' step='1'>
											<label id='tc_self'>Self %</label>
										</div>
									</div>
									<div class="row" style="margin-top: 20px;">
										<h5 style="margin-bottom: 0px;">Efficiency and Attitude</h5>
									</div>
									<div class="row">
										<div class="input-field col l2 m2 s2">
											<input id='ea_satl' name='percent[]' type='number' min='1' max='100' step='1'>
											<label for="ea_satl">SATL %</label>
										</div>
										<div class="input-field col l2 m2 s2">
											<input id='ea_cc' name='percent[]' type='number' min='1' max='100' step='1'>
											<label for="ea_cc">LL %</label>
										</div>
										<div class="input-field col l2 m2 s2">
											<input id='ea_api' name='percent[]' type='number' min='1' max='100' step='1'>
											<label for="ea_api">API %</label>
										</div>
										<div class="input-field col l2 m2 s2">
											<input id='ea_principal' name='percent[]' type='number' min='1' max='100' step='1'>
											<label for="ea_principal">Principal %</label>
										</div>
										<div class="input-field col l2 m2 s2">
											<input id='ea_self' name='percent[]' type='number' min='1' max='100' step='1'>
											<label id="ea_self">Self %</label>
										</div>
									</div>	
									<div class="row" style="margin-top: 20px;">
										<h5 style="margin-bottom: 0px;">Attendance and Punctuality</h5>
									</div>
									<div class="row">
										<div class="input-field col l2 m2 s2">
											<input id='ap_satl' name='percent[]' type='number' min='1' max='100' step='1'>
											<label for="ap_satl">SATL %</label>
										</div>
										<div class="input-field col l2 m2 s2">
											<input id='ap_cc' name='percent[]' type='number' min='1' max='100' step='1'>
											<label for="ap_cc">LL %</label>
										</div>
										<div class="input-field col l2 m2 s2">
											<input id='ap_api' name='percent[]' type='number' min='1' max='100' step='1'>
											<label for="ap_api">API %</label>
										</div>
										<div class="input-field col l2 m2 s2">
											<input id='ap_principal' name='percent[]' type='number' min='1' max='100' step='1'>
											<label for="ap_principal">Principal %</label>
										</div>
										<div class="input-field col l2 m2 s2">
											<input id='ap_self' name='percent[]' type='number' min='1' max='100' step='1'>
											<label id="ap_self">Self %</label>
										</div>
									</div>
									<div class="row" style="margin-top: 20px;">
										<h5 style="margin-bottom: 0px;">Category Percentage</h5>
									</div>
									<div class="row">
										<div class="input-field col l4 m4 s4">
											<input id='tc_per' name='percent[]' type='number' min='1' max='100' step='1'>
											<label for="tc_per">Teaching Competencies %</label>
										</div>
										<div class="input-field col l4 m4 s4">
											<input id='ea_per' name='percent[]' type='number' min='1' max='100' step='1'>
											<label id="ea_per">Efficiency and Attitude %</label>
										</div>
										<div class="input-field col l4 m4 s4">
											<input id='ap_per' name='percent[]' type='number' min='1' max='100' step='1'>
											<label for="ap_per">Attendance and Punctuality %</label>
										</div>
									</div>
									<div class="row" style="margin-top: 20px;">
										<h5 style="margin-bottom: 0px;">Instrument Percentage</h5>
									</div>
									<div class="row">
										<div class="input-field col l4 m4 s4">
											<input id='faculty_per' name='percent[]' type='number' min='1' max='100' step='1'>
											<label for="faculty_per">Faculty %</label>
										</div>
										<div class="input-field col l4 m4 s4">
											<input id='student_per' name='percent[]' type='number' min='1' max='100' step='1'>
											<label for="student_per">Student %</label>
										</div>
									</div>
									<div class="row">
										<div class="col">
											<button type='submit' class="waves-effect waves-light btn">Submit</button>
										</div>
									</div>
								</form>
							</div>
						</div>
						<div class="row">
							<div class="col">
								<h6 class="error-message" id='percentageTableStatus'></h6>
							</div>
						</div>
					</div>
				</div>
				<?php 
				/**
				 * ERASE MO TONG COMMENT PAGKATAPOS
				 * Questionnaire
				 * **/
				?>
				<div class="row eval-division section scrollspy" id="manage-questionnaire">
					<div class="col l12 m12 s12">
						<h4>QUESTIONNAIRE</h4>
						<div class="row">
							<div class="col l12 m12 s12">
								<form id='questionnaireForm' enctype="multipart/form-data" action="/admin/process_csv" method="POST">
								    <div class="row">
									    <div class="file-field input-field">
										    <div class="waves-effect waves-light btn" style="padding-left: 1.2rem; padding-right: 1.2rem;">
										    	<input type="hidden" name="MAX_FILE_SIZE" value="5000000" />
											    <span style="line-height: 100%">Choose File</span>
											    <input name="questionFile" type="file" style="height: inherit;">
										    </div>
										    <div class="file-path-wrapper  col l5 m5 s8">
										    	<input class="file-path validate" type="text" >    	
										    </div>
									    </div>
								    </div>
								    <div class="row">
								    	<div class="col l7 m7 s12">
										    <select name='questionnaire'>
												<option value="" disabled selected>Questionnaire Type</option>
												<option value='student_questionnaire'>Student Questionnaire</option>
												<option value='teaching_competencies'>Teaching Competencies</option>
												<option value='efficiency_and_attitude'>Efficiency and Attitude</option>
												<option value='attendance_and_punctuality'>Attendance and Punctuality</option>
										    </select>
									    </div>
								    </div>
								    <div class="row">
								    	<button class="waves-effect waves-light btn" type="submit">Upload Questionnaire</button>
								    </div>
								</form>
							</div>
						</div>
					</div>
				</div>
				<?php 
				/**
				 * ERASE MO TONG COMMENT PAGKATAPOS
				 * Upload Faculty Photo
				 * **/
				?>
				<div class="row eval-division section scrollspy" id="upload-photo">
					<div class="col l12 m12 s12">
						<h4>UPLOAD FACULTY PHOTO</h4>
						<div class="row">
							<div class="col l12 m12 s12">
								<form id='facultyPhotoForm' enctype="multipart/form-data" action="/admin/upload_photo" method="POST">
									<div class="row">
									    <div class="file-field input-field">
										    <div class="waves-effect waves-light btn" style="padding-left: 1.2rem; padding-right: 1.2rem;">
										    	<input type="hidden" name="MAX_FILE_SIZE" value="5000000" />
											    <span style="line-height: 100%">Choose File</span>
											    <input name="facultyPhoto" type="file" />
										    </div>
										    <div class="file-path-wrapper  col l5 m5 s8">
										    	<input class="file-path validate" type="text" >    	
										    </div>
									    </div>
								    </div>
								    <div class="row">
								    	<div class="col l7 m7 s12">
										    <select name='userPhotoId'>
												<option value="" disabled selected>Select User</option>
										    </select>
									    </div>
								    </div>
								    <div class="row">
								    	<button class="waves-effect waves-light btn" type="submit">Upload Photo</button>
								    </div>
								</form>
							</div>
						</div>
					</div>
				</div>
				<div class="row eval-division" style="height: 100px;"></div>
			</div>
		</div>
	</div>	
</main>
<?php
include BASEPATH.'views/templates/footer.php';
?>
</body>
<?php if ($this->logged_as_admin() OR $this->logged_as_principal()) echo "<script type='text/javascript' src='".htmlspecialchars(STATICPATH."js/admin.js")."'></script>";?>
<?php if ($this->logged_as_admin()) echo "<script type='text/javascript' src='".htmlspecialchars(STATICPATH."js/evaluation.js")."'></script>";?>
