	<form onsubmit="return searchUser();">
		Search: <input id='searchstring' name='searchstring' type='text' autofocus>
		<br>
		Search for users with:
		<br>
		<label for='searchtype'><input type='radio' name='searchtype' value='username' checked>Full Name</label>
		<br>
		<label for='searchtype'><input type='radio' name='searchtype' value='section'>Section</label>
		<br>
		<label for='searchtype'><input type='radio' name='searchtype' value='cluster'>Cluster</label>
		<br>
		<label for='searchtype'><input type='radio' name='searchtype' value='sat'>Subject Area</label>
		<br>
		<label for='searchtype'><input type='radio' name='searchtype' value='level'>Level</label>
		<br>
		<label for='searchtype'><input type='radio' name='searchtype' value='all'>Display All Users</label>
		<br><input type='submit' name='submit' value='Submit'>
	</form>
	<p id='status'></p>
	<ul id='linkspace'>
	</ul>
