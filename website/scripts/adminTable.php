<?php
require_once('../config.php');
require_once("conn.php");
$getAllWords_query = "SELECT * FROM mytable";
$result=mysqli_query($connection, $getAllWords_query);
    echo <<< _END

    <table id="wordTable">
                <tr class='header'>
                    <th>English</th>
                    <th>Japanese</th>
                    <th>Kanji</th>
                    <th>Operations</th>
                </tr>

_END;
    while ($row = $result->fetch_array()){

        echo "<tr>";
        echo "<td>".$row['eng']."</td>";
        echo "<td>".$row['kana']."</td>";
        echo "<td>".$row['kanji']."</td>";
        echo "<td> 
            <button onclick=\"location.href='../scripts/editword.php?id=".$row['id']."'\" type='button'>edit</button>
            <button type='button' class='delBtt' value='".$row['id']."'>delete</button>
        </td>";
        echo "</tr>";
    }

    echo "</table>";

?>