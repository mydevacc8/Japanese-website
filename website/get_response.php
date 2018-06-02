<?php 
    require_once("conn.php");
    
    if((isset($_POST['english'])&& $_POST['english'] !='') && (isset($_POST['japanese'])&& $_POST['japanese'] !=''))
    {
        $eng = $connection->real_escape_string($_POST['english']);
        $jap = $connection->real_escape_string($_POST['japanese']);
        
        $sql="INSERT INTO mytable (eng, jap) VALUES ('".$eng."','".$jap."')";
        
        
        if(!$result = $connection->query($sql)){
            die('There was an error running the query [' . $conn->error . ']');
        }
        else
        {
            echo "Thank you! We will contact you soon";
        }
    }
    else
    {
        echo "Please fill eng and jap";
    }
?>