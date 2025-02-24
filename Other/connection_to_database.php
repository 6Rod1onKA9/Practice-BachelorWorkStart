<?php
$host = "localhost";
$user = "postgres";
$pass = "persidatabase";
$db = "ParkCourse";
$con = pg_connect("host=$host dbname=$db user=$user password=$pass") or die ("Could not connect to Server\n");
