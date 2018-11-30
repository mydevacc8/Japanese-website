<!DOCTYPE html>
<html>
    <head>

        <title>Japanese Vocab V0</title>
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" integrity="sha384-WskhaSGFgHYWDcbwN70/dfYBj47jz9qbsMId/iRN3ewGhXQFZCSftd1LZCfmhktB" crossorigin="anonymous">
    <style>
        table, th, td {
            border: 1px solid black;
            border-collapse: collapse;
        }
        th, td{
            padding: 5px;
        }
    </style>
    </head>

    <body>
        <div class="container">
        
        <div id ="try"></div>
            <form action="addWord.php" method="get">
                <button type="submit" class="btn btn-primary">Add words</button>
            </form>
            <button onclick="window.location='http://localhost/Japanese-website/website/pages/index.php'" class="btn btn-primary">Back</button>
            
        </div>
        <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js" integrity="sha384-smHYKdLADwkXOn1EmN1qk/HfnUcbVRZyYmZ4qpPea6sjB/pTJ0euyQp0Mk8ck+5T" crossorigin="anonymous"></script>
        <script src="https://ajax.aspnetcdn.com/ajax/jQuery/jquery-3.3.1.min.js"></script>
        <script>
                    $("#try").load("../scripts/adminTable.php");
                </script>
        <script>
            $(document).ready(function(){
                $("body").on("click",".delBtt",function(e) {
                    e.preventDefault();
                    $.ajax({
                        type: "POST",
                        url: "../scripts/deleteWord.php",
                        data:{id: $(this).val()},
                        success: function(result){
    
                            $("#try").load("../scripts/adminTable.php");
                            
                            
                        }
                    });
                    console.log("done");
                });
                
            });
        </script>
    </body>
</html>