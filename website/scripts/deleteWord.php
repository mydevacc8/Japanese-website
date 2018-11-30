<?php

    require_once('conn.php');

    if((isset($_POST['id'])&& $_POST['id'] !=''))
    {
        $wordId = $_POST['id'];

        // Deleting tags relations 
        $deleteAllTagRelations_query="DELETE FROM tagsrelations WHERE wordId='".$wordId."'";
        if(!$result = $connection->query($deleteAllTagRelations_query)){
            die('There was an error running the query [' . $connection->error . ']');
        }
        else
        {
            //echo "\nThe tags where deleted";
        }

        // Dleting the word
        $deleteWord_query="DELETE FROM mytable WHERE id='".$wordId."'";

        if(!$result = $connection->query($deleteWord_query)){
            die('There was an error running the query [' . $connection->error . ']');
        }
        else
        {
            //echo "\nThe tags where deleted";
        }
    }else{
        //echo 'Id is empty';
    }
?>