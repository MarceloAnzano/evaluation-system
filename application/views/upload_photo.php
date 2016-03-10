<form enctype="multipart/form-data" action="/admin/upload_photo" method="POST">
    <input type="hidden" name="MAX_FILE_SIZE" value="5000000" />
    Upload this photo: <input name="userfile" type="file" />
    <br>
    User: <select id='user-photo' name='user-photo-id'>
    </select>
    <br>
    <input type="submit" value="Upload Photo" />
</form>
