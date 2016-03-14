<!DOCTYPE html>
<html>
<head>
	<meta charset="UTF-8">
	<title>IJA Evaluation</title>
	<link rel="stylesheet" href="<?php echo htmlspecialchars(STATICPATH."css/reset.css");?>">
	<link rel="stylesheet" href="<?php echo htmlspecialchars(STATICPATH."css/materialize.css");?>">
	<link rel="stylesheet" href="<?php echo htmlspecialchars(STATICPATH."css/main.css");?>">
</head>
<body>
	<div class="navbar-fixed">
		<div class="navbar-wrapper">
			<!-- <header class="nav-wrapper"> -->
			<header class="nav-wrapper z-depth-3">
				<center class="navImg">
					<img src="/static/images/badge.png"/>
					<img src="<?php echo htmlspecialchars(STATICPATH."images/Logo.png");?>"/>
				</center>
			</header>
			<nav>
				<div class="nav-wrapper">
					<?php if ($this->check_user_login()) echo'
					<a href="#" class="brand-logo">FACULTY EVALUATION SYSTEM</a>';
					?>
					<ul id="nav-mobile" class="right hide-on-med-and-down">
						<?php if ($this->check_user_login()) echo "<li><a class='custom-btn waves-effect waves-light' href='".base_url."'>HOME</a></li>";?>
						<?php if ($this->logged_as_principal()) echo "<li><a class='custom-btn waves-effect waves-light' href='".base_url."app/principal'>PRINCIPAL</a></li>";?>
						<?php if ($this->allow_supervisors()) echo "<li><a class='custom-btn waves-effect waves-light' href='".base_url."app/view_ratings'>SCORE TALLY</a></li>";?>
						<?php if ($this->check_user_login()) echo "<li><a class='custom-btn waves-effect waves-light' href='".base_url."app/user_settings'>SETTINGS</a></li>";?>
						<?php if ($this->check_user_login()) echo "<li><a class='custom-btn waves-effect waves-light' href='".base_url."app/logout'>LOGOUT</a></li>";?>
					</ul>
				</div>
			</nav>
		</div>
	</div>