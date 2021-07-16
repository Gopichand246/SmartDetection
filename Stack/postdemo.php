

<?php
$servername="sql205.epizy.com";
$username="epiz_24812044";
$password="Eulid3099b";
$dbname="epiz_24812044_number";

    $conn = new mysqli($servername, $username, $password, $dbname);
    if ($conn->connect_error) {
        die("Database Connection failed: " . $conn->connect_error);
    }

    date_default_timezone_set('Asia/Kolkata');
    $d = date("Y-m-d");
    //echo " Date:".$d."<BR>";
    $t = date("H:i:s");

    if(!empty($_POST['status']) && !empty($_POST['station']))
    {
      $status = $_POST['status'];
      $station = $_POST['station'];

      $sql = "INSERT INTO logs (station, status, Date, Time)
    
    VALUES ('".$station."', '".$status."', '".$d."', '".$t."')";

    if ($conn->query($sql) === TRUE) {
        echo "OK";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
  }


  $conn->close();
?>


<?php
$servername="sql205.epizy.com";
$username="epiz_24812044";
$password="Eulid3099b";
$dbname="epiz_24812044_number";

    $conn = new mysqli($servername, $username, $password, $dbname);
    if ($conn->connect_error) {
        die("Database Connection failed: " . $conn->connect_error);
    }

    date_default_timezone_set('Asia/Kolkata');
    $d = date("Y-m-d H:i:s");
    //echo " Date:".$d."<BR>";
   // $t = date("H:i:s");

    if(!empty($_GET['status']) && !empty($_GET['remarks']) &&  !empty($_GET['smoke']) && !empty($_GET['station']))
    {
      $status = $_GET['status'];
      $remarks = $_GET['remarks']);
      $smoke = $_GET['smoke']);
      $station = $_GET['station'];

      $sql = "INSERT INTO logs (station, status,remarks,smoke, Time)
    
    VALUES ('".$station."', '".$status."','".$remarks."', '".$smoke."','".$d."')";

    if ($conn->query($sql) === TRUE) {
        echo "OK";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
  }