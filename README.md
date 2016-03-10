# evaluation-system
# GUIDE:
- create a virtual host that leads to the location of index.php
- go to application/include/connect.php then edit accordingly:
	$mysql_db_hostname = "localhost";
	$mysql_db_user = "root";
	$mysql_db_password = "root";
	$mysql_db_database = "myapp";
- look for logid in users table in phpmyadmin for login usernames
- all passwords are '1234' without the quotes
- if 1234 doesn't work and login credentials are correct, click the
	register password link then enter '1234' in the default password
- to create the evaluation make sure there are:	
	- proper users (login as justinflores1234 for admin privileges)
	- proper sections (can be done as lorinarittenhouse, patriciaangel or justinflores1234)
	- create evaluation (only justinflores1234 and the other app admin)
- 

NOTE FOR MARCI:
- yung mga js, css at kung ano mang ilalagay mo sa front end nasa static folder (kalapit nina application at index.php)
- para ma-link sila sa page ang mga script, tignan mo yung example sa application/views/templates/footer.php
- yung mga link sa application/views/templates/header.php ay laging href=base_url
- para sa storage ng application images store mo sa images/app
- yung files folder, naka-reserve para sa mga pdf, csv etc
- yung ibang features na depende sa kung sino ang naka-login use: 
    $this->logged_as_admin() to check if app administrator 
    $this->logged_as_principal() to check if principal or asst. principal for inst. (api) 
    $this->allow_supervisor(string) 
      string values can be satl, ll, cc, api or principal 
    $this->get_session_info(string) 
      string values can be uname for full name, logid for login id utype for type of user, supervisor for user's position if           meron, at userid for the identifier.
    
- para sa pictures i-call mo si $this->get_photo(id) pwede mong makuha si id sa main.php entry['userid']. note ni-rereturn ni    entry ang list ng lahat ng tao so bale list of IDs yun.
    speaking of which eto yung ibang data: 
        'userid'
        'full_name'
        'type' (kung student, admin o faculty)
        'position' lowercase lahat to (dun sa iba hindi kasi dito ako tinamad)
        'open' (used for [closed] na tag)
        'year'
        'semester'
        'is_answered' (kung complete na)
pag naguluhan dito makikita yan: application/process/evaluation_entries.php
sa archives naman dito: application/process/evaluation_archives.php

Version 2.1.0