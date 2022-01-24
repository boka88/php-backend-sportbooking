<?php
//baza setup
$host2	= "sdb-e.hosting.stackcp.net";
$user2	= "binsoftsetup-313833482b";
$pass2	= "bqyf3i8upn";
$baza2	= "binsoftsetup-313833482b";
$veza2	= mysqli_connect($host2,$user2,$pass2,$baza2);
mysqli_set_charset($veza2,"utf8");

//baza clanova
$host1	= "sdb-o.hosting.stackcp.net";
$user1	= "binsoftdemo-3139379eda";
$pass1	= "og9dj05yuq";
$baza1	= "binsoftdemo-3139379eda";
$veza1	= mysqli_connect($host1,$user1,$pass1,$baza1);
mysqli_set_charset($veza1,"utf8");

?>