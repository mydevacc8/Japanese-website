<!DOCTYPE html>
<html>
    <head>

        <title>Japanese Vocab V0</title>
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" integrity="sha384-WskhaSGFgHYWDcbwN70/dfYBj47jz9qbsMId/iRN3ewGhXQFZCSftd1LZCfmhktB" crossorigin="anonymous">
    
        <link rel="stylesheet" type="text/css" href="../styles/indexstyle.css">
    </head>

    <body>

        <section class="bg-gray text-center">
            <div class="container">
                <div id="title">
                    <h1 id="h1Title">Generate a test</h1>
                </div>
            </div>  
        </section>

        <div class="container">
            <div class="row">

                <div class="col-md-5">
                    <form action="" method="post">
                    
                        <div class="form-group">
                            <label for="numberOfWords">How many words?</label>
                            <input type="number" class="form-control" name="numberOfWords" placeholder="Number of Words" min="1">
                        </div>
                        
                        <div class="form-group">
                            <label for="topicOptions">Pick a Topic</label>
                            <select class="form-control" id="topicOptions">
                                <option>1</option>
                                <option>2</option>
                                <option>3</option>
                                <option>4</option>
                                <option>5</option>
                            </select>
                        </div>
                        <button type="submit" class="btn btn-primary">Generate</button>
                    </form>
                    <form action="admin.php" method="get">
                        <button type="submit" class="btn btn-primary">Settings</button>
                    </form>
                </div>

                <div class="col-md-2" id="orText">
                    <h1 >OR</h1>
                </div>

                <div class="col-md-5">
                    <form>

                        <div class="form-group">
                            <label for="testOptions">Pick a Test</label>
                            <select class="form-control" id="testOptions">
                                <option>1</option>
                                <option>2</option>
                                <option>3</option>
                                <option>4</option>
                                <option>5</option>
                            </select>
                        </div>

                        <button type="submit" class="btn btn-primary">Open</button>
                    </form>
                </div>

            </div>
        </div>
        <?php

            require_once("../scripts/conn.php");

            // Checks if size exits (prevents error being printed)
            if (isset($_POST['numberOfWords'])&& $_POST['numberOfWords'] != ''){
                $size = $connection->escape_string($_POST["numberOfWords"]);
            }else{
                $size = NULL;
            }
            

            // getting size of the db
            $getMaxIdQuery = "SELECT count(*) as total from mytable";

            $result=mysqli_query($connection, $getMaxIdQuery);
            $data=mysqli_fetch_assoc($result);
            $count = $data['total'];

            // checks if user input is greater than the db size
            if ($size > $count){
                $size = $count;
            }

            $toSend = array();

            $getWordsQuery = $connection->prepare("SELECT id FROM mytable ORDER BY RAND() LIMIT ?");
            $getWordsQuery->bind_param("i", $size);
            $getWordsQuery->execute();
            $result = $getWordsQuery->get_result();

            // Chnages look of the page depending if the input was correct
            if ($result != ''){
                // get the random ids and add them to toSend list
                while($row = $result->fetch_array()) {
                    array_push($toSend,$row['id']);
                } 
                $k = implode(',', $toSend); //List that is used in the url
                include '../includes/genbottom.php';
            }else{
                include '../includes/genbottomtext.php';
            }
        ?>
        
        <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js" integrity="sha384-smHYKdLADwkXOn1EmN1qk/HfnUcbVRZyYmZ4qpPea6sjB/pTJ0euyQp0Mk8ck+5T" crossorigin="anonymous"></script>
    </body>
</html>