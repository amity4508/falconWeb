<?php
ob_start(); 
//session_start();

//error_reporting(0);

// error_reporting(E_ALL ^E_NOTICE);
if(function_exists('date_default_timezone_set'))
{
	date_default_timezone_set('Asia/Kolkata');
}


include_once 'classes/admin-class.php';
$admin_obj = new admin();

include_once 'classes/contactenquiry-class.php';
$contact_enquiry_obj = new contactenquiry();

?>
<script language='JavaScript'>            
            function confirmDelete(delUrl) {
                if (confirm("Are you sure you want to delete")) {
                    document.location = delUrl;
                }
            }          
                       
        </script>