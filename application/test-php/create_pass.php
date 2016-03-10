<?php

//~ THIS CODE IS FOR TESTING PURPOSES
include_once('php_inc/connect.php');
$uname="patient1";
$password=md5("1234");
$utype="student";
$logid="qwert";
$sql="INSERT INTO users (logid, uname, password, utype) VALUES ('".$logid."', '".$uname."', '".$password."', '".$utype."')";
$query=mysqli_query($con, $sql);

$uname="patient2";
$password=md5("5678");
$utype="faculty";
$logid="asdfg";
$sql="INSERT INTO users (logid, uname, password, utype) VALUES ('".$logid."', '".$uname."', '".$password."', '".$utype."')";
$query=mysqli_query($con, $sql);

$uname="patient3";
$password=md5("qwer");
$utype="head";
$logid="zxcvb";
$sql="INSERT INTO users (logid, uname, password, utype) VALUES ('".$logid."', '".$uname."', '".$password."', '".$utype."')";
$query=mysqli_query($con, $sql);

$uname="root";
$password=md5("root");
$utype="admin";
$logid="root";
$sql="INSERT INTO users (logid, uname, password, utype) VALUES ('".$logid."', '".$uname."', '".$password."', '".$utype."')";
$query=mysqli_query($con, $sql);
mysqli_close($con);
?>
