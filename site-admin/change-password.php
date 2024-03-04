<?php
	session_start();
	include_once("common.php");
	include_once("check-session.php");	 
	
	if($_POST)
	{
		
		$_POST['old_password'] = trim($_POST['old_password']);	
		$_POST['new_password'] = trim($_POST['new_password']);	
		$_POST['confirm_password'] = trim($_POST['confirm_password']);
		
		$admin_details = $admin_obj->admin_details($_SESSION["falcon_user_id"]);
		$decrypted_password = base64_decode($admin_details[0]['admin_password']);
		//echo $decrypted_password; exit;
		if($_POST['old_password']<>$decrypted_password){
			$_SESSION['err_msg'] = 'Old password is wrong!';
			header("location:change-password.php"); exit;
		}
		if($_POST['new_password']<>$_POST['confirm_password']){
			$_SESSION['err_msg'] = 'New password and confirm password do not match!';
			header("location:change-password.php"); exit;
		}
		
		$new_password = base64_encode($_POST['new_password']);
	
		if($_POST['actionmode'] == "Change Password"){  //print_r($_POST); die();
			
			$insertid = $admin_obj->update_admin(array('admin_password'=>$new_password),$_SESSION["falcon_user_id"]);
			$_SESSION['msg'] = 'Password changed successfully!';	
			header("location:change-password.php"); exit;
		}
					
	}
	$actionmode = "Change Password";
	
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
                         
                       
                        <div class="col-lg-12">
                            <div class="card">
                                <div class="card-header">Change Password</div>
                                <div class="card-body">
                                    <!--<h5 class="card-title"></h5>-->
                                    <form accept-charset="utf-8" method="post" enctype="multipart/form-data">
											<?php if(isset($_SESSION['err_msg']) && $_SESSION['err_msg']<>''){?>
											<p class="text-danger"><?php echo $_SESSION['err_msg']; unset($_SESSION['err_msg']);?></p>
											<?php }?>
											
											<?php if(isset($_SESSION['msg']) && $_SESSION['msg']<>''){?>
											<p class="text-success"><?php echo $_SESSION['msg']; unset($_SESSION['msg']);?></p>
											<?php }?>

											
                                        <div class="mb-3 row">
                                            <label class="col-sm-2 form-label" for="old_password">Old Password<span style="color:red">*</span></label>
                                            <div class="col-sm-4">
                                                <input type="password" name="old_password" placeholder="Old Password" class="form-control" value="" required="true">
                                                
                                            </div>
                                        </div>
										<div class="mb-3 row">
                                            <label class="col-sm-2 form-label" for="new_password">New Password<span style="color:red">*</span></label>
                                            <div class="col-sm-4">
                                                <input type="password" name="new_password" placeholder="New Password" class="form-control" value="" required="true">
                                                
                                            </div>
                                        </div>
										<div class="mb-3 row">
                                            <label class="col-sm-2 form-label" for="confirm_password">Confirm Password<span style="color:red">*</span></label>
                                            <div class="col-sm-4">
                                                <input type="password" name="confirm_password" placeholder="Confirm Password" class="form-control" value="" required="true">
                                                
                                            </div>
                                        </div>
										
                                        <div class="mb-3 row">
                                            <div class="col-sm-10 offset-sm-2">
                                               
												<input type="submit" class="btn btn-danger" name="actionmode" value="Change Password" />
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
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