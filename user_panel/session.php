<?php

include_once("../include/conn.php");

session_start();

if (!isset($_SESSION['agency_username'])) {
    header("location: login.php");
}

?>