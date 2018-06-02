<!DOCTYPE html>
<html>
    <head>

        <title>Japanese Vocab V0</title>
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" integrity="sha384-WskhaSGFgHYWDcbwN70/dfYBj47jz9qbsMId/iRN3ewGhXQFZCSftd1LZCfmhktB" crossorigin="anonymous">
        <link rel="stylesheet" type="text/css" href="genstyle.css">
    </head>

    <body>
        <!-- Temperory solution until I work out how to use ajax  -->
        <div class="container">
        <form action="" method="post">
            <div class="form-group">
                <label for="size">Number of words</label>
                <input type="text" class="form-control input-lg" name="size" id="size"/>
                <br/>
                <button type="submit" class="btn btn-default">Submit</button>
            </div>
        </form>
        </div>

<?php

    require_once('conn.php');

    $size = $_POST["size"]; // user input

    // getting size of the db
    $getMaxIdQuery = "SELECT id FROM mytable WHERE id = (SELECT MAX(id) FROM mytable)";

    $result=mysqli_query($connection, "SELECT count(*) as total from mytable");
    $data=mysqli_fetch_assoc($result);
    $count = $data['total'];

    // checks if user input is greater than the db size
    if ($size > $count){
        $size = $count;
    }

    $toSend = array();

    $getWordsQuery = "SELECT id FROM mytable ORDER BY RAND() LIMIT $size";
    $result = $connection->query($getWordsQuery); 

    // Chnages look of the page depending if the input was correct
    if ($result != ''){
        // get the random ids and add them to toSend list
        while($row = $result->fetch_array()) {
            array_push($toSend,$row['id']);
        } 
        $k = implode(',', $toSend); //List that is used in the url
        include 'includes/genbottom.php';
    }else{
        include 'includes/genbottomtext.php';
    }
?>