<?php
  
session_start();

include_once("common.php");

/*if($_SESSION['db_user_id']){
	header("location:dashboard.php");
}

*/

if($_POST) { //print_r($_POST);

	if($_POST['login'] == "Login"){  //print_r($_POST); die();  		


		$username=trim($_POST['username']);
		$password=base64_encode($_POST['password']);

		$cond = " admin_email='".$username."' and admin_password='".$password."' and admin_status = 1";

		$admin_data = $admin_obj->admin_login($cond);  //print_r($admin_data); die(); 

		

		if(count($admin_data[0])==1){

				$_SESSION["falcon_user_id"] = $admin_data[0][0]['admin_id'];

				$_SESSION["full_name"] = $admin_data[0][0]['admin_firstname'] . ' ' . $admin_data[0][0]['admin_lastname'];

				$_SESSION["access"] = $admin_data[0][0]["admin_access"];

				header("Location:dashboard.php");	exit;	

		}else{

			$_SESSION['msg'] = "Wrong Username or Password";

		}

	}

	if($_GET['action'])

	{

	$_SESSION['msg'] = 'Logout Successfully!';

	}

}

?>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Falcon Corporation Admin Panel</title>
    <link href="assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link href="assets/css/auth.css" rel="stylesheet">
</head>

<body>
    <div class="wrapper">
        <div class="auth-content">
            <div class="card">
                <div class="card-body text-center">
                    <div class="mb-4">
                        <!--<img class="brand" src="assets/img/logo.png" alt="logo" width="320">-->
                    </div>
                    <h2 class="mb-4 text-muted">Falcon Corporation <br />ADMIN LOGIN</h2>
                    <form method="post" action="index.php" id="loginForm" name="loginForm" onSubmit="return checklogin();">
                        
						<p class="text-danger"><?php if(isset($_SESSION['msg'])){ echo $_SESSION['msg']; unset($_SESSION['msg']);}?></p>
						
						<div class="mb-3 text-start">
                            <label for="username" class="form-label">Username</label>
                            <input type="text" name="username" class="form-control" placeholder="Enter Username" required>
                        </div>
                        <div class="mb-3 text-start">
                            <label for="password" class="form-label">Password</label>
                            <input type="password" name="password" class="form-control" placeholder="Password" required>
                        </div>
                        
						<!--<div class="mb-3 text-start">
                            <div class="form-check">
                              <input class="form-check-input" name="remember" type="checkbox" value="" id="check1">
                              <label class="form-check-label" for="check1">
                                Remember me on this device
                              </label>
                            </div>
                        </div>-->
						
                        <!--<button class="btn btn-danger shadow-2 mb-4">Login</button>-->
						
						<input class="btn  btn-danger shadow-2 mb-4" type="submit" name="login" value="Login"  onClick="myFunction()" />
                    </form>
                    
					<!--<p class="mb-2 text-muted">Forgot password? <a href="forgot-password.html">Reset</a></p>
                    <p class="mb-0 text-muted">Don't have account yet? <a href="signup.html">Signup</a></p>-->
					
                </div>
            </div>
        </div>
    </div>
    <script src="assets/vendor/jquery/jquery.min.js"></script>
    <script src="assets/vendor/bootstrap/js/bootstrap.min.js"></script>

<script language="JavaScript">

function checklogin() { //alert('k');

		if (document.loginForm.username.value == '') 
		{
		alert("Your username is Missing!");

		document.loginForm.username.focus()

		return false;

		}
		

		if (document.loginForm.password.value == '') 

		{

		alert("Please enter your password!");

		document.loginForm.password.focus()

		return false;

		}		

		}

</script>

</body>

</html>