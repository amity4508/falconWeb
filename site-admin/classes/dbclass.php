<?php
/* 
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
class dbclass{
    public function __construct() {
        global $con;
		$con=false;

	 	//  $server = 'localhost';
		// $username = 'root';
		// $password = '';
		// $database = 'falconcorporatio_db';
		
	    $server = 'localhost';
		$username = 'falconcorporatio_db';
		$password = 'Z(Z4R3^D$f@@';
		$database = 'falconcorporatio_db';  
	    
				
	  $con = mysqli_connect($server,$username,$password,$database) or die('Server connection not possible.'.mysqli_error());
		
    }

 
	 protected function connect(){ 
		 
	 
    }
	
	

    protected function query($query){
		global $con;		
        $result = mysqli_query($con,$query) or die(mysqli_error($con));
        return $result;
    }
	
    protected function totalrcds($tablename, $cond = '') {		
		global $con;		
        $query = "select count(*) as totalrcds from " . $tablename . " Where 1";

        if($cond <> ""){
            $query .= " $cond"; 
        }
				

//        echo $query;

        $result = mysqli_query($con,$query) or die(mysqli_error($con));
        return $this->fetchassoc($result);
    }
    
    protected function paging($total,$start,$limit,$qstr=''){
	preg_match_all('/start=[\d]/', $qstr, $matches);
	$newstrGet = "";
	
	foreach($matches[0] as $index=>$match){
		$newstrGet = str_replace($match,"",$qstr);
	}
	
	if($newstrGet <> ""){
		$qstr = $newstrGet;
	}
	
		$pagingcode = "";	
        if($total > 0){
			$pos = strpos($_SERVER['REQUEST_URI'], '?start=');
			if($pos === false){
			$url =  'http://' . $_SERVER['HTTP_HOST'] . $_SERVER['PHP_SELF'];
			}
			else{
			$url =  substr($_SERVER['REQUEST_URI'],0,$pos);
			}
			$pagingcode = '<table width="50%" cellpadding="5" cellspacing="5" align="center">';
			$pagingcode .= '<tr>';
			
			
			if(($start-$limit) >= 0){
			$pagingcode .= '<td bgcolor="#fff"  nowrap="nowrap"  align="center" onClick="location.href=\''.$url.'?start='.($start-$limit).$qstr.'\'"  onmouseover="changeCSS(this,\'#f15922\',\'#f15922\',\'#fff\');this.style.cursor=\'hand\'" onMouseOut=\'changeCSS(this,"#e9e9e9","#e9e9e9","#000");\' class="navigation"><< Prev</td>';
			}
			else{
			$pagingcode .= '<td bgcolor="#fff"  nowrap="nowrap"  align="center">&nbsp;</td>';
			}
			
			//$pagingcode .= '<td >';
			if($limit > 0){
				$totalpage = ceil($total/$limit);
			}
			
			
			if(isset($totalpage) && $totalpage > 1){
			for ($i = 0; $i < $totalpage; $i++) {
			$pagingcode .= '<td bgcolor="#fff"  nowrap="nowrap"  align="center" onClick="location.href=\'' . $url . '?start=' . ($i * $limit) .$qstr. '\'"  onmouseover="changeCSS(this,\'#f15922\',\'#f15922\',\'#fff\');this.style.cursor=\'hand\'" onMouseOut=\'changeCSS(this,"#e9e9e9","#e9e9e9","#000");\' class="navigation">' . ($i + 1) . '</td>';
			}
			}
			
			//$pagingcode .= '</td>';
			
			if(($start+$limit) < $total){
			$pagingcode .= '<td bgcolor="#fff"  nowrap="nowrap"  align="center" onClick="location.href=\''.$url.'?start='.($start+$limit).$qstr.'\'"  onmouseover="changeCSS(this,\'#f15922\',\'#f15922\',\'#fff\');this.style.cursor=\'hand\'" onMouseOut=\'changeCSS(this,"#e9e9e9","#e9e9e9","#000");\' class="navigation">Next >></td>';
			}
			else{
			$pagingcode .= '<td bgcolor="#fff"  nowrap="nowrap"  align="center">&nbsp;</td>';
			}
			
			$pagingcode .="</table>";
		}
        
        
        return $pagingcode;
    }
    
    protected function numrows($result){
        $numrows = mysqli_num_rows($result);
        return $numrows;
    }

    protected function fetchassoc($result){
        $assocarr = array();
        while($row = mysqli_fetch_assoc($result)){
            $assocarr[] = $row;
        }
        return $assocarr;
    }

    protected function fetcharray($result){
        $arr = array();
        while($row = mysqli_fetch_array($result)){
            $arr[] = $row;
        }
        return $arr;
    }
    
    protected function fetchobject($result){
        $obj = mysqli_fetch_object($result);
        return $obj;
    }

    protected function lastinsertId(){
		global $con;
        return mysqli_insert_id($con);
    }

    
}
?>