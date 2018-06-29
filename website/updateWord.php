<?php 
    require_once("conn.php");
    
    if((isset($_POST['english'])&& $_POST['english'] !='') && (isset($_POST['japanese']) && $_POST['japanese'] !=''))
    {
        $anyTags = FALSE;
        $wordId = $_GET['id'];

        // cheking if any tags have been added and spliting them into an array
        if(isset($_POST['tags'])&& $_POST['tags'] !=''){

            $tag = $connection->real_escape_string($_POST['tags']);
            $tagArray = explode(",", $tag);

            // getting rid of the white spaces at the beggining
            for($x = 0; $x < count($tagArray); $x++){
                if (($tagArray[$x])[0] === ' '){
                    $tagArray[$x] = ltrim($tagArray[$x], ' ');
                }
            }

            $anyTags = TRUE;
            echo "Got Tags";
        }

        $eng = $connection->real_escape_string($_POST['english']);
        $jap = $connection->real_escape_string($_POST['japanese']);


        // uploading word and getting its id
        if(isset($_POST['kanji'])&& $_POST['kanji'] != ''){
            $kanji = $connection->real_escape_string($_POST['kanji']);

            $updateWord_query="UPDATE mytable SET kana='".$jap."', eng='".$eng."', kanji='".$kanji."' WHERE id =".$wordId;
        }else{

            $updateWord_query="UPDATE mytable SET kana='".$jap."', eng='".$eng."', kanji=NULL WHERE id =".$wordId;
        }
        
        if(!$result = $connection->query($updateWord_query)){
            die('There was an error running the updateWord_quesry [' . $connection->error . ']');
        }
        else
        {
            echo "\nThe words have been updated";
        }
        
        if($anyTags === TRUE){

            echo "\n Got some tags";
            $getTagRelations_query = "SELECT * FROM tagsrelations WHERE wordId =".$wordId;

            $result = $connection->query($getTagRelations_query);
        
            // Deleting old tags
            while($row = $result->fetch_array()){
                $found = FALSE;
                for ($x = 0; $x < count($tagArray); $x++){
                    $workingTagRelationId = $row['id'];
                    $tagId = $row['tagId'];

                    $getTagName_query = "SELECT name FROM tags WHERE id =".$tagId;

                    $tagName = $connection->query($getTagName_query)->fetch_object()->name;

                    if ($tagName === $tagArray){
                        $found = TRUE;
                    }
                }

                if ($found === FALSE){
                    $deleteRelation_query = "DELETE FROM tagsrelations WHERE id =".$workingTagRelationId;
                    if(!$r = $connection->query($deleteRelation_query)){
                        die('There was an error running the query [' . $connection->error . ']');
                    }
                    else
                    {
                        echo "\nThe tag was deleted";
                    }
                }
            }

            echo "\n Finished deleting";

            // Cheks if any new tags has been added
            for ($x = 0; $x < count($tagArray); $x++){

                $getTagId_query = "SELECT id FROM tags WHERE name ='".$tagArray[$x]."'";

                $result = $connection->query($getTagId_query);
                $row = $result->fetch_array();

                echo "\nThe tag id is: ".$row['id'];

                // If its a new tag
                if($row['id'] == ''){
                    echo "\nI am now here";
                    $createTag_query = "INSERT INTO tags (name) VALUES ('".$tagArray[$x]."')";

                    if(!$result = $connection->query($createTag_query)){
                        die('There was an error running the query [' . $conn->error . ']');
                    }
                    else
                    {
                        echo "\nThe tag has been created";
                    }

                    // Gets the new tags id
                    $lastId_query="SELECT LAST_INSERT_ID()";
                    $tagId = $connection->query($lastId_query)->fetch_array();
                    $tagId = $tagId[0];

                    // Create tag relation
                    $createTagRelation_query = "INSERT INTO tagsrelations (wordId, tagId) VALUES ('".$wordId."', '".$tagId."')";
                    if(!$result = $connection->query($createTagRelation_query)){
                        die('There was an error running the query [' . $conn->error . ']');
                    }
                    else
                    {
                        echo "\nThe tag has been added to the word";
                    }
                    
                // If the tag is known
                }else{

                    $tagId = $row['id'];
                    $createTagRelation_query = "INSERT INTO tagsrelations (wordId, tagId) VALUES ('".$wordId."', '".$tagId."')";
                    if(!$result = $connection->query($createTagRelation_query)){
                        die('There was an error running the query [' . $conn->error . ']');
                    }
                    else
                    {
                        echo "\nThe tag has been added to the word";
                    }
                    

                }

                

                
            }

           
        }else{
            echo "\n there are no tags";
            $deleteAllTagRelations_query="DELETE FROM tagsrelations WHERE wordId='".$wordId."'";
            if(!$result = $connection->query($deleteAllTagRelations_query)){
                die('There was an error running the query [' . $connection->error . ']');
            }
            else
            {
                echo "\nThe tags where deleted";
            }

        }

    }
    else
    {
        echo "Please fill eng and jap";
    }
?>