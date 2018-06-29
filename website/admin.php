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
        <?php
            require_once('conn.php');
            $getAllWords_query = "SELECT * FROM mytable";
            $result=mysqli_query($connection, $getAllWords_query);

        ?>
        <div class="container">
        <table>
            <tr class='header'>
                <th>English</th>
                <th>Japanese</th>
                <th>Kanji</th>
                <th>Operations</th>
            </tr>
            <?php

                while ($row = $result->fetch_array()){

                    echo "<tr>";
                    echo "<td>".$row['eng']."</td>";
                    echo "<td>".$row['kana']."</td>";
                    echo "<td>".$row['kanji']."</td>";
                    echo "<td> 
                        <button onclick=\"location.href='\ editword.php?id=".$row['id']."'\" type='button'>edit</button>
                        <button type='button'>delete</button>
                    </td>";
                    echo "</tr>";
                }

            ?>
        </table>
            <form action="addWord.php" method="get">
                <button type="submit" class="btn btn-primary">Add words</button>
            </form>
            <button onclick="window.location='http://localhost/Japanese-website/website/index.php'" class="btn btn-primary">Back</button>
        </div>
        <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js" integrity="sha384-smHYKdLADwkXOn1EmN1qk/HfnUcbVRZyYmZ4qpPea6sjB/pTJ0euyQp0Mk8ck+5T" crossorigin="anonymous"></script>
    </body>
</html>