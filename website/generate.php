<!DOCTYPE html>
<html>
    <head>

        <title>Japanese Vocab V0</title>

    </head>

    <body>

        <?php

            $english = array("Pencil", "Umbrella", "Bag", "Shoes");
            $jap = array("えんぴつ", "かさ", "かばん", "くつ");
            $toSend = array();

            $i = 0;
            
            while ($i < 3){
                $found = false;
                $val = rand(0,count($english)-1);

                for($j = 0; $j < count($toSend); $j++){

                    if ($toSend[$j] == $val){
                        $found = true;
                        break;
                    }
                }

                if ($found == false){
                    array_push($toSend, $val);
                    $i++;
                }

                

            }

            $k = implode('', $toSend);
            
        ?>
        <!--So as an idea use id of the words in sql as a code, sepearte them by a coma probs -->
        <h1>English -> Japanese (hiragana)</h1>
        <button onclick=" window.open('newpdf.php?type=que&lang=eng&words=<?php echo $k; ?>')" type="button">Question</button>
        <button onclick=" window.open('newpdf.php?type=ans&lang=eng&words=<?php echo $k; ?>')" type="button">Answers</button>

        <h1>Japanese (hiragana) -> English</h1>
        <button onclick=" window.open('newpdf.php?type=que&lang=jap&words=<?php echo $k; ?>')" type="button">Question</button>
        <button onclick=" window.open('newpdf.php?type=ans&lang=jap&words=<?php echo $k; ?>')" type="button">Answers</button>

    </body>
</html>