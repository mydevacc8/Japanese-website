<!DOCTYPE html>
<html>
    <head>

        <title>Japanese Vocab V0</title>
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" integrity="sha384-WskhaSGFgHYWDcbwN70/dfYBj47jz9qbsMId/iRN3ewGhXQFZCSftd1LZCfmhktB" crossorigin="anonymous">
    </head>

    <body>
        <?php

            require_once('conn.php');

            $ids = $_GET['id'];
            $getAllWords_query = "SELECT * FROM mytable WHERE id = $ids";
            $result=mysqli_query($connection, $getAllWords_query);
            $row = $result->fetch_array(); 

            $getTagRelations_query = "SELECT tagId FROM tagsrelations WHERE wordId = $ids";
            $tagResult=mysqli_query($connection, $getTagRelations_query);
            

            $tagString = "";

            while($tagRow = $tagResult->fetch_array()){
                $tagId = $tagRow['tagId'];
                $getTagNames_query = "SELECT name FROM tags WHERE id = $tagId";
                $tagNameResult = mysqli_query($connection, $getTagNames_query);
                $tagNameRow = $tagNameResult->fetch_array();


                if ($tagNameRow['name'] != ''){
                    if ($tagString === ""){
                        $tagString .= $tagNameRow['name'];
                    }else{
                        $tagString .= ", ".$tagNameRow['name'];
                    }
                }
            }

        ?>
         <div class="container">
            <form name="newWord-form" action="" method="post" id="newWord-form">
                <div class="form-group">

                    <label for="english">English</label>
                    <input type="text" class="form-control input-lg" name="english" placeholder="Mirror" value=<?php echo $row['eng'] ?> required/>

                </div>

                <div class="form-group">
                    <label for="japanese">Japanese</label>
                    <input type="text" class="form-control input-lg" name="japanese" placeholder="かがみ" value=<?php echo $row['kana'] ?> required/>
                </div>

                <div class="form-group">
                    <label for="kanji">Kanji</label>
                    <input type="text" class="form-control input-lg" name="kanji" placeholder="鏡" <?php $kanji = $row['kanji']; if($kanji === NULL){
                       echo "value = ''";
                    }else{
                        echo "value = '".$kanji."'";
                    } ?> />
                </div>

                <div class="form-group">
                    <label for="tags">Tags</label>
                    <input type="text" class="form-control input-lg" name="tags" placeholder="Body Parts, Genki 1 Chapter 1, Transport..." <?php echo "value = '".$tagString."'"; ?>/>
                </div>

                <button type="submit" class="btn btn-primary" name="submit" value="Submit" id="submit_form">Update</button>
                
            </form>

            <div><br/></div>

            <button onclick="window.location='http://localhost/Japanese-website/website/pages/admin.php'" class="btn btn-primary">Back</button>

        </div>
        <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js" integrity="sha384-smHYKdLADwkXOn1EmN1qk/HfnUcbVRZyYmZ4qpPea6sjB/pTJ0euyQp0Mk8ck+5T" crossorigin="anonymous"></script>
        <script src="https://ajax.aspnetcdn.com/ajax/jQuery/jquery-3.3.1.min.js"></script>

        <script>
            var url_string = window.location.href; //window.location.href
            var url = new URL(url_string);
            var c = url.searchParams.get("id");
            console.log(c);

            $(document).ready(function(){
                
                $("#newWord-form").submit(function(e){
                    e.preventDefault();
                    if($("#newWord-form [name='english']").val() === '')
                    {
                        
                        //$("#newWord-form [name='english']").css("border","1px solid red");
                    }
                    else if ($("#newWord-form [name='japanese']").val() === '')
                    {
                        //$("#newWord-form [name='japanese']").css("border","1px solid red");
                    }
                    else
                    {
                        
                        $.ajax({
                            type: "POST",
                            url: "updateWord.php?id=" + c, // change this to use data
                            data: $(this).serialize(),
                            success: function(data){
                                
                            }

                        });
                    }
                });

                $("#newWord-form input").blur(function(){
                    var checkValue = $(this).val();
                    if(checkValue != '')
                    {
                        $(this).css("border","1px solid #eeeeee");
                    }
                });
                
            });

        </script>
    </body>
</html>