<!DOCTYPE html>
<html>
    <head>

        <title>Japanese Vocab V0</title>
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" integrity="sha384-WskhaSGFgHYWDcbwN70/dfYBj47jz9qbsMId/iRN3ewGhXQFZCSftd1LZCfmhktB" crossorigin="anonymous">
    </head>

    <body>

        <div class="container">
            <form name="newWord-form" action="" method="post" id="newWord-form">
                <div class="form-group">

                    <label for="english">English</label>
                    <input type="text" class="form-control input-lg" name="english" placeholder="Mirror" required/>

                </div>

                <div class="form-group">
                    <label for="japanese">Japanese</label>
                    <input type="text" class="form-control input-lg" name="japanese" placeholder="かがみ" required/>
                </div>

                <div class="form-group">
                    <label for="kanji">Kanji</label>
                    <input type="text" class="form-control input-lg" name="kanji" placeholder="鏡"/>
                </div>

                <div class="form-group">
                    <label for="tags">Tags</label>
                    <input type="text" class="form-control input-lg" name="tags" placeholder="Body Parts, Genki 1 Chapter 1, Transport..."/>
                </div>

                <button type="submit" class="btn btn-primary" name="submit" value="Submit" id="submit_form">Submit</button>
                
            </form>

            <div><br/></div>

            <button onclick="window.location='http://localhost/Japanese-website/website/admin.php'" class="btn btn-primary">Back</button>
        </div>

        <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js" integrity="sha384-smHYKdLADwkXOn1EmN1qk/HfnUcbVRZyYmZ4qpPea6sjB/pTJ0euyQp0Mk8ck+5T" crossorigin="anonymous"></script>

        <script src="https://ajax.aspnetcdn.com/ajax/jQuery/jquery-3.3.1.min.js"></script>

        <script>
            
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
                            url: "insertWord.php",
                            data: $(this).serialize(),
                            success: function(data){
                                $("#newWord-form").find("input[type=text], textarea").val("");
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