<?php
	session_start();
	include_once("common.php");
	include_once("check-session.php");	 
	
	
	
	//print_r($category_details[0]);
	//die('k');
		
?>
<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Admin - Falcon Corporation</title>
    <link href="assets/vendor/fontawesome/css/fontawesome.min.css" rel="stylesheet">
    <link href="assets/vendor/fontawesome/css/solid.min.css" rel="stylesheet">
    <link href="assets/vendor/fontawesome/css/brands.min.css" rel="stylesheet">
    <link href="assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link href="assets/css/master.css" rel="stylesheet">
</head>

<body>
    <div class="wrapper">
        
        <?php include_once('sidebar.php'); ?>
       
        <div id="body" class="active">
            
            <?php include_once('topbar.php'); ?>
      
            <div class="content">
                <div class="container">
                    <div class="page-title">
                        <h3></h3>
                    </div>
                    <div class="row">
					
					 <div class="col-sm-12">
							<p style="font-size:30px;">Welcome to Admin Panel</p>
                        </div>
                        
                        
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="assets/vendor/jquery/jquery.min.js"></script>
    <script src="assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="assets/js/form-validator.js"></script>
    <script src="assets/js/script.js"></script>
</body>

</html>