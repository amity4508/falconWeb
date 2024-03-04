<?php
	session_start();
	include_once("common.php");
	include_once("check-session.php");	

    if (isset($_REQUEST['delete']) == 1) {        
        $contact_enquiry_obj->delete_contact_enquiry($_REQUEST['data_id']);
        header("location:enquiry-list.php"); exit;
    }
	
	$start = 0;   $limit = 0;	 
	
	$cond = " Order By contact_enquiry_id DESC";
	$contactenquiry_list = $contact_enquiry_obj->contact_enquiry_list($start,$limit,$cond);
	
	
	//print_r($contactenquiry_details[0]);
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
    <link href="assets/vendor/datatables/datatables.min.css" rel="stylesheet">
    <link href="assets/css/master.css" rel="stylesheet">
</head>

<body>
    <div class="wrapper">
       <?php include_once('sidebar.php'); ?>
        <div id="body" class="">
            <?php include_once('topbar.php'); ?>
            <div class="content">
                <div class="container">
                    <div class="page-title">
                        <h3></h3>
                    </div>
                    <div class="row">
                        
                        <div class="col-md-12 col-lg-12">
                            <div class="card">
                                <div class="card-header">Contact Enquiry List</div>
                                <div class="card-body">
                                    <p class="card-title"></p>
                                    <table class="table table-hover" id="dataTables-example" width="100%">
                                        <thead>
                                            <tr>
                                                <th>Sl.No.</th>
                                                <th>Name</th>
                                                <th>Mobile</th>
                                                <th>Email</th>
                                                <th>Website</th>
                                                <th>Message</th>
                                                
                                               
                                                <th>Date</th>
                                                
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
										<?php
                                $s = 1;
                                if (count($contactenquiry_list[0]) > 0) {
                                    foreach ($contactenquiry_list[0] as $index => $contactenquiry) {
									
														
                                        ?>  
                                            <tr>
                                                <td><?php echo $s; ?>.</td>
												
                                                <td><?php echo $contactenquiry['contact_enquiry_name'] ?></td>
                                                <td><?php echo $contactenquiry['contact_enquiry_mobile'] ?></td>
                                                <td><?php echo $contactenquiry['contact_enquiry_email'] ?></td>
                                                <td><?php echo $contactenquiry['contact_enquiry_website'] ?></td>
                                                <td><?php echo $contactenquiry['contact_enquiry_message'] ?></td>
                                                
                                              
                                                <td><?php echo $contactenquiry['added_on'] ?></td>
                                                
												<td class="text-end">
													
													
													<a href="javascript:confirmDelete('enquiry-list.php?data_id=<?php echo $contactenquiry['contact_enquiry_id'] ?>&amp;delete=1')" class="btn btn-outline-danger "><i class="fas fa-trash-alt"></i></a>
												</td>
												
												
                                            </tr>
											 <?php $s++; } }else{ ?>
											<tr><td colspan="4"><strong>contactenquiry list empty.</strong></td></tr>
                 
              
											<?php } ?>
                                            
                                        </tbody>
                                    </table>
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
    <script src="assets/vendor/datatables/datatables.min.js"></script>
    <script src="assets/js/initiate-datatables.js"></script>
    <script src="assets/js/script.js"></script>
</body>

</html>