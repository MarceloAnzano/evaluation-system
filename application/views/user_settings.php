
	<div class="nav-wrapper subNav">
		<span class="brand-logo">SETTINGS</span>
	</div>
	<div class="pageContent valign-wrapper">
		<div class="valign">
			<center class="contentWidth">
				<div class="cardContainer loginCard">
					<form class="card" onsubmit="return validChange();">
						<center class="card-content">
							<center class="row">
								<center class="input-field">
									<input type="password" id="currpass" name="currpass" onfocus="emptyElement()" maxlength="88">
									<label for="currpass">Old Password</label>
								</center>
							</center>
							<center class="row">
								<center class="input-field">
									<input type="password" id="password" name="password" onfocus="emptyElement()" maxlength="100">
									<label for="password">New Password</label>
								</center>
							</center>
							<center class="row">
								<center class="input-field">
									<input type="password" id="repass" name="repass" onfocus="emptyElement()" maxlength="100">
									<label for="repass">New Password</label>
								</center>
							</center>
							<center class="row">
								<button class="btn waves-effect waves-light right"  id="loginbtn" type="submit">SET</button>
							</center>
							<center id="status">
							</center>
						</center>
					</form>
				</div>
			</center>
		</div>
	</div>
