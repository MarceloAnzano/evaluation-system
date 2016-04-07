					<form id='manageUserForm' onsubmit="return editAccountInfo();">
						<input type="hidden" id="editAccountInfo">
						<input type="hidden" id="editUsertype" name="editUsertype">
							<h5>User Details:</h5>
							<?php if ( $this->get_session_info('utype') != 'student')
							echo '
							<div class="row">
								<div class="input-field col l12 m12 s12">
									<input id="editUname" name="editUname" type="text" autofocus>
									<label for="editUname">Full Name</label>
								</div>
							</div>';
							?>
							<?php if ( $this->get_session_info('utype') == 'student')
							echo '
							<div class="row">
								<div class="input-field col l12 m12 s12">
									<input id="editUserGradelevel" name="editUserGradelevel" type="text">
									<label for="editUserGradelevel">Grade Level</label>
								</div>
							</div>
							<div class="row">
								<div class="input-field col l12 m12 s12">
									<input id="editUserSection" name="editUserSection" type="text">
									<label for="editUserSection">Section</label>
								</div>
							</div>';
							?>
							<?php if ( $this->allow_supervisors())
							echo '
							<div class="row">
								<div class="input-field col l12 m12 s12">
									<input id="editUserUserSubject" name="editUserUserSubject" type="text" placeholder=" ">
									<label for="editUserUserSubject">Subject</label>
								</div>
							</div>
							<div class="row">
								<h5>Position:</h5>
								<div class="row">
									<div class="col m8 l8 s12">
										<select id="editPosition" name="editPosition" >
											<option value="" disabled selected>Select position</option>
											<option value="none">None</option>
											<option value="cc">CC</option>
											<option value="ll">LL</option>
											<option value="satl">SATL</option>
										</select>
									</div>
								</div>
								<div class="row">
									<div class="input-field col l8 m18 s12">
										<input id="editUserLevel" name="editUserLevel" type="text" placeholder=" ">
										<label for="editUserLevel">Teaching Level</label>
									</div>
								</div>
								<div class="row">
									<div class="input-field col l8 m18 s12">
										<input id="editUserCluster" name="editUserCluster" type="text" placeholder=" ">
										<label for="editUserCluster">Cluster</label>
									</div>
								</div>
							</div>';
							?>
							<input type='hidden' id='editTargetId' name='editTargetId' value='<?php echo $data; ?>'><br>
							<div class="row">
								<button class="waves-effect waves-light btn" type='submit' name='submit'>Submit</button>
							</div>
						</form>
						<div id="modal-error-message" class="modal">
							<center class="modal-content">
								<h5></h5>
							</center>
							<div class="modal-footer">
								<a class="modal-action modal-close waves-effect waves-green btn-flat">OK</a>
							</div>
						</div>
						<div id="modal-submit-useredit" class="modal">
							<center class="modal-content">
								<h5>Submit user edit?</h5>
							</center>
							<div class="modal-footer">
								<a class="modal-action modal-close waves-effect waves-green btn-flat">NO</a>
								<a href="" onclick="return deleteUser(this.href);" class="delete-ok1 modal-action modal-close waves-effect waves-green btn-flat">YES</a>
							</div>
						</div>
						<p class="error-message" id='status'></p>
