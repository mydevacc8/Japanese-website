<?php 
    require_once("conn.php");
    
    if((isset($_POST['english'])&& $_POST['english'] !='') && (isset($_POST['japanese']) && $_POST['japanese'] !=''))
    {
        $anyTags = FALSE;

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
            $addWord_query="INSERT INTO mytable (eng, kana, kanji, created) VALUES ('".$eng."','".$jap."','".$kanji."', '".date("Y-m-d")."')"; 
        }else{
            $addWord_query="INSERT INTO mytable (eng, kana, created) VALUES ('".$eng."','".$jap."', '".date("Y-m-d")."')";
        }

        
        $lastId_query="SELECT LAST_INSERT_ID()";
        
        if(!$result = $connection->query($addWord_query)){
            die('There was an error running the query [' . $conn->error . ']');
        }
        else
        {
            echo "\nThe words have been uploaded";
        }

        $wordId = $connection->query($lastId_query)->fetch_array();
        $wordId = $wordId[0];

        
        // -------------------Working with tags --------------------------
        if($anyTags === TRUE){

            for ($x = 0; $x < count($tagArray); $x++){

                // check if tag already exists
                $tagExists_query="SELECT name FROM Tags WHERE name='$tagArray[$x]'";

                // The reason for doing this way is that it prevents from getting non-object
                $result = $connection->query($tagExists_query);
                $row = $result->fetch_array();

                if ($row['name'] != ''){

                    // add tag to the word
                    echo "\nI found this".$row['name'];
                    $getTagId_query = "SELECT id FROM Tags WHERE name='$tagArray[$x]'";
                    $tagId = $connection->query($getTagId_query)->fetch_object()->id;

                    $insertNewTagRelation_query="INSERT INTO tagsrelations (tagId, wordId) VALUES ('".$tagId."','".$wordId."')";

                    if(!$result = $connection->query($insertNewTagRelation_query)){
                        die('There was an error running the query [' . $conn->error . ']');
                    }
                    else
                    {
                        echo "\nThe tag has been added to the word";
                    }

                }else{

                    // add the new tag
                    echo "\nI didnt find the tag";
                    $uploadTag_query = "INSERT INTO tags (name) VALUES ('".$tagArray[$x]."')";

                    if(!$result = $connection->query($uploadTag_query)){
                        die('There was an error running the query [' . $conn->error . ']');
                    }
                    else
                    {
                        echo "\nThe tag has been added";
                    }

                    // add the tag to the word
                    $tagId = $connection->query($lastId_query)->fetch_array();
                    $tagId = $tagId[0];

                    $insertNewTagRelation_query="INSERT INTO tagsrelations (tagId, wordId) VALUES ('".$tagId."','".$wordId."')";

                    if(!$result = $connection->query($insertNewTagRelation_query)){
                        die('There was an error running the query [' . $conn->error . ']');
                    }
                    else
                    {
                        echo "\nThe tag has been added to the word";
                    }

                }
    
    
            }
        }

    }
    else
    {
        echo "Please fill eng and jap";
    }
?>