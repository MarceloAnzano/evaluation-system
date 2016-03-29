<!DOCTYPE html>
<html>
<head>
	<meta charset="UTF-8">
	<title>IJA Evaluation</title>
	<link rel="stylesheet" href="<?php echo htmlspecialchars(STATICPATH."css/reset.css");?>">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/0.97.5/css/materialize.min.css">
	<!-- <link rel="stylesheet" href="<?php echo htmlspecialchars(STATICPATH."css/materialize.css");?>"> -->
	<link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
	<link rel="stylesheet" href="<?php echo htmlspecialchars(STATICPATH."css/main.css");?>">
</head>
<body>
	<header class="navbar-fixed">
			<div id="headImageHolder">
				<center class="navImg">
					<img src="/static/images/badge.png"/>
					<img src="<?php echo htmlspecialchars(STATICPATH."images/Logo.png");?>"/>
				</center>
			</div>
			<nav class="z-depth-1" id="navHolder">
				<?php if ($this->check_user_login()) echo'
				<a href="#" class="brand-logo">FACULTY EVALUATION</a>';
				?>
				<ul id="nav-mobile" class="right hide-on-med-and-down">
					<?php if ($this->check_user_login()) echo "<li><a class='custom-btn waves-effect waves-light' href='".base_url."'>HOME</a></li>";?>
					<?php if ($this->logged_as_principal()) echo "<li><a class='custom-btn waves-effect waves-light' href='".base_url."admin'>PRINCIPAL</a></li>";?>
					<?php if ($this->allow_supervisors()) echo "<li><a class='custom-btn waves-effect waves-light' href='".base_url."app/view_ratings'>RATINGS TALLY</a></li>";?>
					<?php if ($this->check_user_login()) echo "<li><a class='custom-btn waves-effect waves-light' href='".base_url."app/user_settings'>SETTINGS</a></li>";?>
					<?php if ($this->check_user_login()) echo "<li><a class='custom-btn waves-effect waves-light' href='".base_url."app/logout'>LOGOUT</a></li>";?>
				</ul>
			</nav>
	</header>
