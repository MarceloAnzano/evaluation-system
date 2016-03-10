	<form onsubmit="return searchUser();">
		Search: <input id='searchstring' name='searchstring' type='text' autofocus>
		<br>
		Search for users:
		<br>
		<label for='username'><input type='radio' id='username' name='searchtype' value='username' checked>By name</label>
		<br>
		<label for='section'><input type='radio' id='section' name='searchtype' value='section'>By section</label>
		<br>
		<label for='students'><input type='radio' id='students' name='searchtype' value='students'>All students</label>
		<br>
		<label for='cluster'><input type='radio' id='cluster' name='searchtype' value='cluster'>By cluster</label>
		<br>
		<label for='sat'><input type='radio' id='sat' name='searchtype' value='sat'>By subject area</label>
		<br>
		<label for='level'><input type='radio' id='level' name='searchtype' value='level'>By level</label>
		<br>
		<label for='faculty'><input type='radio' id='faculty' name='searchtype' value='faculty'>All faculty</label>
		<br>
		
		<label for='all'><input type='radio' id='all' name='searchtype' value='all'>Display all users</label>
		<br><input type='submit' name='submit' value='Submit'>
	</form>
	<p id='status'></p>
	<table id='linkspace'>
	</table>
