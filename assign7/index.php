<?php
/**
 * Created by PhpStorm.
 * User: lsirdevan
 * Date: 11/8/17
 * Time: 2:08 PM
 */

require('db_connection.php');

$sql= "SELECT * FROM `jobs`";
$stmt = $dbh->query($sql);

?>
<!DOCTYPE html>
<html>
<head>
    <title>Assignment 7</title>

    <link rel="stylesheet" type="text/css" href="../css/style.css">
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.16/css/jquery.dataTables.min.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">

    <link href='http://fonts.googleapis.com/css?family=Lato:400,700' rel='stylesheet' type='text/css'>

    <script src="https://code.jquery.com/jquery-1.12.4.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.11.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css"></script>
    <script src="https://cdn.datatables.net/1.10.16/js/jquery.dataTables.min.js"></script>

</head>
<body style="font-family: Arial;">
<a href="../index.html" style="display: block; margin-top: 15px; margin-left: 15px;">Home Page</a>
    <div class="container" style="margin-top: 5%;">
        <div class="row">
            <div class="col-md-10 col-md-offset-1">
                <div class="panel panel-default">
                    <div class="panel-heading" style="text-align: left;">
                        <b>Job Listings:</b>
                    </div>
                    <div class="panel-body" style="text-align: left;">
                        <div class="row">
                            <div class="col-sm-offset-4 col-sm-4">
                                <select id="jobs" class="form-control">
                                    <option value="">
                                        -- Select One --
                                    </option>
                                    <?php foreach($stmt->fetchAll() as $row): ?>
                                        <option value="<?php echo $row['id']?>">
                                            <?php echo $row['company_name'];?>
                                        </option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                        </div>
                        <div class="row">
                            <br>
                            <div class="col-sm-offset-4 col-sm-4" id="data"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
<script>
    $(document).on('change', '#jobs', function(e) {
        var id = this.options[e.target.selectedIndex].value;

        $.getJSON('jobs.php', {
            jobId: id
        }, function (object) {
            console.log(object);
            var response = '';
            for (var property in object) {
                if (object.hasOwnProperty(property)) {
                    response += '<b>' + property.replace('_', ' ') + ':</b> ' + object[property] + '<br>';
                }
            }
            $('#data').html(response);
        });
    });
</script>
</html>
