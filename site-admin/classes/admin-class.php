<?php
include_once 'dbclass.php';

include_once 'general.php';

class admin extends dbclass {



    public function __construct() {

        parent::__construct();

    }



    public function admin_details($id) {

        $query = "select * from admin where admin_id = ".$id;

        $result = $this->query($query);

        $nRows = $this->numrows($result);

        if ($nRows > 0) {

            return $this->fetchassoc($result);

        } else {

            return array();

        }

    }



    public function admin_login($cond) {

	

        $totalrcds = $this->totalrcds('admin');

        $pagingcode = $this->paging($totalrcds[0]['totalrcds'], $start, $limit);        

        if($totalrcds[0]['totalrcds'] > 0){

	    	$start = $totalrcds[0]['totalrcds'] < $start?0:$start;	

			$sql = "select * from admin where  "; // and date(created)=curdate()

			                

            $sql .= " $cond";  

			// die( $sql);

			$result = $this->query($sql);

			$catarr = array($this->fetchassoc($result));

			return $catarr;

		} 

		else 

		{

			return array();

		}

	}

	

	public function admin_list($start = 0,$limit = 0,$cond='') {

	

        $totalrcds = $this->totalrcds('admin');

        $pagingcode = $this->paging($totalrcds[0]['totalrcds'], $start, $limit);        

        if($totalrcds[0]['totalrcds'] > 0){

	    	$start = $totalrcds[0]['totalrcds'] < $start?0:$start;	

			$sql = "select admin_id, admin_firstname, admin_lastname, admin_email, admin_phone,

			        admin_password, admin_photo, admin_access, admin_status, date_format(date(admin_created),'%d-%m-%Y') as added_on

					from admin where 1 "; // and date(created)=curdate()

			

                if($cond <> ""){

                     $sql .= " $cond"; 

                }

            

			//$sql .= " order by firstname ASC";

			if ($limit > 0) {

               $sql .= " Limit " . $start . "," . $limit;

            }

			$result = $this->query($sql);

			$catarr = array($this->fetchassoc($result),'paging'=>$pagingcode);

			return $catarr;

		} 

		else 

		{

			return array();

		}

	}

   	

	public function add_admin($post = array()) {

		

        $genobj = new general();

	

			if($_FILES['photo']['error'] == 0){

            	$imagename = $genobj->uploadfile($_FILES['photo'],'uploads/images/',array('upload'=>'image','ext'=>array('jpg','jpeg','gif','png')));

        	}

			if($imagename){

           		$post['admin_photo']  = $imagename;	

	        }

		   

		$query = "Insert Into admin SET ";

        foreach ($post as $ini => $val) {

             if ($ini <> "actionmode" && $ini <> "id") {

                if ($val <> "") {

                    $query .= $ini . " = '" . $val . "',";

                }

            }

        }

        $query .= "admin_created = now(), admin_modified=now()";

        $result = $this->query($query);

        $insertid = $this->lastinsertId();

        return $insertid;

    }



    public function update_admin($post = array(),$id) {

		

        $genobj = new general();

	

			if($_FILES['photo']['error'] == 0){

            	$imagename = $genobj->uploadfile($_FILES['photo'],'uploads/images/',array('upload'=>'image','ext'=>array('jpg','jpeg','gif','png')));

        	}

			if($imagename){

           		$post['admin_photo']  = $imagename;	

	        }

			

		$query = "Update admin SET ";

        foreach ($post as $ini => $val) {

		  if ($ini <> "actionmode" && $ini <> "id") {

            if ($val <> "") {

                $query .= $ini . " = '" . $val . "',";

            }

          }

		}

        $query .= " admin_modified=now()";

        $query .= " Where admin_id=" . $id;

		

        $result = $this->query($query);

        return $result;

    }



    public function delete_admin($id) {

	

        $query = "Delete from admin Where admin_id=" . $id;

        $result = $this->query($query);

        return $result;

    }

}



?>

