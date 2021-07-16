<!DOCTYPE html>
<html>
<head>
              <title>FIRE DETECTION </title>
              <link rel="stylesheet" type="text/css" href="FIRE.css">
              <meta http-equiv="refresh" content="5">
</head>
<body>

<header>

                           <div class="container">
                                         <div id="system">
                                                       <h1>FIRE DETECTION SYSTEM</h1>
                                         </div>
                                         <nav>
                                                       <ul>
                                                       <li class="current"><a href="#">Home</a></li>
                                                       <li><a href="#">About</a></li>
                                             </ul>
                                            </nav>
                   </div>
</header>
              <section id="showcase">
                           <div class="container">

<p> 

                           </div>
              </section>

              <section id="register">
                           <div class="container">
                                         <h1>Register to get notifications</h1>
                                         <form>
                                                       <input type="phone number" placeholder="Type your phone number">
                                                       <button class="button-1"type="submit">Submit</button>
                                         </form>
                           </div>
              </section>

              <section id="boxes">
                           <div class="container">
                                         <div class="box">
                                           <h1> click on the link to moniter sensor values</h1>
                                           <a href="https://thingspeak.com/channels/904856/private_show"><h3>link</h3></a>            
                                         </div>
                                         <style>
                                        #c4ytable {
                                            font-family: "Trebuchet MS", Arial, Helvetica, sans-serif;
                                            border-collapse: collapse;
                                            width: 100%;
                                        }

                                        #c4ytable td, #c4ytable th {
                                            border: 1px solid #ddd;
                                            padding: 8px;
                                        }

                                        #c4ytable tr:nth-child(even){background-color: #f2f2f2;}

                                        #c4ytable tr:hover {background-color: #ddd;}

                                        #c4ytable th {
                                            padding-top: 12px;
                                            padding-bottom: 12px;
                                            text-align: left;
                                            background-color: #00A8A9;
                                            color: white;
                                        }
                                        </style>

                                        <?php
                                            //Connect to database and create table
                                          
                                        $servername="sql205.epizy.com";
                                        $username="epiz_24812044";
                                        $password="Eulid3099b";
                                        $dbname="epiz_24812044_number";

                                            // Create connection
                                            $conn = new mysqli($servername, $username, $password, $dbname);
                                            // Check connection
                                            if ($conn->connect_error) {
                                                die("Database Connection failed: " . $conn->connect_error);
                                                echo "<a href='install.php'>If first time running click here to install database</a>";
                                            }
                                        ?> 


                                        <div id="cards" class="cards">

                                        <?php 
                                            $sql = "SELECT * FROM logs ORDER BY id DESC";
                                            if ($result=mysqli_query($conn,$sql))
                                            {
                                              // Fetch one and one row
                                              echo "<TABLE id='sensor_values'>";
                                              echo "<TR><TH>Sr.No.</TH><TH>Station</TH><TH>temperature</TH><TH>Date</TH><TH>Time</TH></TR>";
                                              while ($row=mysqli_fetch_row($result))
                                              {
                                                echo "<TR>";
                                                echo "<TD>".$row[0]."</TD>";
                                                echo "<TD>".$row[1]."</TD>";
                                                echo "<TD>".$row[2]."</TD>";
                                                //echo "<TD>".$row[3]."</TD>";
                                                echo "<TD>".$row[4]."</TD>";
                                                echo "<TD>".$row[5]."</TD>";
                                                echo "</TR>";
                                              }
                                              echo "</TABLE>";
                                              // Free result set
                                              mysqli_free_result($result);
                                            }

                                            mysqli_close($conn);
                                        ?>


                                        </div>
                           
              </section>

              <footer>
                           <p> Asif , GOPI , Akshay &copy;</p>
              </footer>

</body>
</html>