<form enctype="multipart/form-data" action="/admin/process_csv" method="POST">
    <input type="hidden" name="MAX_FILE_SIZE" value="5000000" />
    Upload this CSV: <input name="userfile" type="file" />
    <br>
    Questionnaire <select id='questionnaire' name='questionnaire'>
		<option value='student_questionnaire'>Student Questionnaire</option>
		<option value='teaching_competencies'>Teaching Competencies</option>
		<option value='efficiency_and_attitude'>Efficiency and Attitude</option>
		<option value='attendance_and_punctuality'>Attendance and Punctuality</option>
    </select>
    <br>
    <input type="submit" value="Upload Photo" />
</form>
