<?php

$servername="sql205.epizy.com";
$username="epiz_24812044";
$password="Eulid3099b";
$dbname="epiz_24812044_number";

    date_default_timezone_set('Asia/Kolkata');
    $d = date("Y-m-d");
   


class sensorvalues {
public $link='';
	
function_construct($station,$status,$remarks,$smoke,$d)
{
	$this->connect();
	$this->storeInDb($station,$status,$remarks,$smoke,$d);
}
		

		function connect()
		{
			$this->link =msquli_connect($servername, $username, $password, $dbname) or die ('cant connect to db');
			mysqli_select_db($this->link,'sensorvalue')or die('error query:',$sql);
		}


		function storeInDb($station,$status,$range,$smoke,$d)
		{
				
				$sql = "INSERT INTO sensorvalue (station, status, range,smoke ,Time) 
				VALUES ('".$station."', '".$status."','".range."','".smoke."', '".$d."')";
		    
		    $result=mysqli_query($this->link,$sql) or die('error query:',$sql);
		}
    

    if(!empty($_GET['status']) && !empty($_GET['remarks']) &&  !empty($_GET['smoke']) && !empty($_GET['station']))
    {
    $sensorvalues=new sensorvalues($_GET['station'],$_GET['status'],$_GET['remarks']),$_GET['smoke']);
    }


}

?>