<div class="container">
        <div class="row">
            <div class="col-md-6">
                <h1>English -> Japanese (hiragana)</h1>
                <button onclick=" window.open('../scripts/newpdf.php?type=que&lang=eng&words=<?php echo $k; ?>')" type="button">Question</button>
                <button onclick=" window.open('../scripts/newpdf.php?type=ans&lang=eng&words=<?php echo $k; ?>')" type="button">Answers</button>
            </div>

            <div class="col-md-6">
                <h1>Japanese (hiragana) -> English</h1>
                <button onclick=" window.open('../scripts/newpdf.php?type=que&lang=jap&words=<?php echo $k; ?>')" type="button">Question</button>
                <button onclick=" window.open(../scripts/'newpdf.php?type=ans&lang=jap&words=<?php echo $k; ?>')" type="button">Answers</button>
            </div>
        </div>

</div>