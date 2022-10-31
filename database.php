<?php
    
    //CONNECT TO MYSQL DATABASE USING MYSQLI


 
                $dbname = "youcodescumboard";
                $conn = new mysqli("localhost","root","",$dbname);

                // Check connection
                if ($conn-> connect_error) {
                  echo "Failed to connect to MySQL: " . $conn-> connect_error;
                  exit();
                }
                else{
                }
                // $sql = "SELECT id, title FROM  form_inputs";
                // $result = $mysqli->query($sql);

                // if ($result->num_rows > 0) {
                // // output data of each row
                // while($row = $result->fetch_assoc()) {
                //     echo "id: " . $row["id"]. " - Name: " . $row["title"]."<br>";
                // }
                // } else {
                // echo "0 results";
                // }
                // $mysqli->close();


                

    
?>