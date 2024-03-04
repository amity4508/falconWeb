<?php
ob_start(); 
session_start();

//error_reporting(0);

if(function_exists('date_default_timezone_set'))
{
	date_default_timezone_set('Asia/Kolkata');
}




include_once 'site-admin/classes/contactenquiry-class.php';
$contact_enquiry_obj = new contactenquiry();
?>