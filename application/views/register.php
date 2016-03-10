	<br>
	<form onsubmit="return validRegister();">
		<div>User ID:</div>
		<input type="text" id='logid' name='logid' onfocus="emptyElement()" maxlength="88" autofocus>
		<div>Given Password:</div>
		<input type="password" id="currpass" name="currpass" onfocus="emptyElement()" maxlength="88">
		<div>Password:</div>
		<input type="password" id="password" name="password" onfocus="emptyElement()" maxlength="100">
		<div>Retype Password:</div>
		<input type="password" id="repass" name="repass" onfocus="emptyElement()" maxlength="100">
		<br/><br/>
		<input id="loginbtn" type="submit" value="Set"></input>
	</form>
	<p id='status'></p>
	<a href='/'>Proceed to Login page</a>

