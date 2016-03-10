	<form id='section-form' action='/admin/save_section' method='post'>
		<table>
			<thead>
				<tr>
					<td>Subject:</td>
					<td>Adviser:</td>
				</tr>
				</tr>
			</thead>
			<tbody>
				<?php 
					for ($i = 0; $i < 10; $i++)
					{
						echo "<tr>";
						echo "<td><input name='subjects[]' placeholder='Subject' autofocus></td>";
						echo "<td><select id='teachers".($i+1)."' name='teachers[]'></select></td>";
						echo "</tr>";
					}
				?>
			</tbody>
		</table>
		<br>*leave subject field blank if not needed
		<br>
		Section:<br>
		<input id="section-id" name='section'><br>
		School Year and Semester:<br>
		<select name='setting[]'>
			<?php for ($i = 15; $i < 25; $i++) echo "<option value=20$i>20$i</option>"; ?>
		</select>
		to
		<select name='setting[]'>
			<?php for ($i = 16; $i < 26; $i++) echo "<option value=20$i>20$i</option>"; ?>
		</select>
		<select name='setting[]'>
			<option value=1>1st Sem</option>
			<option value=2>2nd Sem</option>
		</select>
		<br><br>
		<input name='submit' type='submit' value='Submit Section'>
	</form>
