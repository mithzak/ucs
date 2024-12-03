<?php
//error_reporting(0);
class Crud{
	
	private $conn;
	
	public function __construct($host,$user,$pass,$db){
		
		$conn=new mysqli($host,$user,$pass,$db);
		
		if ($conn->connect_error) {
    die('Connect Error (' . $conn->connect_errno . ') '
            . $conn->connect_error);
}
	$this->conn=$conn;
		
	}
	
	public function selectAll($table){
		
		$result=$this->conn->query("SELECT * FROM $table");
		if($result->num_rows>0){
			return $result->fetch_all(MYSQLI_ASSOC);
			
		}
		
	}
	
	public function selectAllByColumn($table,array $columns){
		
		$sql="SELECT ";

			foreach($columns as $val){
				$sql.=	$val.", ";
			}

			$sql=substr($sql,0,-2);

			$sql.=" FROM $table";
			echo $sql;
			$q = $this->conn->query($sql) or die("failed!");
			
			$str=<<<"table"
			<table width="100%" border="1" cellspacing="0" 	 cellpadding="5">
  <tr>
table;
	foreach($columns as $col){
	$str.='<th scope="col">'.ucfirst($col).'</th>';
	
	}
	$str.="</tr>";
	while($r = $q->fetch_assoc()){
	 $data[]=$r;
	 }
	foreach($data as $val){
		$str.="<tr>";
	foreach($val as $val1){
		$str.= "
    <td>$val1</td>
  ";
	}
	
$str.='</tr>';
}
 
$str.="</table>";


 return $str;
 
		
	}
	
}

$conn=new Crud("localhost","palash","pol1169","labonibd");

echo "<pre>";

print_r($conn->selectAll("menu_details"));

echo $conn->selectAllByColumn("menu_details",array('menu_id'));