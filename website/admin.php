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

                <button type="submit" class="btn btn-default" name="submit" value="Submit" id="submit_form">Submit</button>
                
            </form>

            <div><br/></div>

            <button onclick="window.location='http://localhost/Japanese-website/website/index.php'" class="btn btn-default">Back</button>
        </div>
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
                        
                        //var sendData = $(this).serialize();
                        $.ajax({
                            type: "POST",
                            url: "get_response.php",
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