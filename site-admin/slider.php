<?php
	session_start();
	include_once("common.php");
	include_once("check-session.php");	

    if (isset($_REQUEST['delete']) && $_REQUEST['delete'] == 1) {        
        $slider_obj->delete_slider($_REQUEST['data_id']);
        header("location:slider-list.php"); exit;
    }
	
	if($_POST)
	{
		
		$_POST['slider_title'] = trim($_POST['slider_title']);	
		
		
		if($_POST['actionmode'] == "Add"){  //print_r($_POST); die();
			
			$insertid = $slider_obj->add_slider(array('slider_title'=>$_POST['slider_title']));
						
			header("location:slider-list.php"); exit;
		}
		
		if($_POST['actionmode'] == "Update"){
		
			$insertid = $slider_obj->update_slider(array('slider_title'=>$_POST['slider_title']),$_POST['id']);			
			
			header("location:slider-list.php");exit;
		}
				
	
	}
	$slider_details = (isset($_REQUEST['id']) && $_REQUEST['id'] <>"")?$slider_obj->slider_details($_REQUEST['id']):array();
	
	$actionmode = (isset($_REQUEST['id']) && $_REQUEST['id'] <>"")?"Update":"Add";
	
	//print_r($slider_details[0]);
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
                                <div class="card-header">Add slider</div>
                                <div class="card-body">
                                    <!--<h5 class="card-title"></h5>-->
                                    <form accept-charset="utf-8" method="post" enctype="multipart/form-data">
									
									<?php if(isset($_REQUEST['id']) && $_REQUEST['id'] <>""){ ?>                    			
							
									<input type="hidden" name="id" value="<?php echo $_REQUEST['id'];?>" />
								 <?php } ?>
						 
                                       <!-- <div class="mb-3 row">
                                            <label class="col-sm-2 form-label" for="slider_title">Title</label>
                                            <div class="col-sm-10">
                                                <input type="text" name="slider_title" placeholder="Name" class="form-control" value="<?php echo isset($slider_details[0]['slider_title'])?$slider_details[0]['slider_title']:'';?>" required="true">
                                                
                                            </div>
                                        </div>-->
										
										
										<div class="mb-3 row">
                                            <label class="col-sm-2 form-label" for="slider_image">Image</label>
                                            <div class="col-sm-10">
                                                <input type="file" name="slider_image" placeholder="" class="form-control">
                                            </div>
                                        </div>
										
										<div class="mb-3 row">
                                            <label class="col-sm-2 form-label" for="old_slider_image"></label>
                                            <div class="col-sm-10">
                                                <?php if(isset($slider_details[0]) && $slider_details[0]['slider_image']<>""){?>
												  <img src="../uploads/images/slider/<?php echo $slider_details[0]['slider_image'];?>" width="150">
												  
												  <input type="hidden" name="old_slider_image" value="<?php echo $slider_details[0]['slider_image'];?>" />
												   
												  <?php }?>
                                            </div>
                                        </div>
										
										
                                        <div class="mb-3 row">
                                            <div class="col-sm-10 offset-sm-2">
                                               
												<input type="submit" class="btn btn-danger" name="actionmode" value="<?php echo $actionmode;?>" />
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