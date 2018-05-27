<!--
    
    Use this code to run php script via a button
    Will probably use it with database later

    $con = new mysqli("127.0.0.1", "root", "newpassword", "mydb");
    $jap = $con->query("SELECT jap FROM myTable WHERE id = 1")->fetch_object()->jap;
    $con->close();
    echo "$jap <br/>";
    
-->


<!DOCTYPE html>
<html>
    <head>

        <title>Japanese Vocab V0</title>

    </head>

    <body>

    <?php
        require_once('conn.php');
        $sql = "SELECT jap FROM myTable WHERE id = 1";
        
        $result = $connection->query($sql)->fetch_object()->jap;
        
        echo "$result <br/>";
    ?>

        <h1>Press to generate a test</h1>
        <p1>For now you will only be able to work with hiragana but later we will add more opetions</p1>
        <form action="generate.php" method="get">
            <input type="submit" value="Generate">
        </form>

    </body>
</html>