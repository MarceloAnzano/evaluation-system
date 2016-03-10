
	<div class="pageContent valign-wrapper">
		<div class="valign">
			<center class="contentWidth">
				<div class="cardContainer loginCard">
					<form class="card" onsubmit="return validRegister();">
						<center class="card-content">
							<center class="card-title loginTitle">SET NEW PASSWORD</center>
							<center class="row">
								<center class="input-field">
									<input type="text" id='logid' name='logid' onfocus="emptyElement()" maxlength="88" autofocus>
									<label for="logid">Username</label>
								</center>
							</center>
							<center class="row">
								<center class="input-field">
									<input type="password" id="currpass" name="currpass" onfocus="emptyElement()" maxlength="88">
									<label for="currpass">Given Password</label>
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
							<center class="row forgot">
								<a href="/">Proceed to Login page</a>
							</center>
						</center>
					</form>
				</div>
			</center>
		</div>
	</div>