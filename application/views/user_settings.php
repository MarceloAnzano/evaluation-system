<main>
	<div class="container" style="">
	<div class="nav-wrapper subNav" style="">
			
			<span class="brand-logo" style="text-transform: none !important;">Settings</span>
		</div>
		<div class="container-div" style="margin-top: 2em;">
		<form class="card" onsubmit="return validChange();" style="width:400px">
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
						<label for="repass">Confirm Password</label>
					</center>
				</center>
				<center class="row">
					<button class="btn waves-effect waves-light right"  id="loginbtn" type="submit">SET</button>
				</center>
				<center class="error-message-bottom" id="status">
				</center>
			</center>
		</form>
	</div>
	</div>
</main>
<? include BASEPATH.'views/change_user_settings.php';?>


<!-- 	<div class="nav-wrapper subNav">
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
 -->
