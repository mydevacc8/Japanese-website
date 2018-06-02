<!DOCTYPE html>
<html>
    <head>

        <title>Japanese Vocab V0</title>
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
        <link rel="stylesheet" type="text/css" href="styles/indexstyle.css">
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
            <p1>For now you will only be able to work with hiragana but later we will add more opetions</p1>
            <div class="row">
                <div class="col-md-6">
                    <form action="generate.php" method="get">
                        <button type="submit" class="btn btn-default">Generate</button>
                    </form>
                </div>
                <div class="col-md-6">
                    <form action="admin.php" method="get">
                        <button type="submit" class="btn btn-default">Add words</button>
                    </form>
                </div>
            </div>
        </div>
        
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
    </body>
</html>