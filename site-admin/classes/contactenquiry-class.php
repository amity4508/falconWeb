<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
include_once 'dbclass.php';
include_once 'general.php';
class contactenquiry extends dbclass {

    public function __construct() {
        parent::__construct();
    }

    public function contact_enquiry_details($id) {
        $query = "select * from contact_enquiry where contact_enquiry_id = ".$id;
        $result = $this->query($query);
        $nRows = $this->numrows($result);
        if ($nRows > 0) {
            return $this->fetchassoc($result);
        } else {
            return array();
        }
    }

    public function contact_enquiry_list($start = 0,$limit = 0, $cond = '') {
	
        $totalrcds = $this->totalrcds('contact_enquiry');
        $pagingcode = $this->paging($totalrcds[0]['totalrcds'], $start, $limit);        
        if($totalrcds[0]['totalrcds'] > 0){
	    	$start = $totalrcds[0]['totalrcds'] < $start?0:$start;	
			$sql = "SELECT 
						contact_enquiry_id, contact_enquiry_name, contact_enquiry_mobile,contact_enquiry_email, contact_enquiry_website,contact_enquiry_message,						
						date_format(date(contact_enquiry_inserted),'%d-%m-%Y') as added_on
				    FROM contact_enquiry								
				    WHERE 1 "; // and date(created)=curdate()
			
                if($cond <> ""){
                     $sql .= " $cond"; 
                }
            
			//$sql .= " order by contact_enquiry_name ASC";
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
   	
	public function add_contact_enquiry($post = array()) {
			
		$query = "Insert Into contact_enquiry SET ";
        foreach ($post as $ini => $val) {
             
                if ($val <> "") {
                    $query .= $ini . " = '" . $val . "',";
                }
            
        }
		$datetime = date("Y-m-d H:i:s");
        $query .= "contact_enquiry_inserted = '$datetime', contact_enquiry_updated='$datetime'";
        $result = $this->query($query);
        $insertid = $this->lastinsertId();
        return $insertid;
    }

    
    public function delete_contact_enquiry($id) {
	
        $query = "Delete from contact_enquiry Where contact_enquiry_id=" . $id;
        $result = $this->query($query);
        return $result;
    }
}

?>
