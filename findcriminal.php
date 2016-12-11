<?php
session_start();
require ('connect.php');

$criminal = $db->criminal;
$rec = $officecase->find(array('inv_officer.officerid'=> $_SESSION['officerid']));