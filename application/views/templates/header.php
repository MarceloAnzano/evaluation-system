<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<title>IJA Evaluation</title>
</head>
<body>
	<?php // code below is so logout, settings and home doesn't appear in login page ?>
	<?php if ($this->check_user_login()) echo "<a href='".base_url."app/logout'>Logout</a>";?>
	<?php if ($this->check_user_login()) echo "<a href='".base_url."'>Home</a>";?>
	<?php if ($this->check_user_login()) echo "<a href='".base_url."app/user_settings'>Settings</a>";?>
	<?php if ($this->logged_as_principal()) echo "<a href='".base_url."app/principal'>Principal</a>";?>
	<?php if ($this->allow_supervisors()) echo "<a href='".base_url."app/view_ratings'>Score Tally</a>";?>
