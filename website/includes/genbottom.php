<div class="container">
            <div class="row">
                <div class="col-md-6">
                    <h1>English -> Japanese (hiragana)</h1>
                    <button onclick=" window.open('newpdf.php?type=que&lang=eng&words=<?php echo $k; ?>')" type="button">Question</button>
                    <button onclick=" window.open('newpdf.php?type=ans&lang=eng&words=<?php echo $k; ?>')" type="button">Answers</button>
                </div>

                <div class="col-md-6">
                    <h1>Japanese (hiragana) -> English</h1>
                    <button onclick=" window.open('newpdf.php?type=que&lang=jap&words=<?php echo $k; ?>')" type="button">Question</button>
                    <button onclick=" window.open('newpdf.php?type=ans&lang=jap&words=<?php echo $k; ?>')" type="button">Answers</button>
                </div>
            </div>

            <div><br/></div>

            <button onclick="window.location='http://localhost/Japanese-website/website/index.php'" class="btn btn-default">Back</button>

        </div>
        
        <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js" integrity="sha384-smHYKdLADwkXOn1EmN1qk/HfnUcbVRZyYmZ4qpPea6sjB/pTJ0euyQp0Mk8ck+5T" crossorigin="anonymous"></script>
    </body>
</html>