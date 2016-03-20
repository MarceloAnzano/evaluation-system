<div class="nav-wrapper subNav">
			<span class="brand-logo" style="text-transform: none !important; margin: 0px;"id='protectedInfo'></span>
		</div>
<main>
	<div class="container">
		<div class="row">
			<div class="col s12 m10 l10 offset-l1 offset-m1">
				<div class="card">
					<div class="card-content" style="width: 80%">
						<form onsubmit="return editUser();">
							<div class="row">
								<div class="input-field col l12 m12 s12">
									<input id='uname' name='uname' type='text' autofocus>
									<label for="uname">Full Name</label>
								</div>
							</div>
							<div class="row">
								<div class="input-field col l12 m12 s12">
									<input id='adminpassword' name='password' type='password' <?php if ( ! $this->logged_as_admin())echo "readonly"?>>
									<label for="adminpassword">Password</label>
								</div>
							</div>
							<div class="row">
								<div class="input-field col l12 m12 s12">
									<input id='usertype' name='usertype'<?php if ( ! $this->logged_as_admin())echo "readonly"?> type="text" placeholder=" " >
									<label for="usertype">UserType</label>
								</div>
							</div>
							<div class="row">
								<div class="input-field col l12 m12 s12">
									<input id='sat' name='sat' type='text'placeholder=" ">
									<label for="sat">Subject</label>
								</div>
							</div>
							<div class="row">
								<div class="input-field col l12 m12 s12">
									<input id='gradelevel' name='gradelevel' type='text'>
									<label for="gradelevel">Grade Level</label>
								</div>
							</div>
							<div class="row">
								<div class="input-field col l12 m12 s12">
									<input id='section' name='section' type='text'>
									<label for="section">Section</label>
								</div>
							</div>
							<div class="row">
								<h5>If Supervisor:</h5>
								<div class="row">
									<div class="col m8 l8 s12">
										<select id='position' name='position' >
											<option value='' disabled selected>Select position</option>
											<option value='none'>None</option>
											<option value='principal'>Principal</option>
											<option value='api'>API</option>
											<option value='cc'>CC</option>
											<option value='ll'>LL</option>
											<option value='satl'>SATL</option>
										</select>
									</div>
								</div>
								<div class="row">
									<div class="input-field col l8 m18 s12">
										<input id='level' name='level' type='text' placeholder=" ">
										<label for="level">Teaching Level</label>
									</div>
								</div>
								<div class="row">
									<div class="input-field col l8 m18 s12">
										<input id='cluster' name='cluster' type='text' placeholder=" ">
										<label for="cluster">Cluster</label>
									</div>
								</div>
							</div>
							<?php echo "<input type='hidden' id='targetid' name='targetid' value='".$data."'><br>"; ?>
							<div class="row">
								<button class="waves-effect waves-light btn" type='submit' name='submit'>Submit</button>
							</div>
						</form>
						<p class="error-message" id='status'></p>
					</div>
				</div>
			</div>
		</div>
	</div>
</main>
