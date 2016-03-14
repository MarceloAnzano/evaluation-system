
<main>
	<div class="container-div">
		<form class="card" onsubmit="return validLogin();">
			<center class="card-content">
				<center class="card-title loginTitle">FACULTY EVALUATION SYSTEM</center>
					<center class="row">
						<center class="input-field">
							<input type="text" id="logid" name='logid' onfocus="emptyElement()" maxlength="88" autofocus>
							<label for="logid">Username</label>
						</center>
					</center>
					<center class="row">
						<center class="input-field">
							<input id="password" name='password' type="password" onfocus="emptyElement()" maxlength="100">
							<label for="password">Password</label>
						</center>
					</center>
					<center class="row">
						<button id="loginbtn" class="btn waves-effect waves-light right" type="submit" name='submit'>LOGIN</button>
					</center>
					<center id="status">
					</center>
					<center class="row forgot">
						<a href="/app/register">Click here to set your password</a>
				</center>
			</center>
		</form>
	</div>
</main>