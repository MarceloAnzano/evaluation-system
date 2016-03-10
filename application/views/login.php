	<form onsubmit="return validLogin();">
		<div>User ID:</div>
		<input type="text" id="logid" name='logid' onfocus="emptyElement()" maxlength="88" autofocus>
		<div>Password:</div>
		<input id="password" name='password' type="password" onfocus="emptyElement()" maxlength="100">
		<br/><br/>
		<input id="loginbtn" type="submit" name='submit' value="Log In"></input>
	</form>
	<p id='status'></p>

	<a href="/app/register">Click here to set your password.</a>
