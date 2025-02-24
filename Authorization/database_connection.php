<?php
$host = "localhost";
$user = "postgres";
$pass = "persidatabase";
$db = "ParkCourse";
$conn = pg_connect("host=$host dbname=$db user=$user password=$pass") or die ("Could not connect to Server\n");
