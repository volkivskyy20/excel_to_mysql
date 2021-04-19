<?php session_start()?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>CRM FILE IMPORT</title>
    <link href="//netdna.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<div class="container">
    <br>
    <h3 class="center">IMPORT DATA TO DB</h3>
    <br>
    <div class="panel panel-default">
        <div class="panel-heading">
            <h5>IMPORT</h5>
        </div>
        <div class="panel-body">
            <div class="table-responsive">
                <?php
                if (isset($_SESSION['status'])){
                    echo "<span id=message>".$_SESSION['status']."</span>";
                }
                ?>
                <form action="enco.php" method="POST" enctype="multipart/form-data">
                    <table class="table">
                        <td width="25%" align="right">SELECT EXCEL FILE</td>
                        <td width="50%"><input type="file" name="import_excel"></td>
                        <td width="25%"><input type="submit" name="import" class="btn btn-bd-light" value="Import"></td>
                    </table>
                </form>
            </div>
        </div>
    </div>

</div>
<script src="//code.jquery.com/jquery-2.2.4.min.js"></script>
<script src="//netdna.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
</body>
</html>
